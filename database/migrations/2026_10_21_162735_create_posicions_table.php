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
        Schema::create('posicions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ej. Base, Alero
            $table->string('abreviatura')->nullable(); // Ej. PG, SF, C
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posicions');
    }
};
