<?php

namespace App\Http\Middleware;

use App\FlashCMS\Helpers\FlashCMS;
use Closure;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Request;

use Veda\Utils\Http\Uri;

class RequestLocaleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!app('request')->is(FlashCMS::getBackendPrefix() . '/*')) {
            return $next($request);
        }


        $localeRequestParam = 'locale';

        if ($request->getMethod() !== Request::METHOD_GET) {
            return $next($request);
        }

        $locale = $request->query->get($localeRequestParam, null);


        if (!$locale || !app('laravellocalization')->checkLocaleInSupportedLocales($locale)) {
            return $next($request);
        }


        $redirection = app('laravellocalization')->getLocalizedURL(false);

        $uri = Uri::fromString($redirection);
        $query = $uri->getQuery(true);
        unset($query[$localeRequestParam]);
        $uri = $uri->withQuery($query);

        $redirectResponse = new RedirectResponse($uri->__toString(), 302, ['Vary' => 'Accept-Language']);
        return $redirectResponse->withCookie(cookie()->forever('locale', $locale));

    }
}
