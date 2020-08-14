<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accommodation_type_id');
            $table->tinyInteger('ownership_type');
            $table->boolean('is_fully_available');
            $table->tinyInteger('max_guests');
            $table->tinyInteger('available_rooms');
            $table->tinyInteger('available_bathrooms');
            $table->boolean('is_kitchen_available');
            $table->boolean('is_parking_available');
            $table->boolean('is_smoking_allowed');
            $table->boolean('is_pet_allowed');
            $table->string('description', 5000);
            $table->unsignedBigInteger('address_country_id');
            $table->string('address_city', 64);
            $table->string('address_street', 64);
            $table->string('address_building', 64);
            $table->string('address_entry', 64);
            $table->string('address_apartment', 64);
            $table->string('address_floor', 64);
            $table->string('address_postal_code', 64);
            $table->string('other_rules', 255);
            $table->boolean('is_free');
            $table->string('phone_number', 64);
            $table->string('transport_subway_distance', 64);
            $table->string('transport_bus_distance', 64);
            $table->string('transport_railway_distance', 64);
            $table->string('transport_other_details', 64);
            $table->time('checkin_hour', 0);
            $table->time('checkout_hour', 0);
            $table->string('general_fee', 64);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('accommodation_type_id')
                ->references('id')
                ->on('accommodation_types');

            $table->foreign('address_country_id')
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
        Schema::dropIfExists('accommodations');
    }
}
