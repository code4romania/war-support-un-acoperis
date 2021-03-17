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

        return $response;
    }
}
