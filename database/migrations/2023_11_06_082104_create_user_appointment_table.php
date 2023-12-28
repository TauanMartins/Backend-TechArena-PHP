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
        Schema::create('user_appointment', function (Blueprint $table) {
            $table->foreignId('appointment_id')->constrained('appointment')->comment('ID do compromisso');
            $table->foreignId('user_id')->constrained('user')->comment('ID do usuário');
            $table->boolean('holder')->comment('Indicador se o usuário é o titular do compromisso');

            // Definição das chaves primárias
            $table->primary(['appointment_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_appointment');
    }
};
