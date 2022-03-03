<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class AdminUserSeeder
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(User::all()->count())) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@code4.ro',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'country_id'=> 178,
                'county_id'=>1,
                'city'  => 'Iasi',
                'approved_at' => now(),]);
            $user->assignRole(User::ROLE_ADMINISTRATOR);
            $user = User::create([
                'name' => 'Host',
                'email' => 'host@code4.ro',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'country_id'=> 178,
                'county_id'=>1,
                'city'  => 'Iasi',
                'approved_at' => now(),]);
            $user->assignRole(User::ROLE_HOST);
            $user = User::create([
                'name' => 'Trusted',
                'email' => 'trusted@code4.ro',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'country_id'=> 178,
                'county_id'=>1,
                'city'  => 'Iasi',
                'approved_at' => now(),]);
            $user->assignRole(User::ROLE_TRUSTED);

            $user = User::create([
                'name' => 'Refugee',
                'email' => 'refugee@code4.ro',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'country_id'=> 178,
                'county_id'=>1,
                'city'  => 'Iasi',
                'approved_at' => now(),]);
            $user->assignRole(User::ROLE_REFUGEE);
        }
    }
}
