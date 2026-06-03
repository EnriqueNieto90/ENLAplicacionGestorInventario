<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Solo los administradores pueden modificar artículos
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        // Obtiene el artículo recibido por Route Model Binding
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
}
