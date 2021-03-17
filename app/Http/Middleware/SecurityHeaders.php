<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowedHosts = ['helpforhealth.local', 'impreunapentrusanatate.ro', 'dev.impreunapentrusanatate.ro'];

        if (! in_array($request->headers->get('host'), $allowedHosts)) {
            abort(418);
        }

        /** @var Response $response */
        $response = $next($request);

        if (method_exists($response, 'header')) {
            $response->headers->remove('x-cdn');
            if (app()->environment('production')) {
                $response->headers->add([
                    'Content-Security-Policy' => "default-src fonts.googleapis.com *.amazonaws.com *.google.com impreunapentrusanatate.ro dev.impreunapentrusanatate.ro; script-src 'self' 'unsafe-inline' *.google.com www.gstatic.com; object-src 'none'; style-src 'self' 'unsafe-inline' fonts.googleapis.com; img-src 'self' data: *.amazonaws.com; frame-src 'self' *.google.com; font-src 'self' fonts.googleapis.com fonts.gstatic.com",
                    'X-Content-Security-Policy' => "default-src fonts.googleapis.com *.amazonaws.com *.google.com impreunapentrusanatate.ro dev.impreunapentrusanatate.ro; script-src 'self' 'unsafe-inline' *.google.com www.gstatic.com; object-src 'none'; style-src 'self' 'unsafe-inline' fonts.googleapis.com; img-src 'self' data: *.amazonaws.com; frame-src 'self' *.google.com; font-src 'self' fonts.googleapis.com fonts.gstatic.com",
                    'X-WebKit-CSP' =>  "default-src fonts.googleapis.com *.amazonaws.com *.google.com helpforhealth.local impreunapentrusanatate.ro dev.impreunapentrusanatate.ro; script-src 'self' 'unsafe-inline' *.google.com www.gstatic.com; object-src 'none'; style-src 'self' 'unsafe-inline' fonts.googleapis.com; img-src 'self' data: *.amazonaws.com; frame-src 'self' *.google.com; font-src 'self' fonts.googleapis.com fonts.gstatic.com"
                ]);
            }
        }

        return $response;
    }
}
