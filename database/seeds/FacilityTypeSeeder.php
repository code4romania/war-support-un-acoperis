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
            FacilityType::create(['id' => 1, 'name' => 'Dotari esentiale (prosoape, lenjerie de pat, sapun, hartie igienica, perne)']);
            FacilityType::create(['id' => 2, 'name' => 'Wi-fi']);
            FacilityType::create(['id' => 3, 'name' => 'Televizor']);
            FacilityType::create(['id' => 4, 'name' => 'Incalzire']);
            FacilityType::create(['id' => 5, 'name' => 'Aer conditionat']);
            FacilityType::create(['id' => 6, 'name' => 'Dulapuri/Sertare']);

            FacilityType::create(['id' => 7, 'name' => 'Detector de fum']);
            FacilityType::create(['id' => 8, 'name' => 'Detector de gaze']);
            FacilityType::create(['id' => 9, 'name' => 'Trusa de prim ajutor']);
            FacilityType::create(['id' => 10, 'name' => 'Extinctor']);
            FacilityType::create(['id' => 11, 'name' => 'Incuietoare la usa dormitorului']);
            FacilityType::create(['id' => 12, 'name' => 'Lift pentru persoane cu dizabilitati']);

            FacilityType::create(['id' => 13, 'name' => 'other']);
        }
    }
}
