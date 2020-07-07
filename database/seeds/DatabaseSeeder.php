<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SirutaImportSeeder::class);
         $this->call(CountriesTableSeeder::class);
         $this->call(CountiesTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(PermissionTableSeeder::class);
    }
}
