<?php

use App\HelpType;
use Illuminate\Database\Seeder;

/**
 * Class HelpTypesSeeder
 */
class HelpTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(HelpType::all()->count())) {
            HelpType::create(['name' => 'Information and guidance to hospitals in the country']);
            HelpType::create(['name' => 'Information and guidance to hospitals abroad']);
            HelpType::create(['name' => 'Translation of medical documents']);
            HelpType::create(['name' => 'Consultancy regarding the raising of funds necessary for the payment of treatments']);
            HelpType::create(['name' => 'Allocation of an SMS number for fundraising']);
            HelpType::create(['name' => 'Support to find accommodation options near the hospital']);
            HelpType::create(['name' => 'Support to find the medications you need']);
            HelpType::create(['name' => 'Solving other needs']);
        }
    }
}
