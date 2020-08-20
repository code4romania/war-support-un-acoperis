<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateTranslations extends Command
{
    const RESOURCES_LANG_SOURCE_JSON = 'resources/lang/ro.json';
    const RESOURCES_LANG_DESTINATION_JSON = 'resources/lang/en.json';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates ' . self::RESOURCES_LANG_DESTINATION_JSON . ' missing translations from ' . self::RESOURCES_LANG_SOURCE_JSON;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // read language files
        $sourceTranslations = json_decode(file_get_contents(base_path(self::RESOURCES_LANG_SOURCE_JSON)), true);
        $destinationTranslationsFile = base_path(self::RESOURCES_LANG_DESTINATION_JSON);
        $destinationTranslations = json_decode(file_get_contents($destinationTranslationsFile), true);

        // add missing translations into destination language
        $addedTranslations = 0;
        foreach ($sourceTranslations as $translationKey => $destinationTranslation) {
            if (!array_key_exists($translationKey, $destinationTranslations)) {
                $destinationTranslations[$translationKey] = $translationKey;
                $addedTranslations++;
            }
        }

        // write destination language file
        $fp = fopen($destinationTranslationsFile, 'w');
        fwrite($fp, json_encode($destinationTranslations, JSON_PRETTY_PRINT));
        fclose($fp);

        $this->info("Done! {$addedTranslations} added.");

        return 0;
    }
}
