<?php

namespace App\Services;

use App\Http\Requests\ServiceRequest;
use App\Notifications\RefugeeRegisterEmail;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

class RefugeeService
{
    public function createRefugee(ServiceRequest $request): User
    {
        $user = (new UserService())->createRefugeeUser($request);

        $notification = new RefugeeRegisterEmail(
            $user,
            Password::getRepository()->create($user)
        );

        Notification::route('mail', $user->email)
            ->notify($notification);

        return $user;
    }
}
