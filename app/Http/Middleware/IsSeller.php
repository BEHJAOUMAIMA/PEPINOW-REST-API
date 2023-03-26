<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsSeller
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role === 2) {
            return $next($request);
        }

        return response()->json([
            'status'=>false,
            'message' => 'Sorry! You are not Seller and your are not allowed'
        ], 401);
    }
}
