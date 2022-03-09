<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_reviews', function (Blueprint $table) {
            $table->id();
            $table->text('review');
            $table->tinyInteger('rating');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('accommodation_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('accommodation_id')->references('id')->on('accommodations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodation_reviews');
    }
}
