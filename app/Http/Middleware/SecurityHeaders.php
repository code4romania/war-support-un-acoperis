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
        $allowedHosts = ['helpforhealth.local', 'impreunapentrusanatate.ro'];

        if (! in_array($request->headers->get('host'), $allowedHosts)) {
            abort(418);
        }

        /** @var Response $response */
        $response = $next($request);

        if (method_exists($response, 'header')) {
            $response->header('X-Content-Type-Options', 'nosniff')
                ->header('Referrer-Policy', 'same-origin');
        }

        return $response;
    }
}
