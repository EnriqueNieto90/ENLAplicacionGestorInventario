<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Solo los administradores pueden modificar artículos.
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        // Obtiene el artículo recibido por Route Model Binding.
        $item = $this->route('item');

        return [
            'sku' => [
                'required',
                'string',
                'max:50',
                Rule::unique('items', 'sku')->ignore($item?->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'min_stock' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'sku.required' => 'El SKU es obligatorio.',
            'sku.unique' => 'Ya existe otro artículo con ese SKU.',
            'sku.max' => 'El SKU no puede tener más de 50 caracteres.',

            'name.required' => 'El nombre del artículo es obligatorio.',
            'name.max' => 'El nombre del artículo no puede tener más de 255 caracteres.',

            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',

            'min_stock.required' => 'El stock mínimo es obligatorio.',
            'min_stock.integer' => 'El stock mínimo debe ser un número entero.',
            'min_stock.min' => 'El stock mínimo no puede ser negativo.',
        ];
    }
}
