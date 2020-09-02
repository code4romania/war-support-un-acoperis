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
        int $country_id,
        string $city,
        string $phone_number,
        string $address = ""
    ): User {

        $host = User::create([
            'name' => $name,
            'email' => $email,
            'country_id' => $country_id,
            'password' => Str::random(16),
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
}
