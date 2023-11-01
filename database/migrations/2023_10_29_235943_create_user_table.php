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
        Schema::create('public.user', function (Blueprint $table) {
            $table->id();
            $table->string('image', 400);
            $table->string('name', 150);
            $table->string('email', 150);
            $table->date('dt_birth');
            $table->char('gender', 1);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.user');
    }
};
