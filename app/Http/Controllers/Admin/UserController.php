<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HostRequestCompany;
use App\Http\Requests\HostRequestPerson;
use App\Services\HostService;
use App\Services\UserService;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $allowAccess = false;
        if (Auth::user()->isAdministrator() || Auth::user()->isTrusted())
        {
            $allowAccess = true;
        }

        $allowAccess || abort(403);

        return view('admin.user-list')
            ->with('users', User::all());

    }

    public function addTrusted()
    {
        if (!Auth::user()->isAdministrator())
        {
            abort(403);
        }

        $hs = new HostService();
        return $hs->viewSignupForm('admin.trusted-user-add');
    }

    /**
     * @param HostRequestPerson|HostRequestCompany $request
     * @return mixed
     */
    private function storeTrustedUser($request)
    {
        if (!Auth::user()->isAdministrator())
        {
            abort(403);
        }

        $userService = new UserService();
        $trustedUser = $userService->createTrustedUser($request, true);

        return redirect()
            ->route('admin.user-detail', ['id' => $trustedUser->id])
            ->withsuccess(__("Trusted user was activated and reset password option was successfully sent"));

    }

    /**
     * Used just to validate the request
     *
     * @param HostRequestPerson $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTrustedPerson(HostRequestPerson $request)
    {
        return $this->storeTrustedUser($request);
    }

    /**
     * Used just to validate the request
     *
     * @param HostRequestCompany $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTrustedCompany(HostRequestCompany $request)
    {
        return $this->storeTrustedUser($request);
    }

}
