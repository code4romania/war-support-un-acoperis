<?php

use App\Clinic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AlterClinicsAddSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->string('slug', 128);
        });

        $clinicList = Clinic::all();
        foreach ($clinicList as $clinic) {
            $clinic->name = $clinic->name . " ";
            $clinic->save();
            $clinic->name = substr($clinic->name, 0, -1);
            $clinic->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinics', function(Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
