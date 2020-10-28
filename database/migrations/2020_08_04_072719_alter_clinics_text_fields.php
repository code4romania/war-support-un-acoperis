<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AlterClinicsTextFields
 */
class AlterClinicsTextFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->string('description', 5000)->nullable()->change();
            $table->string('additional_information', 5000)->nullable()->change();
            $table->string('transport_details', 5000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
            $table->text('additional_information')->nullable(false)->change();
            $table->text('transport_details')->nullable(false)->change();
        });
    }
}
