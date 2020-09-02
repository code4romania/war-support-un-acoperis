<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAccomodationsUnavailableIntervals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accomodations_unavailable_intervals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accommodation_id');
            $table->timestamp('from_date');
            $table->timestamp('to_date');
            $table->timestamps();
        });

        DB::statement("
            INSERT INTO accomodations_unavailable_intervals
                (accommodation_id, from_date, to_date, created_at)
            SELECT id, unavailable_from_date, unavailable_to_date, NOW()
            FROM accommodations WHERE unavailable_from_date IS NOT NULL AND unavailable_to_date IS NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accomodations_unavailable_intervals');
    }
}
