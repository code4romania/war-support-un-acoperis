<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class HelpRequestBugfix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `help_requests`
            CHANGE `need_car` `need_car` TINYINT(1) NULL DEFAULT NULL,
            CHANGE `need_special_transport` `need_special_transport` TINYINT(1) NULL DEFAULT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
