<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHelpRequestAddStartAndDuration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_requests', function (Blueprint $table) {
            $table->dateTime('first_housing_day')->nullable()->after('need_special_transport');
            $table->integer('needed_duration')->nullable()->after('first_housing_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_requests', function (Blueprint $table) {
            $table->dropColumn(['first_housing_day', 'needed_duration']);
        });
    }
}
