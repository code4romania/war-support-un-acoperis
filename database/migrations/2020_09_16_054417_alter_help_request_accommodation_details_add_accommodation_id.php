<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHelpRequestAccommodationDetailsAddAccommodationId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_request_accommodation_details', function (Blueprint $table) {
            $table->unsignedBigInteger('accommodation_id')->nullable();

//            $table->foreign('accommodation_id')
//                ->references('id')
//                ->on('accommodations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_request_accommodation_details', function(Blueprint $table) {
//            $table->dropForeign('accommodation_id');
            $table->dropColumn('accommodation_id');
        });
    }
}
