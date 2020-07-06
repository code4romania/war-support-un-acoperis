<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHelpRequestsTable
 */
class CreateHelpRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_requests', function (Blueprint $table) {
            $table->id();
            $table->string('patient_full_name', 64);
            $table->string('patient_phone_number', 64)->nullable();
            $table->string('patient_email', 64)->nullable();
            $table->string('caretaker_full_name', 64)->nullable();
            $table->string('caretaker_phone_number', 64)->nullable();
            $table->string('caretaker_email', 64)->nullable();
            $table->unsignedBigInteger('county_id');
            $table->unsignedBigInteger('city_id');
            $table->string('diagnostic', 128)->nullable();
            $table->text('extra_details')->nullable();
            $table->string('status', 16);
            $table->timestamps();

            $table->foreign('county_id')
                ->references('id')
                ->on('counties');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_requests');
    }
}
