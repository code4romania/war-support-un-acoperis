<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddCompanyFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name', 255)
                ->after('language')
                ->nullable();

            $table->string('company_tax_id', 32)
                ->after('company_name')
                ->nullable();

            $table->string('legal_representative_name', 255)
                ->after('company_tax_id')
                ->nullable();



        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('legal_representative_name');
            $table->dropColumn('company_tax_id');
            $table->dropColumn('company_name');
        });
    }
}
