<?php

use App\County;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CountiesTableSeeder
 */
class CountiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(County::all()->count())) {
            DB::table('siruta')
                ->where('NIV', '=', 1)
                ->orderBy('SIRUTA', 'ASC')
                ->each(function ($line) {
                    $countyName = trim(str_ireplace(['JUDETUL', 'MUNICIPIUL'], '', $line->DENLOC));

                    $countyTranslations = [];
                    foreach ($this->getCountyTranslations($this->getCountyCode($countyName)) as $locale => $translation) {
                        $countyTranslations[] = [
                            'county_id' => $line->JUD,
                            'locale' => $locale,
                            'name'  => $translation,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }

                    DB::table('counties')->insert([
                        ['id' => $line->JUD, 'name' => ucfirst(strtolower($countyName)), 'code' => $this->getCountyCode($countyName),  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
                    ]);

                    if(count($countyTranslations) > 0) {
                        DB::table('county_translations')->insert($countyTranslations);
                    }
                });
        }
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
        $countyCodes['OLT'] = 'OL';
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
        $countyCodes['VRANCEA'] = 'VR';
        $countyCodes['BUCURESTI'] = 'B';
        $countyCodes['CALARASI'] = 'CL';
        $countyCodes['GIURGIU'] = 'GR';

        return $countyCodes[$county];
    }

    public function getCountyTranslations($code) {
        $json = '{"AB":{"ru":"Алба","uk":"Алба","ro":"Alba","en":"Alba"},"AR":{"ru":"Арад","uk":"Арад","ro":"Arad","en":"Arad"},"AG":{"ru":"Арджеш","uk":"Арджеш","ro":"Argeș","en":"Argeș"},"BC":{"ru":"Бакэу","uk":"Бакэу","ro":"Bacău","en":"Bacău"},"BH":{"ru":"Бихор","uk":"Бихор","ro":"Bihor","en":"Bihor"},"BN":{"ru":"Бистрица-Нэсэуд","uk":"Бистрица-Нэсэуд","ro":"Bistrița-Năsăud","en":"Bistrița-Năsăud"},"BT":{"ru":"Ботошани","uk":"Ботошани","ro":"Botoșani","en":"Botoșani"},"BV":{"ru":"Брашов","uk":"Брашов","ro":"Brașov","en":"Brașov"},"BR":{"ru":"Брэила","uk":"Брэила","ro":"Brăila","en":"Brăila"},"B":{"ru":"Бухарест","uk":"Бухарест","ro":"București","en":"București"},"BZ":{"ru":"Бузэу","uk":"Бузэу","ro":"Buzău","en":"Buzău"},"CL":{"ru":"Кэлэраши","uk":"Кэлэраши","ro":"Călărași","en":"Călărași"},"CS":{"ru":"Караш-Северин","uk":"Караш-Северин","ro":"Caraș-Severin","en":"Caraș-Severin"},"CJ":{"ru":"Клуж","uk":"Клуж","ro":"Cluj","en":"Cluj"},"CT":{"ru":"Констанца","uk":"Констанца","ro":"Constanța","en":"Constanța"},"CV":{"ru":"Ковасна","uk":"Ковасна","ro":"Covasna","en":"Covasna"},"DB":{"ru":"Дымбовица","uk":"Дымбовица","ro":"Dâmbovița","en":"Dâmbovița"},"DJ":{"ru":"Долж","uk":"Долж","ro":"Dolj","en":"Dolj"},"GL":{"ru":"Галац","uk":"Галац","ro":"Galați","en":"Galați"},"GR":{"ru":"Джурджу","uk":"Джурджу","ro":"Giurgiu","en":"Giurgiu"},"GJ":{"ru":"Горж","uk":"Горж","ro":"Gorj","en":"Gorj"},"HR":{"ru":"Харгита","uk":"Харгита","ro":"Harghita","en":"Harghita"},"HD":{"ru":"Хунедоара","uk":"Хунедоара","ro":"Hunedoara","en":"Hunedoara"},"IL":{"ru":"Яломица","uk":"Яломица","ro":"Ialomița","en":"Ialomița"},"IS":{"ru":"Яссы","uk":"Яссы","ro":"Iași","en":"Iași"},"IF":{"ru":"Илфов","uk":"Илфов","ro":"Ilfov","en":"Ilfov"},"MM":{"ru":"Марамуреш","uk":"Марамуреш","ro":"Maramureș","en":"Maramureș"},"MH":{"ru":"Мехединци","uk":"Мехединци","ro":"Mehedinți","en":"Mehedinți"},"MS":{"ru":"Муреш","uk":"Муреш","ro":"Mureș","en":"Mureș"},"NT":{"ru":"Нямц","uk":"Нямц","ro":"Neamț","en":"Neamț"},"OT":{"ru":"Олт","uk":"Олт","ro":"Olt","en":"Olt"},"PH":{"ru":"Прахова","uk":"Прахова","ro":"Prahova","en":"Prahova"},"SM":{"ru":"Сату-Маре","uk":"Сату-Маре","ro":"Satu Mare","en":"Satu Mare"},"SJ":{"ru":"Сэлаж","uk":"Сэлаж","ro":"Sălaj","en":"Sălaj"},"SB":{"ru":"Сибиу","uk":"Сибиу","ro":"Sibiu","en":"Sibiu"},"SV":{"ru":"Сучава","uk":"Сучава","ro":"Suceava","en":"Suceava"},"TR":{"ru":"Телеорман","uk":"Телеорман","ro":"Teleorman","en":"Teleorman"},"TM":{"ru":"Тимиш","uk":"Тимиш","ro":"Timiș","en":"Timiș"},"TL":{"ru":"Тулча","uk":"Тулча","ro":"Tulcea","en":"Tulcea"},"VS":{"ru":"Васлуй","uk":"Васлуй","ro":"Vaslui","en":"Vaslui"},"VL":{"ru":"Вылча","uk":"Вылча","ro":"Vâlcea","en":"Vâlcea"},"VN":{"ru":"Вранча","uk":"Вранча","ro":"Vrancea","en":"Vrancea"}}';

        $translations = json_decode($json, true);

        return $translations[$code] ?? [];
    }
}
