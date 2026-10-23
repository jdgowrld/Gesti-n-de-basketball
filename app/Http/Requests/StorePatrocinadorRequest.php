<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatrocinadorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'industria' => 'nullable|string|max:255',
            'monto_patrocinio' => 'nullable|numeric|min:0'
        ];
    }
}