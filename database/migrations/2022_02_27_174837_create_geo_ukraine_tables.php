<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoUkraineTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ua_regions', function (Blueprint $table) {
            $table->id();
            $table->string("country", 2)->nullable()->index();
            $table->string("region", 22)->nullable()->index();
            $table->string("region_en", 144)->nullable();
            $table->string("region_ru", 144)->nullable();
            $table->string("region_uk", 144)->nullable();
            $table->timestamps();
        });

        Schema::create('ua_cities', function (Blueprint $table) {
            $table->id();
            $table->string("country", 2)->nullable()->index();
            $table->string("region", 22)->nullable()->index();
            $table->boolean("capital")->nullable()->index();
            $table->boolean("major")->nullable()->index();
            $table->string("city_en", 144)->nullable();
            $table->string("city_ru", 144)->nullable();
            $table->string("city_uk", 144)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ua_cities');
        Schema::dropIfExists('ua_regions');
    }
}
