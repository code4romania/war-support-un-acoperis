<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

/**
 * Class SetLanguage
 * @package App\Http\Middleware
 */
class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request  $request, Closure $next)
    {
        $routeLocaleValue = $request->route('locale');

        if (!empty($routeLocaleValue) && in_array($routeLocaleValue, config('translatable.locales'))) {
            App::setLocale($routeLocaleValue);
        }

        URL::defaults(['locale' => app()->getLocale()]);

        return $next($request);
    }
}
