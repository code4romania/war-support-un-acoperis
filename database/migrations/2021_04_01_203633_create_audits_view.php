
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAuditsView extends Migration
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
            CREATE VIEW audits_view AS
                SELECT
                    audits.id,
                    users.name as user,
                    roles.name as role,
                    audits.event,
                    audits.auditable_type as type,
                    audits.url,
                    audits.created_at
                FROM audits
                JOIN users
                    ON users.id = audits.user_id
                JOIN model_has_roles
                    ON model_has_roles.model_id = users.id
                JOIN roles
                    ON roles.id = model_has_roles.role_id
            SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `audits_view`;
            SQL;
    }
}
