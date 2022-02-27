<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesToHelpRequestAccommodationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_request_accommodation_details', function (Blueprint $table) {
            $table->string("current_location")->nullable();
            $table->double("current_location_lat")->nullable();
            $table->double("current_location_long")->nullable();
            $table->string("known_languages")->nullable();
            $table->boolean("has_dependants_family")->nullable();
            $table->longText("more_details")->nullable();
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
            $table->dropColumn("current_location");
            $table->dropColumn("current_location_lat");
            $table->dropColumn("current_location_long");
            $table->dropColumn("known_languages");
            $table->dropColumn("has_dependants_family");
            $table->dropColumn("more_details");
        });
    }
}
