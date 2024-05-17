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
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('appointment_id');
            $table->integer('player_id')->unsigned()->nullable();
            $table->integer('doctor_or_physio_id')->unsigned()->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('diagnosis', 255)->nullable();
            $table->string('treatment', 255)->nullable();
            $table->integer('estimated_recovery_time')->nullable();

            $table->foreign('player_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('doctor_or_physio_id')->references('account_id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
