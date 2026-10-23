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
        Schema::create('arbitros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('experiencia_anios')->default(0);
            $table->string('certificacion')->nullable(); // Ej. FIBA, Nacional, Amateur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arbitros');
    }
};
