<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patrocinador extends Model
{
    protected $table = 'patrocinadores'; // Buena práctica para evitar que Laravel busque "patrocinadors"
    protected $fillable = ['nombre', 'industria', 'monto_patrocinio'];
}