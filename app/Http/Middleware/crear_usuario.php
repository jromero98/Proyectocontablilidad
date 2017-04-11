<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class crear_usuario
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
        if(!Auth::user()->can('crear-usuario')){
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
