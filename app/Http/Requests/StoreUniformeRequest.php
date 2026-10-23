<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniformeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'equipo_id' => 'required|exists:equipos,id',
            'tipo' => 'required|string|max:50',
            'color_principal' => 'required|string|max:50',
            'color_secundario' => 'nullable|string|max:50'
        ];
    }
}