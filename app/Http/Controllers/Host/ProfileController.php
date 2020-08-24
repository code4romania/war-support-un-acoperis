<?php

namespace App\Http\Controllers\Host;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Host
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

        return view('host.profile')
            ->with('user', $user);
    }

    /**
     * @return View
     */
    public function editProfile()
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Collection $countries */
        $countries = Country::all();

        return view('host.edit-profile')
            ->with('user', $user)
            ->with('countries', $countries);
    }


    public function saveProfile(EditProfileRequest $request)
    {
        dd($request);
    }

    /**
     * @return View
     */
    public function resetPassword()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('host.reset-password')
            ->with('user', $user);
    }
}
