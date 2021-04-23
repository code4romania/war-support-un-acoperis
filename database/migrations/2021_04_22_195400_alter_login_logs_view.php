<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterLoginLogsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS `login_logs_view`;');
        $sql = <<<EOL
CREATE VIEW login_logs_view AS
SELECT
    users.id as user_id,
    login_logs.email_address,
    COUNT(login_logs.id) as failed_attempts,
    MAX(login_logs.created_at) as last_login
FROM login_logs
JOIN users
    ON users.id = login_logs.user_id
GROUP BY users.id, login_logs.email_address;
EOL;
        DB::statement($sql);

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
