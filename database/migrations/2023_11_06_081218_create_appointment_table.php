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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada agendamento');
            $table->date('date')->comment('Data em que o agendamento está marcado');
            $table->foreignId('sport_arena_id')->constrained('sport_arena')->comment('Referência ao local esportivo do agendamento');
            $table->foreignId('schedule_id')->constrained('schedule')->comment('Referência ao horário do agendamento');
            $table->foreignId('organizer_id')->constrained('user')->comment('Referência ao organizador do agendamento');
            $table->foreignId('chat_id')->constrained('chat')->comment('Referência ao chat do agendamento');

            $table->unique(['sport_arena_id', 'schedule_id', 'date'], 'unique_appointment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
