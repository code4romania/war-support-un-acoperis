<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHelpRequestAccommodationDetailsTable
 */
class CreateHelpRequestAccommodationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_request_accommodation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('help_request_id');
            $table->string('clinic', 128)->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('city', 255);
            $table->tinyInteger('guests_number')->unsigned();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('special_request')->nullable();
            $table->timestamps();

            $table->foreign('help_request_id')
                ->references('id')
                ->on('help_requests');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_request_accomodation_details');
    }
}
