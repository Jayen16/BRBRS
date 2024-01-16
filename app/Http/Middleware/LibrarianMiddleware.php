<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LibrarianMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $user = Auth::guard('sanctum')->authenticate($request);

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }


            return $next($request);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    

    // public function handle(Request $request, Closure $next)
    // {
    //     $token = $request->header('Authorization');

    //     if (!$token) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }


    //     return $next($request);
    // }

 
}
