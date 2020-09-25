<?php

use App\Country;
use Illuminate\Database\Seeder;

class PhonePrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (false !== ($json = file_get_contents(
                "http://country.io/phone.json"
            ))) {
            $prefixes = json_decode($json, true);
            $prefixes = array_map(function ($value) { return preg_replace("/^\\+/", "", $value); }, $prefixes);

            $countries = Country::all();

            foreach ($countries as $country) {
                if (!empty($prefixes[$country->code])) {
                    $country->phone_prefix = $prefixes[$country->code];
                    $country->save();
                }
            }
        }
    }
}
