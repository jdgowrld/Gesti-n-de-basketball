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
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            
            // LA MAGIA DE LA LLAVE FORÁNEA:
            // constrained() busca automáticamente la tabla 'temporadas' y el campo 'id'.
            // cascadeOnDelete() asegura que si borras una temporada, se borren sus torneos para no dejar datos basura (huérfanos).
            $table->foreignId('temporada_id')->constrained()->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
