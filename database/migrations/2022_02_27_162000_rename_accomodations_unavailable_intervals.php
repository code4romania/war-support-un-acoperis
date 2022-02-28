<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAccomodationsUnavailableIntervals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('accomodations_unavailable_intervals', 'accommodations_availability_intervals');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('accommodations_availability_intervals', 'accomodations_unavailable_intervals');
    }
}
