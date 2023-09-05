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
        Schema::create('LeagueCharacters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('lane');
            $table->unsignedInteger('shop-cost');
            $table->string('difficulty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LeagueCharacters');
    }
};
