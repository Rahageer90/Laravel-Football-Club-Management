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
        Schema::create('injuries', function (Blueprint $table) {
            $table->increments('injury_id');
            $table->integer('player_id')->unsigned()->nullable();
            $table->string('description', 255)->nullable();
            $table->date('date_of_injury')->nullable();
            $table->enum('status', ['injured', 'not injured'])->nullable();

            $table->foreign('player_id')->references('account_id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('injuries');
    }
};
