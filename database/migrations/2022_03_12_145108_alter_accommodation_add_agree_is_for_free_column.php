<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAccommodationAddAgreeIsForFreeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->renameColumn('is_free', 'agree_is_free');
        });

        Schema::table('accommodations', function (Blueprint $table) {
            $table->boolean('agree_is_free')->default(0)->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {;
            $table->renameColumn('agree_is_free', 'is_free');
        });

        Schema::table('accommodations', function (Blueprint $table) {
            $table->boolean('is_free')->default(1)->change();
        });
    }
}
