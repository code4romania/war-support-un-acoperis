<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountyTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('county_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('county_id');
            $table->enum('locale', ['en', 'ro', 'uk', 'ru']);
            $table->string('name', 64);
            $table->timestamps();
            $table->foreign('county_id')->references('id')->on('counties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('county_translations');
    }
}
