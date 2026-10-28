<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoRequest extends FormRequest
{
    // Cambia esto a true para que te permita guardar
    public function authorize(): bool
    {
        return true; 
    }

    // Aquí mudamos las reglas que tenías en el controlador
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'logo' => 'nullable|string'
        ];
    }
    
    public function messages(): array
{
    return [
        'nombre.required' => 'El nombre del equipo es obligatorio.',
        'ciudad.required' => 'La ciudad es obligatoria.',
        'correo.required' => 'El correo es obligatorio.',
        'correo.email' => 'Debes ingresar un formato de correo válido (ej. correo@dominio.com).'
    ];
}
}