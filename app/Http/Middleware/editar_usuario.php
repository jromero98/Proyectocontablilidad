<?php

namespace App\Http\Middleware;

use Closure;

class editar_usuario
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
        if(!Auth::user()->can('editar-usuario')){
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
