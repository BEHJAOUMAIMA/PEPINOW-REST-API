<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePlantsRequest;
use App\Models\Plants;
use Illuminate\Http\Request;

/**
 * Summary of PlantsController
 */
class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plants::with('category')->get();
        return response()->json([
            'success'=>true,
            "message"=>"All Plants",
            'plants'=>$plants
        ]);

    }

    public function store(StorePlantsRequest $request)
    {
        //  générer un nom de fichier unique
        $nameFile = now()->format('YmdHisu') . '.' . $request->file('image')->getClientOriginalExtension();
        // Stocker l'image dans le système de fichiers local
        $request->file('image')->move(public_path('images'), $nameFile);
        // obtenir son URL à l'aide de la fonction asset()
        $urlImg = asset('images/' . $nameFile);

        $plant = Plants::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $urlImg,
            'category_id' => $request->category_id,
        ]);
         return response()->json([
            'status'=>true,
            'message'=>'Plant created Successfully !',
            'plant'=>$plant,
        ],200);
    }

    public function show(Plants $plant)
    {
        $plant = $plant->load('category:id,category_name');
        return response()->json([
            'status'=>true,
            'data'=>$plant
        ],200);
    }
    public function update(StorePlantsRequest $request, Plants $plant)
    {
        $plant->update($request->validated());
        return response()->json([
            'status'=>true,
            'message'=>'Plant updated Successfully !',
            'data'=>$plant,
        ],200);
    }

    public function destroy(Plants $plant)
    {
        $plant->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Plant deleted Successfully !',
        ],200);
    }

}
