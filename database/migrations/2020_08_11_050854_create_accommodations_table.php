<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAccommodationsTable
 */
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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('accommodation_type_id');
            $table->string('ownership_type', 16);
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
            $table->string('address_street', 128)->nullable();
            $table->string('address_building', 16)->nullable();
            $table->string('address_entry', 16)->nullable();
            $table->string('address_apartment', 16)->nullable();
            $table->string('address_floor', 16)->nullable();
            $table->string('address_postal_code', 16)->nullable();
            $table->string('other_rules', 255)->nullable();
            $table->boolean('is_free');
            $table->string('transport_subway_distance', 64)->nullable();
            $table->string('transport_bus_distance', 64)->nullable();
            $table->string('transport_railway_distance', 64)->nullable();
            $table->string('transport_other_details', 64)->nullable();
            $table->string('general_fee', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('accommodation_type_id')
                ->references('id')
                ->on('accommodation_types');

            $table->foreign('address_country_id')
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
        Schema::dropIfExists('accommodations');
    }
}
