<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableClinicsAddEnglishColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->text('description_en')->after('description')->nullable();
            $table->text('additional_information_en')->after('additional_information')->nullable();
            $table->text('transport_details_en')->after('transport_details')->nullable();

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
            $table->dropColumn('description_en')->nullable();
            $table->dropColumn('additional_information_en')->nullable();
            $table->dropColumn('transport_details_en')->nullable();
        });
    }
}
