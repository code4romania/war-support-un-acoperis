<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAccommodationsTableChangeColumnsFromTinyintToInt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->smallInteger('max_guests')->change();
            $table->smallInteger('available_rooms')->change();
            $table->smallInteger('available_beds')->change();
            $table->smallInteger('available_bathrooms')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tinyint_to_int', function (Blueprint $table) {
            //
        });
    }
}
