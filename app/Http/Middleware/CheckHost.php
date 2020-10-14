<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class CheckHost
 * @package App\Http\Middleware
 */
class CheckHost
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            app()->isLocal() ||
            app()->environment() == 'development' ||
            'health' === $request->path() // Exclude health check route from this middleware
        ) {
            return $next($request);
        }

        $host = $request->header('Host');
        if ($host && !in_array($host, [env('APP_HOST'), 'www.impreunapentrusanatate.ro'])) {
//            app('sentry')->captureMessage('Host header injection attempt ' . $host); TODO activate when we add sentry
            abort('403');
        }

        $xForwardedHost = $request->header('X-Forwarded-Host');
        if ($xForwardedHost && $xForwardedHost != env('APP_HOST')) {
//            app('sentry')->captureMessage('X Forward Host header injection attempt ' . $xForwardedHost); TODO activate when we add sentry
            abort('403');
        }

        $serverName = $request->server('SERVER_NAME');
        if ($serverName && $serverName != env('APP_HOST')) {
//            app('sentry')->captureMessage('Server name header injection attempt ' . $serverName); TODO activate when we add sentry
            abort(403);
        }

        return $next($request);
    }
}
