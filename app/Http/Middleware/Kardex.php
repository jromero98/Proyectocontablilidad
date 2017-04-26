<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Kardex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if(!Auth::user()->can('ver-kardex')){
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
