<?php

use App\County;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Traits\Localizable;

/**
 * Class CountiesTableSeeder
 */
class CountiesTableSeeder extends Seeder
{
    use Localizable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (County::count()) {
            return;
        }

        $counties = [];
        $translations = [];

        DB::table('siruta')
            ->where('NIV', '=', 1)
            ->orderBy('SIRUTA', 'ASC')
            ->each(function ($line) use (&$counties, &$translations) {
                $countyName = trim(str_ireplace(['JUDETUL', 'MUNICIPIUL'], '', $line->DENLOC));
                $countyCode = $this->getCountyCode($countyName);

                $counties[] = [
                    'id' => $line->JUD,
                    // 'name' => ucfirst(strtolower($countyName)),
                    'code' => $countyCode,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                foreach (config('translatable.locales') as $locale) {
                    $translations[] = [
                        'county_id' => $line->JUD,
                        'locale' => $locale,
                        'name'  => $this->withLocale($locale, fn () => __("counties.{$countyCode}")),
                    ];
                }
            });

        DB::table('counties')->insert($counties);
        DB::table('county_translations')->insert($translations);
    }

    /**
     * @param string $county
     * @return string
     */
    public function getCountyCode(string $county): string
    {
        $countyCodes = [];
        $countyCodes['ALBA'] = 'AB';
        $countyCodes['ARAD'] = 'AR';
        $countyCodes['ARGES'] = 'AG';
        $countyCodes['BACAU'] = 'BC';
        $countyCodes['BIHOR'] = 'BH';
        $countyCodes['BISTRITA-NASAUD'] = 'BN';
        $countyCodes['BOTOSANI'] = 'BT';
        $countyCodes['BRASOV'] = 'BV';
        $countyCodes['BRAILA'] = 'BR';
        $countyCodes['BUZAU'] = 'BZ';
        $countyCodes['CARAS-SEVERIN'] = 'CS';
        $countyCodes['CLUJ'] = 'CJ';
        $countyCodes['CONSTANTA'] = 'CT';
        $countyCodes['COVASNA'] = 'CV';
        $countyCodes['DAMBOVITA'] = 'DB';
        $countyCodes['DOLJ'] = 'DJ';
        $countyCodes['GALATI'] = 'GL';
        $countyCodes['GORJ'] = 'GJ';
        $countyCodes['HARGHITA'] = 'HR';
        $countyCodes['HUNEDOARA'] = 'HD';
        $countyCodes['IALOMITA'] = 'IL';
        $countyCodes['IASI'] = 'IS';
        $countyCodes['ILFOV'] = 'IF';
        $countyCodes['MARAMURES'] = 'MM';
        $countyCodes['MEHEDINTI'] = 'MH';
        $countyCodes['MURES'] = 'MS';
        $countyCodes['NEAMT'] = 'NT';
        $countyCodes['OLT'] = 'OT';
        $countyCodes['PRAHOVA'] = 'PH';
        $countyCodes['SATU MARE'] = 'SM';
        $countyCodes['SALAJ'] = 'SJ';
        $countyCodes['SIBIU'] = 'SB';
        $countyCodes['SUCEAVA'] = 'SV';
        $countyCodes['TELEORMAN'] = 'TR';
        $countyCodes['TIMIS'] = 'TM';
        $countyCodes['TULCEA'] = 'TL';
        $countyCodes['VASLUI'] = 'VS';
        $countyCodes['VALCEA'] = 'VL';
        $countyCodes['VRANCEA'] = 'VN';
        $countyCodes['BUCURESTI'] = 'B';
        $countyCodes['CALARASI'] = 'CL';
        $countyCodes['GIURGIU'] = 'GR';

        return $countyCodes[$county];
    }
}
