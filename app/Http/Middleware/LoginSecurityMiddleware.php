<?php

namespace App\Http\Middleware;

use App\Support\Google2FAAuthenticator;
use Closure;

class LoginSecurityMiddleware
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
        $authenticator = app(Google2FAAuthenticator::class)->boot($request);

        if ($request->has(config('google2fa.otp_input')) && ! app()->environment('local')) {
            // This assumes that 2fa checks contain a captcha code as well
            $request->validate([
                'g-recaptcha-response' => 'required|captcha',
            ]);
        }

        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }

        $previousUrl = url()->previous();
        $currentUrl = url()->current();

        if ($previousUrl !== $currentUrl) {
            $request->session()->put('2fa-destination', $previousUrl);
        }

        return $authenticator->makeRequestOneTimePasswordResponse();
    }
}
