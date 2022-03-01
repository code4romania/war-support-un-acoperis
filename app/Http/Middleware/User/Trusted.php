<?php

namespace App\Http\Middleware\User;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class Trusted
{

    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || !$user->isAuthorized(User::ROLE_TRUSTED)) {
            throw new AuthenticationException(
                'Unauthenticated.',
                [],
                route('login', ['locale' => 'ro'])
            );
        }

        return $next($request);
    }
}
