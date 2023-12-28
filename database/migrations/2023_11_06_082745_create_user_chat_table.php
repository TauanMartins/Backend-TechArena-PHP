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
        Schema::create('user_chat', function (Blueprint $table) {
            $table->foreignId('chat_id')->constrained('chat')->comment('Referência ao chat do agendamento');
            $table->foreignId('user_id')->constrained('user')->comment('Referência ao usuário que enviou a mensagem');

            $table->primary(['chat_id', 'user_id']);
            $table->unique(['chat_id', 'user_id'], 'unique_user_chat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_chat');
    }
};
