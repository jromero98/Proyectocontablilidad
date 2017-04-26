<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Categoria
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
        if(!Auth::user()->can('categoria')){
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
