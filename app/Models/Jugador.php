<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores'; // Forzamos el plural en español

    protected $fillable = [
        'equipo_id',
        'nombre',
        'posicion',
        'numero'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}