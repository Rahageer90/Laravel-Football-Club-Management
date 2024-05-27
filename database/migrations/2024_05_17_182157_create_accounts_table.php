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
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('account_id');
            $table->string('username', 50)->unique();
            $table->string('password')->unique();
            $table->string('email', 100)->unique();
            $table->enum('role', ['admin', 'coach', 'player', 'physio', 'doctor']);
            $table->string('name', 100)->nullable();
            $table->string('position', 100)->nullable();
            $table->string('contact_info', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
