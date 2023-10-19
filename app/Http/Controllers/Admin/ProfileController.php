<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Admin
 */
class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        return view('admin.profile')
            ->with('user', $user);
    }

    /**
     * @return View
     */
    public function editProfile()
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(404);
        }

        /** @var Collection $countries */
        $countries = Country::all();

        return view('admin.edit-profile')
            ->with('user', $user)
            ->with('countries', $countries);
    }

    /**
     * @param EditProfileRequest $request
     * @return RedirectResponse
     */
    public function saveProfile(EditProfileRequest $request)
    {
        $user = Auth::user();

        if (empty($user)) {
            abort(404);
        }

        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->country_id = $request->post('country');
        $user->city = $request->post('city');
        $user->address = $request->post('address');
        $user->phone_number = $request->post('phone');
        $user->save();

        return redirect()
            ->route('admin.profile')
            ->withSuccess(__('Data successfully saved!'));
    }

    /**
     * @return View
     */
    public function resetPassword()
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        return view('admin.reset-password')
            ->with('user', $user);
    }

    /**
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     */
    public function saveResetPassword(ResetPasswordRequest $request)
    {
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        $user->password = Hash::make($request->post('password'));
        $user->save();

        return redirect()
            ->route('admin.profile')
            ->withSuccess(__('Data successfully saved!'));
    }
}
