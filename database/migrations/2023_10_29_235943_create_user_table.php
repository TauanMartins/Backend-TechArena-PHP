<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id()->comment('Chave primária autoincrementável.');
            $table->string('name', 150)->comment('Nome do usuário.');
            $table->string('email', 150)->comment('E-mail do usuário.');
            $table->date('dt_birth')->comment('Data de nascimento do usuário.');
            $table->char('gender', 1)->comment('Gênero do usuário.');
            $table->dateTime('created_at')->comment('Data e hora de criação do registro.');
            $table->string('username', 45)->comment('Nome de usuário para acesso ao sistema.');
            $table->string('image', 150)->nullable()->comment('Caminho para a imagem de perfil do usuário.');
            $table->foreignId('permission_id')->constrained('permission')->comment('Chave estrangeira referenciando a tabela "permission".');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
