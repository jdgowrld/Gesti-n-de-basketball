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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea normal hacia torneos
            $table->foreignId('torneo_id')->constrained()->cascadeOnDelete();
            
            // Llaves foráneas gemelas hacia la tabla equipos
            $table->foreignId('equipo_local_id')->constrained('equipos')->cascadeOnDelete();
            $table->foreignId('equipo_visitante_id')->constrained('equipos')->cascadeOnDelete();
            
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado')->default('Programado'); // Programado, En Juego, Finalizado
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
