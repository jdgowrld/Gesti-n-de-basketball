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
    Schema::table('partidos', function (Blueprint $table) {
        $table->foreignId('cancha_id')->nullable()->constrained('canchas')->onDelete('set null');
        $table->foreignId('arbitro_id')->nullable()->constrained('arbitros')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('partidos', function (Blueprint $table) {
        $table->dropForeign(['cancha_id']);
        $table->dropForeign(['arbitro_id']);
        $table->dropColumn(['cancha_id', 'arbitro_id']);
    });
}
};
