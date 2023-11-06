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
        Schema::create('team', function (Blueprint $table) {
            $table->id()->comment('Identificador único para a equipe');
            $table->string('name', 45)->comment('Nome da equipe');
            $table->text('description')->nullable()->comment('Descrição da equipe');
            $table->bigInteger('team_number')->comment('Número identificador da equipe');
            $table->string('image', 150)->nullable()->comment('Caminho da imagem da equipe');
            $table->dateTime('created_at')->comment('Data e hora de criação do registro.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team');
    }
};
