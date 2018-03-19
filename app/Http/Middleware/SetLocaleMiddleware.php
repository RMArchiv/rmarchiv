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
        $userLangs = strtolower(substr(explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0],0,2));

        if(Auth::check()){
            if(Auth::user()->settings->language == ''){
                if(array_search($userLangs, ['de', 'en', 'es'])){
                    \App::setLocale($userLangs);
                    echo 'AUTHBROWSER'.\App::getLocale();
                }else{
                    \App::setLocale('en');
                    echo 'AUTHDEFAULT'.\App::getLocale();
                }
            }else{
                \App::setLocale(\Auth::user()->settings->language);
                echo 'AUTHDB'.\App::getLocale();
            }
        }else{
            if(array_search($userLangs, ['de', 'en', 'es'])){
                \App::setLocale($userLangs);
                echo 'NOAUTHBROWSER'.\App::getLocale();
            }else{
                \App::setLocale('en');
                echo 'NOAUTHDEFAULT'.\App::getLocale();
            }
        }

        return $next($request);
    }
}
