<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartnersTables extends Migration
{
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->integer('position')->unsigned()->nullable();
            $table->string('url')->nullable();

            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('partner_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'partner');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });




    }

    public function down()
    {

        Schema::dropIfExists('partner_translations');
        Schema::dropIfExists('partners');
    }
}
