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
            'equipo_id' => 'required|exists:equipos,id',
            'nombre' => 'required|string|max:255',
            'posicion' => 'required|string',
            'numero' => 'required|integer'
        ];
    }
}