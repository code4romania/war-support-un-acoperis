<?php

namespace App\Http\Middleware\User;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class ShareMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || (!$user->isAuthorized(USER::ROLE_ADMINISTRATOR) && !$user->isAuthorized(USER::ROLE_TRUSTED))) {
            throw new AuthenticationException(
                'Unauthenticated.',
                [],
                route('login', ['locale' => 'ro'])
            );
        }
        return $next($request);
    }
}
