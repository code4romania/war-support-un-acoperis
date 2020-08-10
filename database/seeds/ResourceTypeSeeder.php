<?php

use App\ResourceType;
use Illuminate\Database\Seeder;

class ResourceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(ResourceType::all()->count())) {
            ResourceType::create(['id' => 1, 'name' => 'Cazare']);
            ResourceType::create(['id' => 2, 'name' => 'Transport']);
            ResourceType::create(['id' => 3, 'name' => 'Medicamente']);
            ResourceType::create(['id' => 4, 'name' => 'Bunuri']);
            ResourceType::create(['id' => 5, 'name' => 'Traduceri acte medicale']);
            ResourceType::create(['id' => 6, 'name' => 'Servicii']);
            ResourceType::create(['id' => 7, 'name' => 'Alte tipuri de ajutor']);
        }
    }
}
