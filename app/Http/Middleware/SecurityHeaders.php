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
        if ($this->isAllowedHost($request) && $this->isNotHealthCheck() && $this->isProduction()) {
            abort(418);
        }

        /** @var Response $response */
        $response = $next($request);

        if (method_exists($response, 'header')) {
            $response->headers->remove('x-cdn');
            $response->headers->remove('X-CDN');
            if (app()->environment(['production', 'development'])) {
                $response->headers->add(
                    [
                        'Content-Security-Policy' => "default-src fonts.googleapis.com *.amazonaws.com *.google.com www.googletagmanager.com www.google-analytics.com impreunapentrusanatate.ro dev.impreunapentrusanatate.ro; script-src 'self' 'unsafe-inline' 'unsafe-eval' *.google.com www.googletagmanager.com *.google-analytics.com www.gstatic.com polyfill.io maps.googleapis.com cdn.jsdelivr.net cdn.tiny.cloud cdnjs.cloudflare.com; object-src 'none'; style-src 'self' 'unsafe-inline' fonts.googleapis.com cdnjs.cloudflare.com cdn.tiny.cloud; img-src 'self' data: *.amazonaws.com maps.googleapis.com maps.gstatic.com sp.tinymce.com *.google-analytics.com; frame-src 'self' *.google.com www.googletagmanager.com www.google-analytics.com; font-src 'self' fonts.googleapis.com fonts.gstatic.com;",
                        'X-Content-Security-Policy' => "default-src fonts.googleapis.com *.amazonaws.com *.google.com www.googletagmanager.com www.google-analytics.com impreunapentrusanatate.ro dev.impreunapentrusanatate.ro; script-src 'self' 'unsafe-inline' 'unsafe-eval' *.google.com www.googletagmanager.com *.google-analytics.com www.gstatic.com polyfill.io maps.googleapis.com cdn.jsdelivr.net cdn.tiny.cloud cdnjs.cloudflare.com; object-src 'none'; style-src 'self' 'unsafe-inline' fonts.googleapis.com cdnjs.cloudflare.com cdn.tiny.cloud; img-src 'self' data: *.amazonaws.com maps.googleapis.com maps.gstatic.com sp.tinymce.com *.google-analytics.com; frame-src 'self' *.google.com www.googletagmanager.com www.google-analytics.com; font-src 'self' fonts.googleapis.com fonts.gstatic.com",
                        'X-WebKit-CSP' => "default-src fonts.googleapis.com *.amazonaws.com *.google.com www.googletagmanager.com www.google-analytics.com helpforhealth.local impreunapentrusanatate.ro dev.impreunapentrusanatate.ro; script-src 'self' 'unsafe-inline' 'unsafe-eval' *.google.com www.googletagmanager.com *.google-analytics.com www.gstatic.com polyfill.io maps.googleapis.com cdn.jsdelivr.net cdn.tiny.cloud cdnjs.cloudflare.com; object-src 'none'; style-src 'self' 'unsafe-inline' fonts.googleapis.com cdnjs.cloudflare.com cdn.tiny.cloud; img-src 'self' data: *.amazonaws.com maps.googleapis.com maps.gstatic.com sp.tinymce.com *.google-analytics.com; frame-src 'self' *.google.com www.googletagmanager.com www.google-analytics.com; font-src 'self' fonts.googleapis.com fonts.gstatic.com"
                    ]
                );
            }
        }

        return $response;
    }

    /**
     * @return bool
     */
    public function isProduction(): bool
    {
        return config('app.env') === 'production';
    }

    /**
     * @param  Request  $request
     *
     * @return bool
     */
    public function isAllowedHost(Request $request): bool
    {
        $allowedHosts = ['helpforhealth.local', 'impreunapentrusanatate.ro', 'dev.impreunapentrusanatate.ro'];

        return !in_array($request->headers->get('host'), $allowedHosts);
    }

    /**
     * @return bool
     */
    public function isNotHealthCheck(): bool
    {
        return request()->path() !== 'health';
    }
}
