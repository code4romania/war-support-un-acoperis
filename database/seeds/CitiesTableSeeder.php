<?php

use App\City;
use App\County;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CitiesTableSeeder
 */
class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(City::all()->count())) {
            DB::table('siruta')
                ->where('NIV', '=', 3)
                ->orderBy('SIRUTA', 'ASC')
                ->each(function ($line) {
                    $name = $line->DENLOC;

                    /** @var County $county */
                    $county = County::find($line->JUD);

                    $sirutaParent = DB::table('siruta')->where('SIRUTA', '=', $line->SIRSUP)->first();

                    if (!empty($sirutaParent)) {
                        $parentName = trim(str_ireplace(['MUNICIPIUL', 'ORAS'], '', $sirutaParent->DENLOC));

                        if (strtolower($parentName) != strtolower($name)) {
                            $name .= ', ' . $parentName;
                        }
                    }

                    DB::table('cities')->insert([
                        ['name' => ucwords(strtolower($name), " -\t\r\n\f\v"), 'short_name' => ucwords(strtolower($line->DENLOC), " -\t\r\n\f\v"), 'county_id' => $county->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                    ]);
                });
        }
    }
}
