<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAccomodationsRemoveUnavailableInterval extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->dropColumn('unavailable_from_date');
            $table->dropColumn('unavailable_to_date');
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
            $table->timestamp('unavailable_from_date')->nullable();
            $table->timestamp('unavailable_to_date')->nullable();
        });
    }
}
