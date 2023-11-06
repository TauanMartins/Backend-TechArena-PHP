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
        Schema::create('sport', function (Blueprint $table) {
            $table->id()->comment('Chave primária autoincrementável.');
            $table->string('name', 150)->unique()->comment('Nome do esporte.');
            $table->unsignedInteger('default_value_player_numbers')->comment('Número padrão de jogadores para o esporte.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport');
    }
};
