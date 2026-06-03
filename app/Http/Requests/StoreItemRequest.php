<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Solo los administradores pueden crear artículos
        return $this->user()?->isAdmin() ?? false;
    }

    // Reglas de validación para el formulario de creación de artículos
    public function rules(): array
    {
        return [
            'sku' => ['required', 'string', 'max:50', 'unique:items,sku'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'stock' => ['required', 'integer', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'sku.required' => 'El SKU es obligatorio.',
            'sku.unique' => 'Ya existe un artículo con ese SKU.',
            'sku.max' => 'El SKU no puede tener más de 50 caracteres.',

            'name.required' => 'El nombre del artículo es obligatorio.',
            'name.max' => 'El nombre del artículo no puede tener más de 255 caracteres.',

            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',

            'stock.required' => 'El stock inicial es obligatorio.',
            'stock.integer' => 'El stock inicial debe ser un número entero.',
            'stock.min' => 'El stock inicial no puede ser negativo.',

            'min_stock.required' => 'El stock mínimo es obligatorio.',
            'min_stock.integer' => 'El stock mínimo debe ser un número entero.',
            'min_stock.min' => 'El stock mínimo no puede ser negativo.',
        ];
    }
}
