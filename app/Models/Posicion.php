<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    protected $table = 'posicions'; 
    protected $fillable = ['nombre', 'abreviatura', 'descripcion'];
}