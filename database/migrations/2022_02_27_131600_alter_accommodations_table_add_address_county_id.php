<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAccommodationsTableAddAddressCountyId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->unsignedBigInteger('address_county_id')
                ->after('address_country_id');

            $table->foreign('address_county_id')
                ->references('id')
                ->on('counties');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->dropForeign('address_country_id');
            $table->dropColumn('address_country_id');
        });
    }
}
