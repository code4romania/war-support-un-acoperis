<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocations_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('help_request_id')->constrained('help_requests')->cascadeOnDelete();
            $table->foreignId('refugee_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('accommodation_id')->constrained('accommodations')->cascadeOnDelete();
            $table->foreignId('allocation_id')->nullable()->constrained('allocations')->nullOnDelete();
            $table->foreignId('host_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('number_of_guest');
            $table->timestamp('deallocated_at')->nullable();
            $table->timestamp('from')->nullable();
            $table->timestamp('to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocations_history');
    }
}
