<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClinicsTableAddPhoneCountryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->unsignedBigInteger('phone_country_id')
                ->nullable()
                ->after('address');

            $table->foreign('phone_country_id')
                ->references('id')
                ->on('countries');

            $table->unsignedBigInteger('contact_phone_country_id')
                ->nullable()
                ->after('contact_person_name');

            $table->foreign('contact_phone_country_id')
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
        Schema::table('clinics', function (Blueprint $table) {
            $table->dropForeign(['phone_country_id']);
            $table->dropForeign(['contact_phone_country_id']);
            $table->dropColumn('phone_country_id');
            $table->dropColumn('contact_phone_country_id');
        });
    }
}
