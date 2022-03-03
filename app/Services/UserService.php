<?php


namespace App\Services;


use App\Http\Requests\HostRequestCompany;
use App\Http\Requests\HostRequestPerson;
use App\Http\Requests\ServiceRequest;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    const defaultCountryIdForRefugee = 224;
    const defaultCountryId = 178;

    public function generateToken(User $user)
    {
        return app('auth.password.tokens')->create($user);
    }

    public function createRefugeeUser(ServiceRequest $request, bool $approved = false): User
    {
        $userParams = $this->prepareUserParams($request, $approved);
        $userParams['country_id'] = self::defaultCountryIdForRefugee;

        $user = User::create($userParams);
        $user->assignRole(User::ROLE_REFUGEE);
        return $user;
    }

    public function createTrustedUser($request, bool $approved = false): User
    {
        $userParams = $this->prepareUserParams($request, $approved);
        $userParams['country_id'] = self::defaultCountryId;
        $user = User::create($userParams);
        $user->assignRole(User::ROLE_TRUSTED);
        return $user;
    }

    public function createAdminUser($request, bool $approved = false): User
    {
        $userParams = $this->prepareUserParams($request, $approved);
        $userParams['country_id'] = self::defaultCountryId;
        $user = User::create($userParams);
        $user->assignRole(User::ROLE_ADMINISTRATOR);
        return $user;
    }

    /**
     * @param HostRequestPerson|HostRequestCompany $request
     */
    public function createHostUser($request, bool $approved = false): User
    {
        $userParams = $this->prepareUserParams($request, $approved);
        $userParams['country_id'] = self::defaultCountryId;

        if ($request instanceof HostRequestCompany)
        {
            $userParams['legal_representative_name'] = $request->get('legal_representative_name');
            $userParams['company_name'] = $request->get('company_name');
            $userParams['company_tax_id'] = $request->get('company_tax_id');
        }

        $user = User::create($userParams);
        $user->assignRole(User::ROLE_HOST);

        return $user;
    }

    /**
     * @param HostRequestCompany|HostRequestPerson|ServiceRequest $request
     * @return array
     */
    private function prepareUserParams($request, bool $approved = true): array
    {
        $userParams = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make(Str::random(10)),
            'remember_token' => Str::random(10),
            'country_id' => $request->get('country_id'),
            'county_id' => $request->get('county_id'),
            'city' => $request->get('city'),
            'address' => $request->get('address'),
            'phone_number' => $request->get('phone'),
            ];

        if ($approved)
        {
            $userParams['approved_at'] = now();
        }

        return $userParams;
    }

}
