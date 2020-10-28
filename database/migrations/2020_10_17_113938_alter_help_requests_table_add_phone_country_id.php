<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHelpRequestsTableAddPhoneCountryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_phone_country_id')
                ->nullable()
                ->after('patient_full_name');

            $table->foreign('patient_phone_country_id')
                ->references('id')
                ->on('countries');

            $table->unsignedBigInteger('caretaker_phone_country_id')
                ->nullable()
                ->after('caretaker_full_name');

            $table->foreign('caretaker_phone_country_id')
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
        Schema::table('help_requests', function (Blueprint $table) {
            $table->dropForeign(['patient_phone_country_id']);
            $table->dropForeign(['caretaker_phone_country_id']);
            $table->dropColumn('patient_phone_country_id');
            $table->dropColumn('caretaker_phone_country_id');
        });
    }
}
