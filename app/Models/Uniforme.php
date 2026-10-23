<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uniforme extends Model
{
    protected $fillable = ['equipo_id', 'tipo', 'color_principal', 'color_secundario'];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}