<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstadisticaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'partido_id' => 'required|exists:partidos,id',
            'jugador_id' => 'required|exists:jugadores,id',
            'puntos' => 'required|integer|min:0',
            'triples' => 'required|integer|min:0',
            'rebotes' => 'required|integer|min:0',
            'asistencias' => 'required|integer|min:0',
            'faltas' => 'required|integer|min:0|max:5' // Max 5 faltas para expulsión
        ];
    }
}