<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }


    
    // protected function redirectTo($request)
    //     {


    //         if (!$request->expectsJson()) {
    //             return redirect()->route('login');
    //         }
            
    //         if (!$request->bearerToken()) {
    //             return response()->json(['error' => 'No authentication token provided.'], 401);
    //         }
            
    //         if ($request->ajax() || $request->wantsJson()) {
    //             return response()->json(['message' => 'Successfully logged in.'], 200);
    //         } else {
    //             return response()->json(['error' => 'Unauthenticated.'], 401);
    //         }
            

           
    //     }

    protected function unauthenticated($request, array $guards)
    {
        return abort(response()->json([
            'status' => 'error',
            'code' => Response::HTTP_UNAUTHORIZED,
            'error' => 'Authentication required',
        ], Response::HTTP_UNAUTHORIZED));
    }

    
}
