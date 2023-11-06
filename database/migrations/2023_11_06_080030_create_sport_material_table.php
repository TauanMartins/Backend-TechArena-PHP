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
        Schema::create('sport_material', function (Blueprint $table) {
            $table->id()->comment('Chave primária autoincrementável.');
            $table->foreignId('sport_id')->constrained('sport')->comment('ID do esporte referido');
            $table->foreignId('material_id')->constrained('material')->comment('ID do material referido.');
            $table->boolean('related_to_local')->comment('Material se refere ao local físico ou a pessoa deve providenciar?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_material');
    }
};
