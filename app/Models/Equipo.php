<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    // REGLA DE SEGURIDAD: Especificamos qué columnas se pueden llenar desde un formulario.
    // Esto evita que un usuario malicioso inyecte campos como 'is_admin' o IDs falsos.
    protected $fillable = [
        'nombre', 
        'ciudad', 
        'logo'
    ];

    // POO (Mapeo Relacional): Le enseñamos a Laravel que un Equipo tiene muchos Jugadores.
    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }
}