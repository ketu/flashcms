<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Request;

use Veda\Utils\Http\Uri;

class CookiesLocaleChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        $localeParam = 'locale';

        $locale = $request->cookie($localeParam, false);

        if (!$locale || !app('laravellocalization')->checkLocaleInSupportedLocales($locale) ) {
            return $next($request);
        }

        app()->setLocale($locale);
        app('laravellocalization')->setLocale($locale);

        return $next($request);

    }
}
