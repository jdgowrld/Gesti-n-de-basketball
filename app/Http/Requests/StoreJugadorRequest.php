<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJugadorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

   public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'numero' => 'required|integer',
            'posicion_id' => 'required|exists:posicions,id',
            'equipo_id' => 'required|exists:equipos,id'
        ];
    }
}