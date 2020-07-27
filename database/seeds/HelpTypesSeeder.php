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
            // @see HelpType constants!!!
            HelpType::create(['id' => 1, 'name' => 'Information and guidance to hospitals in the country']);
            HelpType::create(['id' => 2, 'name' => 'Information and guidance to hospitals abroad']);
            HelpType::create(['id' => 3, 'name' => 'Translation of medical documents']);
            HelpType::create(['id' => 4, 'name' => 'Consultancy regarding the raising of funds necessary for the payment of treatments']);
            HelpType::create(['id' => 5, 'name' => 'Allocation of an SMS number for fundraising']);
            HelpType::create(['id' => 6, 'name' => 'Support to find accommodation options near the hospital']);
            HelpType::create(['id' => 7, 'name' => 'Support to find the medications you need']);
            HelpType::create(['id' => 8, 'name' => 'Solving other needs']);
        }
    }
}
