<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model
{
    use HasFactory;

    protected $table = 'estadisticas';

    protected $fillable = [
        'partido_id',
        'jugador_id',
        'puntos',
        'triples',
        'rebotes',
        'asistencias',
        'faltas'
    ];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }
}