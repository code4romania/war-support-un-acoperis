<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HostRequestCompany;
use App\Http\Requests\HostRequestPerson;
use App\Services\HostService;
use App\Services\UserService;
use App\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $allowAccess = false;
        if (Auth::user()->isAdministrator() || Auth::user()->isTrusted())
        {
            $allowAccess = true;
        }

        $allowAccess || abort(403);

        return view('admin.user-list')
            ->with('users', User::all())
            ->with('approvalStatus', $request->get('status'));

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

    public function addAdministrator()
    {
        if (!Auth::user()->isAdministrator())
        {
            abort(403);
        }

        $hs = new HostService();
        return $hs->viewSignupForm('admin.admin-user-add');
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

        $userService->generateResetTokenAndNotifyUser($trustedUser);

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

    /**
     * @param HostRequestPerson|HostRequestCompany $request
     * @return mixed
     */
    private function storeAdminUser($request)
    {
        if (!Auth::user()->isAdministrator())
        {
            abort(403);
        }

        $userService = new UserService();
        $trustedUser = $userService->createAdminUser($request, true);

        $userService->generateResetTokenAndNotifyUser($trustedUser);

        return redirect()
            ->route('admin.user-detail', ['id' => $trustedUser->id])
            ->withsuccess(__("Admin user was activated and reset password option was successfully sent"));

    }

    /**
     * Used just to validate the request
     *
     * @param HostRequestPerson $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdminPerson(HostRequestPerson $request)
    {
        return $this->storeAdminUser($request);
    }

    /**
     * Used just to validate the request
     *
     * @param HostRequestCompany $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdminCompany(HostRequestCompany $request)
    {
        return $this->storeAdminUser($request);
    }

    public function userDetail(int $id)
    {
        $user = User::find($id);

        if ($user->hasRole(User::ROLE_HOST))//can't use isHost() because the user might not be approved
        {
            return redirect()->route('admin.host-detail', ['id' => $user->id]);
        }

        return view('admin.user-detail')
            ->with('user', $user);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function approve(int $id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        $user->approved_at = Carbon::now();
        $user->save();

        return redirect()
            ->route('admin.user-detail', ['id' => $user->id])
            ->withSuccess(__("User was approved"));
    }


    /**
     * @param User $user
     * @return bool
     */
    private function sendResetNotification(User $user)
    {
        /** @var PasswordBroker $broker */
        $broker = Password::broker();

        $response = $broker->sendResetLink(['id' => $user->id]);

        return $response == PasswordBroker::RESET_LINK_SENT;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function resetPassword(int $id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        $this->sendResetNotification($user);

        return redirect()
            ->route('admin.host-detail', ['id' => $user->id])
            ->withSuccess(__("Reset password option was successfully sent"));
    }

}
