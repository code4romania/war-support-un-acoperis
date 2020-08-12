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
            ResourceType::create(['id' => 1, 'name' => 'Cazare', 'options' => ResourceType::OPTION_ALERT]);
            ResourceType::create(['id' => 2, 'name' => 'Transport', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 3, 'name' => 'Medicamente', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 4, 'name' => 'Bunuri', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 5, 'name' => 'Traduceri acte medicale', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 6, 'name' => 'Servicii', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 7, 'name' => 'Alte tipuri de ajutor', 'options' => ResourceType::OPTION_MESSAGE]);
        }
    }
}
