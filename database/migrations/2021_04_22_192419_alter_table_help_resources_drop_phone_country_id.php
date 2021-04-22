<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableHelpResourcesDropPhoneCountryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_resources', function (Blueprint $table) {
            $table->dropForeign('help_resources_phone_country_id_foreign');
            $table->dropColumn('phone_country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_resources', function (Blueprint $table) {
            //
        });
    }
}
