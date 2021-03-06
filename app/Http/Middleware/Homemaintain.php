<?php

namespace App\Http\Middleware;

use Closure;
use Cache;

class Homemaintain
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
        if ( Cache::get('homemaintain') == 'close' ){
            return abort('503');
        }
        return $next($request);
    }
}
