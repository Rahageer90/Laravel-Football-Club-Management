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
        Schema::create('match_lineups', function (Blueprint $table) {
            $table->integer('match_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->string('position_played', 100)->nullable();
            $table->integer('minutes_played')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('goals_scored')->nullable();

            $table->primary(['match_id', 'player_id']);
            $table->foreign('match_id')->references('match_id')->on('matches')->onDelete('cascade');
            $table->foreign('player_id')->references('account_id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_lineups');
    }
};
