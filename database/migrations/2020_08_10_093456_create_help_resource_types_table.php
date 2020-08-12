<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpResourceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_resource_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('help_resource_id');
            $table->unsignedBigInteger('resource_type_id');
            $table->string('message', 5000)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('help_resource_id')
                ->references('id')
                ->on('help_resources');

            $table->foreign('resource_type_id')
                ->references('id')
                ->on('resource_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_resource_types');
    }
}
