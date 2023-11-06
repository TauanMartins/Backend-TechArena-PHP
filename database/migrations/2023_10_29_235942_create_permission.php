<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->id()->comment('Chave primária autoincrementável.');
            $table->char('symbol', 1)->comment('Símbolo representativo da permissão.');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission');
    }
};
