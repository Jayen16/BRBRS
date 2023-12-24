<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LibrarianMiddleware
{

    public function handle($request, Closure $next)
    {
       if (auth()->check()) {
            if (!auth()->user()->username && !auth()->user()->name) {
                return response()->json(['error' => 'Forbidden - Access Denied'], 403);
            } 
            // else {
            //     return response()->json(['message' => 'Authenticated user.']);
            // }
        } else {
            return response()->json(['error' => 'Forbidden - Access Denied'], 403);
        }

        return $next($request);
    }
}
