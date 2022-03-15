<?php

use App\County;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Traits\Localizable;

class CreateCountyTranslationsTable extends Migration
{
    use Localizable;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('county_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('county_id')
                ->constrained('counties')
                ->cascadeOnDelete();

            $table->string('locale')->index();
            $table->string('name')->nullable();

            $table->unique(['locale', 'county_id']);
        });

        County::all()->each(function (County $county) {
            $attributes = [];

            foreach (config('translatable.locales') as $locale) {
                $attributes[$locale] = [
                    'name' => $this->withLocale($locale, fn () => __("counties.{$county->code}"))
                ];
            }

            $county->update($attributes);
        });

        Schema::table('counties', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counties', function (Blueprint $table) {
            $table->string('name', 100)->after('code');
        });

        Schema::dropIfExists('county_translations');
    }
}
