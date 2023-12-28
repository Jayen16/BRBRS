<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SelfRegisterMiddleware
{
    public function handle($request, Closure $next)
    {   
        $emailFromSession  = session('email');
        if ($emailFromSession) {
            if(!$emailFromSession) {
                return response('Forbidden - Access Denied', 403);
            }
        } else {
            return response('Forbidden - Access Denied', 403);
        }

        return $next($request);
    }
}
