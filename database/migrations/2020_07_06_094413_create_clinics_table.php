<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateClinicsTable
 */
class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->index();
            $table->text('description')->nullable();
            $table->text('additional_information')->nullable();
            $table->text('transport_details')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('city', 64);
            $table->string('address', 256)->nullable();
            $table->string('phone_number', 64)->nullable();
            $table->string('website', 256)->nullable();
            $table->string('contact_person_name', 64)->nullable();
            $table->string('contact_person_phone', 64)->nullable();
            $table->string('contact_person_email', 64)->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('clinics');
    }
}
