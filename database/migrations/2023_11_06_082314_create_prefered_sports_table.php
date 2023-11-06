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
        Schema::create('prefered_sports', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('user')->comment('ID do usuário');
            $table->foreignId('sport_id')->constrained('sport')->comment('ID do esporte');

            $table->primary(['user_id', 'sport_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefered_sports');
    }
};
