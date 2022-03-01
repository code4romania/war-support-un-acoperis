<?php


namespace App\Services;


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
    /**
     * @param string $name
     * @param string $email
     * @param int $country_id
     * @param string $city
     * @param string $phone_number
     * @param string $address
     */
    public function createUser(
        string $name,
        string $email,
        int    $country_id,
        string $city,
        string $phone_number,
        string $address = null
    ): User
    {

        $host = User::create([
            'name' => $name,
            'email' => $email,
            'country_id' => $country_id,
            'password' => Hash::make(Str::random(16)),
            'city' => $city,
            'address' => $address,
            'phone_number' => $phone_number,
        ]);

        $host->assignRole('host');

        return $host;
    }

    public function generateToken(User $user)
    {
        return app('auth.password.tokens')->create($user);
    }

    public function createRefugeeUser($data): User
    {
        $user = User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'county_id' => $data['county_id'],
                'password' => Hash::make(Str::random(16)),
                'country_id' => self::defaultCountryIdForRefugee,
                'city' => $data['city'],
                'address' => '',
                'phone_number' => $data['phone'],
            ]
        );
        $user->assignRole(User::ROLE_REFUGEE);
        return $user;

    }
}
