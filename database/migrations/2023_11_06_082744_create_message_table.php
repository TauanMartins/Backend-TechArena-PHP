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
        Schema::create('message', function (Blueprint $table) {
            $table->id()->comment('Identificador único para a equipe');
            $table->text('message')->nullable()->comment('Mensagem enviada');          
            $table->dateTime('created_at')->comment('Data e hora de criação do registro.');
            $table->foreignId('chat_id')->constrained('chat')->comment('Referência ao chat do agendamento');
            $table->foreignId('user_id')->constrained('user')->comment('Referência ao usuário que enviou a mensagem');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
