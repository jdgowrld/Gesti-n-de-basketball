<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'temporada_id'];

    // Relación N:1 -> Un torneo PERTENECE a UNA temporada
    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}
