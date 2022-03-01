<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHelpRequestsTableChangeCityAndCounty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_requests', function (Blueprint $table) {
            $table->dropForeign('help_requests_city_id_foreign');
            $table->dropColumn('city_id');

            $table->string('city', 64)
                ->after('county_id');

            $table->dropForeign('help_requests_county_id_foreign');

            $table->foreign('county_id')
                ->references('id')
                ->on('ua_regions');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
