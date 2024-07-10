<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
/* Start code */
use Illuminate\Support\Facades\Auth;
/* End code */
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        /* Start code */
        if(Auth::user()->usertype != 'admin'){
            return redirect('/');
        }
        /* End code */
        return $next($request);
    }
}
