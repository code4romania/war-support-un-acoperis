<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TwillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('seeds/sql/twill-seeder.sql');
        DB::unprepared(file_get_contents($path));
    }
}
