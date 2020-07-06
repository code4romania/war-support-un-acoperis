<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

/**
 * Class SirutaImportSeeder
 */
class SirutaImportSeeder extends CsvSeeder
{
    /**
     * SirutaImportSeeder constructor.
     */
    public function __construct()
    {
        $this->insert_chunk_size = 1;
        $this->csv_delimiter = ';';
        $this->table = 'siruta';
        $this->filename = base_path() . '/database/seeds/csv/siruta.csv';
    }

    public function run()
    {
        if (empty(DB::table('siruta')->count())) {
            DB::disableQueryLog();
            parent::run();
        }
    }
}
