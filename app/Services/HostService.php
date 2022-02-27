<?php

namespace App\Services;

use App\Http\Requests\HostRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class HostService
{

    public function createHost(HostRequest $request): User
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make(Str::random(10)),
            'remember_token' => Str::random(10),
            //@TODO: should this be hardcoded? There is no country field in the UI
            'country_id'=> DB::table('countries')->where('code', 'RO')->first()->id,
            'county_id'  => $request->get('county_id'),
            'city'  => $request->get('city'),
            'address' => $request->get('address'),
            'phone_number' => $request->get('phone'),
            'approved_at' => now(),]);
        $user->assignRole(User::ROLE_HOST);

        $resetToken = Password::getRepository()->create($user);

        $notification = new \App\Notifications\HostSignup($user, $resetToken);

        Notification::route('mail', $user->email)
            ->notify($notification);

        return $user;
    }
}
