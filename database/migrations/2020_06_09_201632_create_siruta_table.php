<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSirutaTable
 */
class CreateSirutaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siruta', function (Blueprint $table) {
            $table->unsignedBigInteger('SIRUTA')->primary();
            $table->unsignedBigInteger('NIV');
            $table->unsignedBigInteger('SIRSUP')->index();
            $table->unsignedBigInteger('TIP');
            $table->string('DENLOC', 255);
            $table->unsignedBigInteger('ULT')->nullable();
            $table->unsignedBigInteger('MED');
            $table->unsignedBigInteger('JUD');
            $table->unsignedBigInteger('PREFIX');
            $table->unsignedBigInteger('REGIUNE');
            $table->unsignedBigInteger('CODP');
            $table->unsignedBigInteger('FSJ');
            $table->unsignedBigInteger('FS2')->nullable();
            $table->unsignedBigInteger('FS3')->nullable();
            $table->unsignedBigInteger('FSl');
            $table->boolean('FICTIV');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siruta');
    }
}
