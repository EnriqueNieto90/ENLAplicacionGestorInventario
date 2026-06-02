<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// FormRequest para validar la creación de categorías, solo accesible para administradores
class StoreCategoryRequest extends FormRequest
{
    // Solo los administradores pueden crear categorías
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    // Reglas de validación para el formulario de creación de categorías
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
        ];
    }
}
