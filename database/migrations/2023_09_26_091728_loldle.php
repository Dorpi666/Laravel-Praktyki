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
        Schema::create('LoldleChamp', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('partype');
            $table->string('difficulty');
            $table->string('stats');
            $table->json('tags');
            $table->timestamps();
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LoldleChamp');
    }
};
