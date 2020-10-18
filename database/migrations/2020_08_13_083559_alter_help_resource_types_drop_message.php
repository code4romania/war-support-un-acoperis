<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHelpResourceTypesDropMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_resource_types', function(Blueprint $table) {
            $table->dropColumn('message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_resource_types', function (Blueprint $table) {
            $table->string('message', 5000)->nullable();
        });
    }
}
