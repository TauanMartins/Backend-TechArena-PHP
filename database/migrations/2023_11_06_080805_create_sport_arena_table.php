<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sport_arena', function (Blueprint $table) {
            $table->id()->comment('Chave primária autoincrementável.');
            $table->foreignId('sport_id')->constrained('sport')->comment('Chave estrangeira referenciando a tabela "sport".');
            $table->foreignId('arena_id')->constrained('arena')->comment('Chave estrangeira referenciando a tabela "arena".');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_arena');
    }
};
