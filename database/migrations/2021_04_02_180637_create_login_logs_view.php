<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginLogsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW login_logs_view AS
                SELECT
                    login_logs.id,
                    users.id as user_id,
                    users.name as user,
                    login_logs.email_address,
                    login_logs.ip_address,
                    login_logs.type,
                    login_logs.created_at
                FROM login_logs
                JOIN users
                    ON users.id = login_logs.user_id
            SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `login_logs_view`;
            SQL;
    }
}
