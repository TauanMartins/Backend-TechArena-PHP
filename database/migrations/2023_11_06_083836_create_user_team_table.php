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
        Schema::create('user_team', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('user');
            $table->foreignId('team_id')->constrained('team');
            $table->boolean('leader')->comment('Indica se o usuário é líder da equipe.');
            
            $table->primary(['user_id', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_team');
    }
};
