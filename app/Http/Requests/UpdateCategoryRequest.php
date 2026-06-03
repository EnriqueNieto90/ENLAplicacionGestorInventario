<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// FormRequest para validar la actualización de categorías, solo accesible para administradores
class UpdateCategoryRequest extends FormRequest
{
    // Solo los administradores pueden actualizar categorías
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    // Reglas de validación para el formulario de actualización de categorías
    public function rules(): array
    {
        // Obtiene la categoría recibida por Route Model Binding.
        $category = $this->route('category');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category?->id),
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
