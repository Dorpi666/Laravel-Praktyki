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
        Schema::create('CharacterScore', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ChampionId');
            $table->unsignedInteger('UserId');
            $table->unsignedInteger('Score');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
