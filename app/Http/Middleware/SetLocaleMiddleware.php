<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
            $http_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }else{
            $http_lang = 'en';
        }

        switch ($http_lang) {
            case 'de':
                $userLangs = 'de';
                break;
            case 'en':
                $userLangs = 'en';
                break;
            case 'es':
                $userLangs = 'es';
                break;
            default:
                $userLangs = 'en';
        }

        if (Auth::check()) {
            if (Auth::user()->settings->language == '') {
                \App::setLocale($userLangs);
            } else {
                \App::setLocale(\Auth::user()->settings->language);
            }
        } else {
            \App::setLocale($userLangs);
        }

        return $next($request);
    }
}
