<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTemporadaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Obligatorio en true para que nos deje pasar
    }

    public function rules(): array
    {
        return [
            'año_inicio' => 'required|integer',
            'año_fin' => 'required|integer',
            'estado' => 'nullable'
        ];
    }
}