<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (empty($user) || !$user->isAdministrator()) {
            throw new AuthenticationException(
                'Unauthenticated.',
                [],
                route('login', ['locale' => 'ro'])
            );
        }

        return $next($request);
    }
}
