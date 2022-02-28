<?php

namespace App\Services;

use App\Http\Requests\HostRequestCompany;
use App\Http\Requests\HostRequestPerson;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class HostService
{

    public function createHostPerson(HostRequestPerson $request): User
    {
        $user = User::create($this->prepareUserParams($request));
        $user->assignRole(User::ROLE_HOST);

        $this->generateResetTokenAndNotifyUser($user);

        return $user;
    }

    public function createHostCompany(HostRequestCompany $request): User
    {
        $userParams = $this->prepareUserParams($request);

        $userParams['legal_representative_name'] = $request->get('legal_representative_name');
        $userParams['company_name'] = $request->get('company_name');
        $userParams['company_tax_id'] = $request->get('company_tax_id');

        $user = User::create($userParams);

        $user->assignRole(User::ROLE_HOST);

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

        $notification = new \App\Notifications\HostSignup($user, $resetToken);

        Notification::route('mail', $user->email)
            ->notify($notification);
    }

    /**
     * @param HostRequestCompany|HostRequestPerson $request
     * @return array
     */
    private function prepareUserParams($request): array
    {
        return [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make(Str::random(10)),
            'remember_token' => Str::random(10),
            //@TODO: should this be hardcoded? There is no country field in the UI
            'country_id' => DB::table('countries')->where('code', 'RO')->first()->id,
            'county_id' => $request->get('county_id'),
            'city' => $request->get('city'),
            'address' => $request->get('address'),
            'phone_number' => $request->get('phone'),
            'approved_at' => now(),];
    }

}
