<?php

namespace App\Http\Middleware\User;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function route;

/**
 * Class Administration
 * @package App\Http\Middleware
 */
class Administration
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || !$user->isAuthorized(USER::ROLE_ADMINISTRATOR)) {
            throw new AuthenticationException(
                'Unauthenticated.',
                [],
                route('login', ['locale' => 'ro'])
            );
        }

        return $next($request);
    }
}
