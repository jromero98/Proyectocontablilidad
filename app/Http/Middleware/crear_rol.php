<?php

namespace App\Http\Middleware;

use Closure;

class crear_rol
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
        if(!Auth::user()->can('crear-rol')){
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
