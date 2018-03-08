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
            if(!array_search(\Auth::user()->settings->language, \Config::get('translator.available_locales'))){
                \App::setLocale('de');
            }else{
                \App::setLocale(\Auth::user()->settings->language);
            }
        }else{
            \App::setLocale('de');
        }
        return $next($request);
    }
}
