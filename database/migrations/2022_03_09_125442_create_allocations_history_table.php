<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocations_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('help_request_id')->references('id')->on('help_requests');
            $table->foreignId('refugee_id')->references('id')->on('users');
            $table->foreignId('accommodation_id')->references('id')->on('accommodations');
            $table->foreignId('host_id')->references('id')->on('users');
            $table->unsignedInteger('number_of_guest');
            $table->timestamp('from')->nullable();
            $table->timestamp('to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocations_history');
    }
}
