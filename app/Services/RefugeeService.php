<?php

namespace App\Services;

use App\Http\Requests\ServiceRequest;
use App\Notifications\RefugeeRegisterEmail;
use App\User;
use Illuminate\Support\Facades\Password;

class RefugeeService
{
    public function createRefugee(ServiceRequest $request): User
    {
        $user = (new UserService())->createRefugeeUser($request);

        $user->notify(
            new RefugeeRegisterEmail(
                Password::createToken($user)
            )
        );

        return $user;
    }
}
