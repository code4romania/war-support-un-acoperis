<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHelpRequestTypeTable
 */
class CreateHelpRequestTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_request_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('help_request_id');
            $table->unsignedBigInteger('help_type_id');
            $table->string('approve_status');
            $table->text('message')->nullable();
            $table->timestamps();

            $table->foreign('help_request_id')
                ->references('id')
                ->on('help_requests');

            $table->foreign('help_type_id')
                ->references('id')
                ->on('help_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_request_types');
    }
}
