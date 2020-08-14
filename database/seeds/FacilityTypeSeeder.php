<?php

use App\FacilityType;
use Illuminate\Database\Seeder;

class FacilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(FacilityType::all()->count())) {
            FacilityType::create(['id' => 1, 'type' => FacilityType::TYPE_GENERAL, 'name' => 'Essential needs (towels, bad sheets, soap, toilet paper, pillows)']);
            FacilityType::create(['id' => 2, 'type' => FacilityType::TYPE_GENERAL, 'name' => 'Wi-Fi']);
            FacilityType::create(['id' => 3, 'type' => FacilityType::TYPE_GENERAL, 'name' => 'TV']);
            FacilityType::create(['id' => 4, 'type' => FacilityType::TYPE_GENERAL, 'name' => 'Heating']);
            FacilityType::create(['id' => 5, 'type' => FacilityType::TYPE_GENERAL, 'name' => 'Air conditioning']);
            FacilityType::create(['id' => 6, 'type' => FacilityType::TYPE_GENERAL, 'name' => 'Cabinets / drawers']);

            FacilityType::create(['id' => 7, 'type' => FacilityType::TYPE_SPECIAL, 'name' => 'Smoke detector']);
            FacilityType::create(['id' => 8, 'type' => FacilityType::TYPE_SPECIAL, 'name' => 'Gas detector']);
            FacilityType::create(['id' => 9, 'type' => FacilityType::TYPE_SPECIAL, 'name' => 'First aid kit']);
            FacilityType::create(['id' => 10, 'type' => FacilityType::TYPE_SPECIAL, 'name' => 'Fire extinguisher']);
            FacilityType::create(['id' => 11, 'type' => FacilityType::TYPE_SPECIAL, 'name' => 'Lock on the bedroom door']);
            FacilityType::create(['id' => 12, 'type' => FacilityType::TYPE_SPECIAL, 'name' => 'Elevator for people with disabilities']);

            FacilityType::create(['id' => 13, 'type' => FacilityType::TYPE_OTHER, 'name' => 'Others facilities']);
        }
    }
}
