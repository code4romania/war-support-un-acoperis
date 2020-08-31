<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AlterAccommodationPhotosAddIdentifier
 */
class AlterAccommodationPhotosAddIdentifier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodation_photos', function (Blueprint $table) {
            $table->string('identifier', 64)->nullable()->after('name')->index();
        });

        \DB::table('accommodation_photos')->update(['identifier' => \DB::raw('SHA1(path)')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accommodation_photos', function (Blueprint $table) {
            $table->dropColumn('identifier');
        });
    }
}
