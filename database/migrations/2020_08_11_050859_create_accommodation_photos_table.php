<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accommodation_id');
            $table->string('name', 255);
            $table->string('path', 255);
            $table->unsignedMediumInteger('size');
            $table->string('extension', 5)->nullable();
            $table->string('type', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['accommodation_id', 'name']);

            $table->foreign('accommodation_id')
                ->references('id')
                ->on('accommodations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodation_photos');
    }
}
