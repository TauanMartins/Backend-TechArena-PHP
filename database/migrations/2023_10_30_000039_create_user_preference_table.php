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
        Schema::create('user_preference', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('preferences_id');
            $table->string('value', 45)->nullable();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('preferences_id')->references('id')->on('preference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.user_preference');
    }
};
