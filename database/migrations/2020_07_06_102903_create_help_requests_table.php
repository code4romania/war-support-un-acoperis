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
            $table->unsignedBigInteger('user_id');
            $table->enum('status',['padding','allocated','in_progress','fulfilled'])->default('padding');
            $table->string('current_location');
            $table->unsignedInteger('guests_number')->default(1);
            $table->json('known_languages');
            $table->string('special_needs')->nullable();
            $table->json('with_peoples')->nullable();
            $table->text('more_details');
            $table->boolean('need_car')->default(false);
            $table->boolean('need_special_transport')->default(false);
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
