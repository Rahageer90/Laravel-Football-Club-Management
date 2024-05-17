<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->increments('training_session_id');
            $table->integer('coach_id')->unsigned()->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->integer('duration')->nullable();
            $table->string('location', 100)->nullable();
            $table->string('focus_areas', 255)->nullable();

            $table->foreign('coach_id')->references('account_id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_sessions');
    }
};
