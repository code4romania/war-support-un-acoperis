<?php

namespace App\Services;

use App\Country;
use App\County;
use App\Http\Requests\HostCompanyRequest;
use App\Http\Requests\HostPersonRequest;
use App\Notifications\UserCreatedNotification;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class HostService
{

    /**
     * @param HostPersonRequest|HostCompanyRequest $request
     * @return User
     */
    public function createHost($request): User
    {
        $userService = new UserService();
        $user = $userService->createHostUser($request);

        $userService->generateResetTokenAndNotifyUser($user);

        return $user;
    }

    public function viewSignupForm(string $view, ?string $description = null)
    {
        return view($view)
            ->with('hostType', old('host_type_copy'))
            ->with('countries', Country::all())
            ->with('counties', County::all())
            ->with('description', $description);
    }
}
