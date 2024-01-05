<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LibrarianInterfaceMiddleware
{

    public function handle($request, Closure $next)
    {
       if (auth()->check()) {
            if (!auth()->user()->email_verified_at) {

                return response()->json(['error' => 'Forbidden - Access Denied'], 403);
            } 
  
        } else {
            return response()->json(['error' => 'Forbidden - Access Denied'], 403);
        }

        return $next($request);
    }
}
