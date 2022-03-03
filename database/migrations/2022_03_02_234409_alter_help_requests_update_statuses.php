<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterHelpRequestsUpdateStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `help_requests`
                CHANGE `status`
                `status` ENUM('new','in-progress','completed');
        ");
        DB::statement("
            ALTER TABLE `help_requests`
                ALTER COLUMN `status` set default 'new';

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            ALTER TABLE `help_requests`
                CHANGE `status`
                `status` ENUM('padding','allocated','in_progress','fulfilled')
                NOT NULL DEFAULT 'padding';
        ");
    }
}
