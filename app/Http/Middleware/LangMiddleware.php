<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url_array = explode('.', parse_url($request->url(), PHP_URL_HOST));
        $subdomain = $url_array[0];

        $languages = config('translator.available_locales');

        if (in_array($subdomain, $languages)) {
            \App::setLocale($subdomain);
            Carbon::setLocale($subdomain);
        }

        return $next($request);
    }
}
