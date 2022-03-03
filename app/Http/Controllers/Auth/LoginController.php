<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        /** @var User $user */
        $user = Auth::user();

        switch (true) {
            case $user->isAdministrator():
                return route('admin.dashboard');
            case  $user->isHost():
                return route('host.profile');
            case $user->isRefugee():
                return route('refugee.home');
        }

        return route('2fa.login.check', ['locale' => app()->getLocale()]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $loginResult = $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );

        if ($loginResult && !is_null($this->guard()->user())) {
            return !is_null($this->guard()->user()->approved_at);
        }

        return false;
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $rules = [
            $this->username() => ['required','string','email'],
            'password' => ['required', 'string'],
        ];

        if (! app()->environment('local')) {
            $rules['g-recaptcha-response'] = ['required', 'captcha'];
        }

        $request->validate($rules);
    }
}
