<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class cuentas_manuales
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
        if(!Auth::user()->can('cuentas_manuales')){
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
