<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LibrarianMiddleware
{


    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->tokens->isEmpty()) {
            return $next($request);
        }

        // If the user is not logged in or doesn't have a token, handle the response accordingly
        return response()->json(['error' => 'Unauthorized - Token does not exist'], 401);
    }
    
    // public function handle($request, Closure $next){
        
    //   if (Auth::check() && Auth::user()->tokens->isEmpty()) {
    //         return redirect()->route('login'); // Redirect to login if user does not have a token
    //     }
    //     return $next($request);
    // }
       
    // public function handle($request, Closure $next)
    // {
    //     // Check if the request has a valid token
    //     if (!$request->bearerToken()) {
    //         return response()->json(['error' => 'Unauthorized - Access Denied'], 401);
    //     }
    
    //     // Validate the token
    //     $user = Auth::guard('sanctum')->user();
    //     if (!$user) {
    //         return response()->json(['error' => 'Unauthorized - Invalid token'], 401);
    //     }
    
    //     // Check if the user's email is verified
    //     if (!$user->email_verified_at) {
    //         return response()->json(['error' => 'Forbidden - Access Denied'], 403);
    //     }
    
    //     return $next($request);
    // }
}
