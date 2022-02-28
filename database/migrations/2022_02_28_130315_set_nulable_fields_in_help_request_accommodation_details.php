<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNulableFieldsInHelpRequestAccommodationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_request_accommodation_details', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable()->change();
            $table->string('city', 255)->nullable()->change();
            $table->unsignedSmallInteger('guests_number')->nullable()->change();
            $table->date('start_date')->nullable()->change();
            $table->date('end_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_request_accommodation_details', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->change();
            $table->string('city', 255)->change();
            $table->unsignedSmallInteger('guests_number')->change();
            $table->date('start_date')->change();
            $table->date('end_date')->change();
        });
    }
}
