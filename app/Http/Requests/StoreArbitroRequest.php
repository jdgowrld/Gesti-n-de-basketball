<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArbitroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'experiencia_anios' => 'required|integer|min:0',
            'certificacion' => 'nullable|string|max:255'
        ];
    }
}