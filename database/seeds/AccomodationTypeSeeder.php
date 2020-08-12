<?php

use App\AccommodationType;
use Illuminate\Database\Seeder;

class AccomodationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(AccommodationType::all()->count())) {
            AccommodationType::create(['id' => 1, 'name' => 'Garsoniera']);
            AccommodationType::create(['id' => 2, 'name' => 'Apartament']);
            AccommodationType::create(['id' => 3, 'name' => 'Casa']);
        }
    }
}
