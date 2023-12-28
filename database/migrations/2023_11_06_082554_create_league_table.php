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
        Schema::create('league', function (Blueprint $table) {
            $table->id()->comment('ID da liga');
            $table->string('name', 45)->comment('Nome da liga');
            $table->string('description', 500)->nullable()->comment('Descrição da liga');
            $table->bigInteger('league_number')->comment('Número da liga');
            $table->string('image', 150)->nullable()->comment('Imagem da liga');
            $table->foreignId('appointment_id')->constrained('appointment')->comment('ID do agendamento associado');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('league');
    }
};
