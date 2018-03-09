<?php

namespace App\Http\Middleware;

use Closure;
use DebugBar\DebugBar;

class DebugBarMiddleware
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
        if(\Auth::check() || \Auth::user()->id == 1){
            \Debugbar::enable();
        }
        return $next($request);
    }
}
