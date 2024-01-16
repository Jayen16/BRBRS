<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LibrarianApiMiddleware
{
    // public function handle($request, Closure $next)
    // {
    //     header("Access-Control-Allow-Origin: *");
    //     //ALLOW OPTIONS METHOD
    //     $headers = [
    //         'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
    //         'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
    //     ];
    //     if ($request->getMethod() == "OPTIONS"){
    //         return response()->json('OK',200,$headers);
    //     }

    //     $response = $next($request);
    //     foreach ($headers as $key => $value) {
    //         $response->header($key, $value);
    //     }

    //     // return $response;

    //     $authorizationHeader = $request->header('Authorization');
    //     dd($authorizationHeader);

    // }


    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();
          

        try {

            if (!$bearerToken) {
                return response()->json(['error' => 'Unauthenticated. Invalid Bearer token.'], 401);
            }

            return $next($request);
            
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Unauthenticated. ' . $e->getMessage()], 401);
        }
    }
    
    // public function handle(Request $request, Closure $next)
    // {
    

    //     dd($request);

        // if ($request->hasHeader('Authorization')) {
        //     $authorizationHeader = $request->header('Authorization');

        //     // Check if the Authorization header starts with 'Bearer'
        //     if (strpos($authorizationHeader, 'Bearer ') === 0) {
        //         // Extract the token from the header
        //         $token = substr($authorizationHeader, 7);

        //         // Check the token's validity
        //         if (Auth::onceUsingId(Auth::guard('sanctum')->id())) {
        //             // Continue with the request
        //             return $next($request);
        //         }
        //     }
        // }

    // }
        // // If the Authorization header or Bearer token is not present or invalid, return a 401 Unauthorized response
        // return response()->json(['error' => 'Unauthorized'], 401);
    // }

    // public function handle($request, Closure $next)
    // {
      
    //     $bearerToken = $request->bearerToken();

    //     try {

    //         if (!$bearerToken) {
    //             return response()->json(['error' => 'Unauthenticated. Invalid Bearer token.'], 401);
    //         }

    //         return $next($request);
            
    //     } catch (\Throwable $e) {
    //         return response()->json(['error' => 'Unauthenticated. ' . $e->getMessage()], 401);
    //     }
    // }
}
