<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ver_rol
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
 if(Auth::user()->can('crear-rol')||Auth::user()->can('editar-rol')){ 
     return $next($request); 
 } 
        abort(403, 'Unauthorized action');
    }
}
