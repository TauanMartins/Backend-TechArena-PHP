<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('friend', function (Blueprint $table) {
            $table->foreignId('user_1_id')->constrained('user')->comment('Chave estrangeira referenciando a tabela "user".');
            $table->foreignId('user_2_id')->constrained('user')->comment('Chave estrangeira referenciando a tabela "user".');
            $table->boolean('user_1_accepted')->comment('Usuário 1 aceitou o pedido de amizade?');
            $table->boolean('user_2_accepted')->comment('Usuário 2 aceitou o pedido de amizade?');

            $table->primary(['user_1_id', 'user_2_id']);
            $table->unique(['user_1_id', 'user_2_id'], 'unique_friend_request');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('friend');
    }
};
