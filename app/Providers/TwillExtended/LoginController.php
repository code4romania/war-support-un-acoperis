<?php

namespace App\Providers\TwillExtended;

use A17\Twill\Http\Controllers\Admin\LoginController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * @param Request $request
     * @param \Illuminate\Foundation\Auth\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if (! $user->isAdministrator()) {
            $this->guard()->logout();

            $request->session()->flush();

            $request->session()->regenerate();

            return $this->redirector->to(route('home', ['locale' => app()->getLocale()]));
        }

        return parent::authenticated($request, $user);
    }
}
