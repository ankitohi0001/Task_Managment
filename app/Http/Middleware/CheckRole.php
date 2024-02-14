<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        // Perform your admin authorization check here
        if (auth()->check() && auth()->user()->user_type == "admin") {
            return $next($request);
        }else{
            return redirect('list');
        }

        // If the user is not an admin, return a 403 Forbidden response
        
    }

    
}
