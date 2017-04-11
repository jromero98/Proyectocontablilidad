<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ver_usuario
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
        if(Auth::user()->can('crear-usuario')||Auth::user()->can('editar-usuario')){
            return $next($request);
        }
        abort(403, 'Unauthorized action');
    }
}
