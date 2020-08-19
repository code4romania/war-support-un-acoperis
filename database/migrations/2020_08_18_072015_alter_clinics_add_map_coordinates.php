<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClinicsAddMapCoordinates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->decimal('address_lat', 10, 6)->after('address');
            $table->decimal('address_long', 10, 6)->after('address_lat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinics', function(Blueprint $table) {
            $table->dropColumn('address_lat');
            $table->dropColumn('address_long');
        });
    }
}
