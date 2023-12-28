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
        Schema::create('arena', function (Blueprint $table) {
            $table->id();
            $table->string('address', 150)->comment('Endereço da arena');
            $table->decimal('lat', 10, 7)->comment('Latitude para localização geográfica'); 
            $table->decimal('longitude', 11, 7)->comment('Longitude para localização geográfica');
            $table->string('image', 150)->nullable()->comment('Caminho da imagem da arena');
            $table->boolean('is_league_only')->comment('Indica se a arena é exclusiva para ligas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arena');
    }
};
