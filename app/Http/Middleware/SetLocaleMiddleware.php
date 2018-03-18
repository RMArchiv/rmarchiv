<?php

namespace App\Http\Middleware;

use Closure;

class SetLocaleMiddleware
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
        if(\Auth::check()){
            if(\Auth::user()->settings->language == ''){
                \App::setLocale('de');
                echo 'AuthNoSett'.\App::getLocale();
            }else{
                \App::setLocale(\Auth::user()->settings->language);
                echo 'AuthFromSet'.\App::getLocale();
            }
        }else{
            \App::setLocale('de');
            echo 'Noauth'.\App::getLocale();
        }

        return $next($request);
    }
}
