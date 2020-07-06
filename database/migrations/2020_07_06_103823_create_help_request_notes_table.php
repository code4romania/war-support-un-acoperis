<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHelpRequestNotesTable
 */
class CreateHelpRequestNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_request_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('help_request_id');
            $table->text('message');
            $table->timestamps();

            $table->foreign('help_request_id')
                ->references('id')
                ->on('help_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_request_notes');
    }
}
