<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHelpRequestSmsDetailsTable
 */
class CreateHelpRequestSmsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_request_sms_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('help_request_id');
            $table->string('amount', 32);
            $table->string('purpose', 128)->nullable();
            $table->string('clinic', 128)->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('city', 255);
            $table->timestamps();

            $table->foreign('help_request_id')
                ->references('id')
                ->on('help_requests');

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
        Schema::dropIfExists('help_request_sms_details');
    }
}
