<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class FacturarCompras
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
        if(!Auth::user()->can('facturar-compras')){
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
