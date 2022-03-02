<?php

namespace App\Http\Middleware\User;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class Refugee
{

    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || !$user->isAuthorized(User::ROLE_REFUGEE)) {
            throw new AuthenticationException(
                'Unauthenticated.',
                [],
                // todo redirecting to the login page without any message is misleading
                route('login', ['locale' => 'ro'])
            );
        }

        return $next($request);
    }
}
