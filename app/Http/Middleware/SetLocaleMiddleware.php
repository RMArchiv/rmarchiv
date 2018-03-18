<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        $userLangs = preg_split('/,|;/', $request->server('HTTP_ACCEPT_LANGUAGE'));

        if(Auth::check()){
            if(Auth::user()->settings->language == ''){
                if(array_search($userLangs, config('translator.available_locales'))){
                    \App::setLocale($userLangs);
                }else{
                    \App::setLocale('en');
                }
            }else{
                \App::setLocale(\Auth::user()->settings->language);
            }
        }else{
            if(array_search($userLangs, config('translator.available_locales'))){
                \App::setLocale($userLangs);
            }else{
                \App::setLocale('en');
            }
        }

        return $next($request);
    }
}
