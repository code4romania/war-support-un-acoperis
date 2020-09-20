<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Symfony\Component\HttpFoundation\Cookie;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/cms/*'
    ];

    /**
     * VerifyCsrfToken constructor.
     * @param Application $app
     * @param Encrypter $encrypter
     */
    public function __construct(Application $app, Encrypter $encrypter)
    {
        $this->exceptTwillOnLocal();

        parent::__construct($app, $encrypter);
    }
    /**
     * Overwrite parent method to set HttpOnly with config value
     *
     * Add the CSRF token to the response cookies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function addCookieToResponse($request, $response)
    {
        $config = config('session');

        if ($response instanceof Responsable) {
            $response = $response->toResponse($request);
        }

        $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN', $request->session()->token(), $this->availableAt(60 * $config['lifetime']),
                $config['path'], $config['domain'], $config['secure'], $config['http_only'], false, $config['same_site'] ?? null
            )
        );

        return $response;
    }

    /**
     * Build $except entry to skip Twill Admin pages
     */
    private function exceptTwillOnLocal()
    {
        $twillUrlBits = array_filter(array_map(function ($item) {
            return trim($item, '/'); // Remove extra /
        }, [
            env('ADMIN_APP_URL'),
            env('ADMIN_APP_PATH'),
            '*' // Wildcard for all admin subpages
        ]));

        // Build url
        $twillUrl = request()->getScheme() . '://' . implode('/', $twillUrlBits);

        // Append to except list
        $this->except[] = $twillUrl;
    }
}
