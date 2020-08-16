<?php

use App\HelpRequestNote;
use App\Note;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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

        $helpRequestNoteList = HelpRequestNote::all();
        foreach ($helpRequestNoteList as $helpRequestNote) {
            $note = new Note();
            $note->entity_id = $helpRequestNote->help_request_id;
            $note->entity_type = Note::TYPE_HELP_REQUEST;
            $note->message = $helpRequestNote->message;
            $note->user_id = $helpRequestNote->user_id;
            $note->save();
        }
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
