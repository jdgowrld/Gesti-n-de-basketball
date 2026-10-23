<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartidoJugador extends Model
{
    protected $table = 'partido_jugadores';
    protected $fillable = ['partido_id', 'jugador_id'];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }
}