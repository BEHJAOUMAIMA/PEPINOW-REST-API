<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role === 1) {
            return $next($request);
        }

        return response()->json([
            'status'=>false,
            'message' => 'Sorry! You are not admin and your are not allowed'
        ], 401);
    }
}
