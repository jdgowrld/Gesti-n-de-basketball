<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use HasFactory;

    protected $fillable = ['año_inicio', 'año_fin', 'estado'];

    // Relación 1:N -> Una temporada tiene MUCHOS torneos
    public function torneos()
    {
        return $this->hasMany(Torneo::class);
    }
}
