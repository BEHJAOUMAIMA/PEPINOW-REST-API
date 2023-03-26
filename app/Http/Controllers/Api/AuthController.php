<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     *
     */
    public function createUser(Request $request){


        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:4',
        ]);
        // Return errors if validation error occur.
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }
        // Check if validation pass then create user and auth token. Return the auth token
        if ($validator->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

    }
    public function loginUser(Request $request){
        if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }
    public function me(Request $request)
    {
        return $request->user();
    }
    public function logout(){
       auth()->user()->tokens()->delete();
       return response()->json([
        'status' => true,
        'message'=> 'User Loguut Successfully'
        ], 200);
    }
    public function updateProfile(Request $request){
        $user = auth()->user();
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255|unique:users,email,'.$user->id,
            'old_password' => 'required|string|min:4',
            'password' => 'string|min:4|confirmed'
        ]);
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'message' => 'The old password does not match'
            ], 422);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'status'=>true,
            'message' => 'Profile updated successfully'
        ],200);
    }
    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status'=>false,
                'message' => 'User does not exist'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'new_password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error'=>$validator->errors()
                ]);
            }
            $user->update([
                'password'=>Hash::make($request->new_password)
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'password reseted successfully'
            ], 200);
        }
    }
    public function changeRole(Request $request, $id){
        $validatedData = $request->validate([
            'role' => 'required|in:0,1,2',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return response()->json([
            'status'=>true,
            'message' => 'User Role changed successfully',
            'user' => $user
        ], 201);
    }
    public function allUsers(){
        $users = User::all();
        return response()->json([
            'status'=>true,
            'message'=>'Users List',
            'Users'=>$users
        ],200);
    }
}
