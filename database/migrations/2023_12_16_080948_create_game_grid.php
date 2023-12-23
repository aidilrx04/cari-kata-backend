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


        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->json('words');
            $table->timestamps();
        });

        Schema::create('grids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->integer('rows');
            $table->integer('columns');
            $table->json('grid');
            $table->json('solved');
            $table->timestamps();
            $table->foreign('game_id')->references('id')->on('games')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grids');
        Schema::dropIfExists('games');
    }
};
