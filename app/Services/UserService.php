<?php


namespace App\Services;


use App\User;
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
    ) {
        $password = Str::random(24);

        $host = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'country_id' => $country_id,
            'city' => $city,
            'address' => $address,
            'phone_number' => $phone_number,
        ]);

        $host->assignRole('host');

        Log::info($password);
    }
}
