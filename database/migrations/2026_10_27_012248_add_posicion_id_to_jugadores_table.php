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
    Schema::table('jugadores', function (Blueprint $table) {
        // Si tenías una columna vieja de texto, bórrala primero:
        
        $table->foreignId('posicion_id')->nullable()->constrained('posicions')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('jugadores', function (Blueprint $table) {
        $table->dropForeign(['posicion_id']);
        $table->dropColumn('posicion_id');
    });
}
};
