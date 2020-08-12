<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_resources', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 64);
            $table->unsignedBigInteger('country_id');
            $table->string('city', 64);
            $table->string('address', 256)->nullable();
            $table->string('phone_number', 64)->nullable();
            $table->string('email', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('help_resources');
    }
}
