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
            FacilityType::create(['id' => 1, 'name' => 'Essential needs (towels, bad sheets, soap, toilet paper, pillows)']);
            FacilityType::create(['id' => 2, 'name' => 'Wi-Fi']);
            FacilityType::create(['id' => 3, 'name' => 'TV']);
            FacilityType::create(['id' => 4, 'name' => 'Heating']);
            FacilityType::create(['id' => 5, 'name' => 'Air conditioning']);
            FacilityType::create(['id' => 6, 'name' => 'Cabinets / drawers']);

            FacilityType::create(['id' => 7, 'name' => 'Smoke detector']);
            FacilityType::create(['id' => 8, 'name' => 'Gas detector']);
            FacilityType::create(['id' => 9, 'name' => 'First aid kit']);
            FacilityType::create(['id' => 10, 'name' => 'Fire extinguisher']);
            FacilityType::create(['id' => 11, 'name' => 'Lock on the bedroom door']);
            FacilityType::create(['id' => 12, 'name' => 'Elevator for people with disabilities']);

            FacilityType::create(['id' => 13, 'name' => 'Others needs']);
        }
    }
}
