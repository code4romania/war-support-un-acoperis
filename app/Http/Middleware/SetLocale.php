<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class SetLocale
 * @package App\Http\Middleware
 */
class SetLocale
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
        $locale = $request->segment(1);

        if (! in_array($locale, config('translatable.locales', []))) {
            return redirect()->to(
                collect($request->segments())
                    ->prepend(config('app.locale'))
                    ->implode('/')
            );
        }

        app()->setLocale($locale);

        url()->defaults(['locale' => $locale]);

        return $next($request);
    }
}
