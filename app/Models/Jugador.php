<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores'; // Forzamos el plural en español
    protected $fillable = ['nombre', 'numero', 'equipo_id', 'posicion_id'];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
    
    public function posicion()
    {
        // Un Jugador 'pertenece a' una Posición
        return $this->belongsTo(Posicion::class);
    }
}