<?php

use App\Note;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->tinyInteger('entity_type');
            $table->text('message');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });

        DB::statement("
            INSERT INTO notes (id, entity_id, entity_type, message, user_id, created_at, updated_at, deleted_at)
            SELECT
                id, help_request_id, " . Note::TYPE_HELP_REQUEST . ", message, user_id, created_at, updated_at, deleted_at
            FROM
                `help_request_notes`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
