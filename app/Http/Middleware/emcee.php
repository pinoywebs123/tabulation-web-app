<?php

namespace App\Http\Middleware;

use Closure;

class emcee
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
        if(Auth::user()->role_id != 3){
            abort(404);
        }
        return $next($request);
    }
}
