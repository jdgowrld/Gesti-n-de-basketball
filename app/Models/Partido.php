<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = [
        'torneo_id', 
        'equipo_local_id', 
        'equipo_visitante_id', 
        'fecha', 
        'hora', 
        'estado'
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    // Le especificamos explícitamente qué columna usar para cada relación
    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }

    public function cancha()
{
    return $this->belongsTo(Cancha::class);
}

public function arbitro()
{
    return $this->belongsTo(Arbitro::class);
}
}