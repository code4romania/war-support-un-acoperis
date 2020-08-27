<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id');
            $table->string('city', 64);
            $table->string('address', 256)->nullable();
            $table->string('phone_number', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('city');
            $table->dropColumn('address');
            $table->dropColumn('phone_number');
        });
    }
}
