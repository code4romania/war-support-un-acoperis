<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);

        if (method_exists($response, 'header')) {
            $response->headers->remove('x-cdn');
            $response->headers->remove('X-CDN');
            if (app()->environment(['production', 'development'])) {

                $cspHeader = "default-src 'self' fonts.googleapis.com *.amazonaws.com *.google.com www.googletagmanager.com www.google-analytics.com; script-src 'self' 'unsafe-inline' 'unsafe-eval' *.google.com www.googletagmanager.com *.google-analytics.com www.gstatic.com polyfill.io maps.googleapis.com cdn.jsdelivr.net cdn.tiny.cloud cdnjs.cloudflare.com; object-src 'none'; style-src 'self' 'unsafe-inline' fonts.googleapis.com cdnjs.cloudflare.com cdn.tiny.cloud; img-src 'self' data: *.amazonaws.com maps.googleapis.com maps.gstatic.com sp.tinymce.com *.google-analytics.com; frame-src 'self' *.google.com www.googletagmanager.com www.google-analytics.com; font-src 'self' fonts.googleapis.com fonts.gstatic.com;";
                $response->headers->add(
                    [
                        'Content-Security-Policy' => $cspHeader,
                        'X-Content-Security-Policy' => $cspHeader,
                        'X-WebKit-CSP' => $cspHeader,
                    ]
                );
            }
        }

        return $response;
    }
}
