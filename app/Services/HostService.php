<?php

namespace App\Services;

use App\Country;
use App\County;
use App\Http\Requests\HostRequestCompany;
use App\Http\Requests\HostRequestPerson;
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
     * @param HostRequestPerson|HostRequestCompany $request
     * @return User
     */
    public function createHost($request): User
    {
        $userService = new UserService();
        $user = $userService->createHostUser($request);

        $this->generateResetTokenAndNotifyUser($user);

        return $user;
    }

    /**
     * @param User $user
     * @return void
     */
    private function generateResetTokenAndNotifyUser(User $user): void
    {
        $resetToken = Password::getRepository()->create($user);

        $notification = new UserCreatedNotification($user, $resetToken);

        Notification::route('mail', $user->email)
            ->notify($notification);
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
