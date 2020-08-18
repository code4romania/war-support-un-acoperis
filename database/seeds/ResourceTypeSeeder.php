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
            ResourceType::create(['id' => 1, 'name' => 'accommodation', 'options' => ResourceType::OPTION_ALERT]);
            ResourceType::create(['id' => 2, 'name' => 'transport', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 3, 'name' => 'meds', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 4, 'name' => 'goods', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 5, 'name' => 'translations', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 6, 'name' => 'services', 'options' => ResourceType::OPTION_NONE]);
            ResourceType::create(['id' => 7, 'name' => 'other', 'options' => ResourceType::OPTION_MESSAGE]);
        }
    }
}
