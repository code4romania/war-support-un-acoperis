<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpRequestDependants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_request_dependants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('help_request_id')->nullable();
            $table->text('full_name', 100)->nullable();
            $table->integer('age')->nullable();
            $table->text('mentions')->nullable();
            $table->timestamps();

            $table->foreign('help_request_id')->references('id')->on('help_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_request_dependants');
    }
}
