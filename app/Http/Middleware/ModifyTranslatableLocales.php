<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class ModifyTranslatableLocales
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

        $supportedLocales = app('laravellocalization')->getSupportedLocales();

        $supportedLocales = array_keys($supportedLocales);

        Config::set("translatable.locales", $supportedLocales);

        return $next($request);

    }
}
