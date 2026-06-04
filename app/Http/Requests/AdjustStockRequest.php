<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class AdjustStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Solo los administradores pueden registrar movimientos de stock
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'in:in,out,adjustment'],
            'quantity' => ['required', 'integer', 'min:0'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Debes seleccionar un tipo de movimiento.',
            'type.in' => 'El tipo de movimiento seleccionado no es válido.',

            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad no puede ser negativa.',

            'notes.max' => 'Las notas no pueden tener más de 500 caracteres.',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $type = $this->input('type');
                $quantity = (int) $this->input('quantity');

                // Entradas y salidas deben mover al menos una unidad
                if (in_array($type, ['in', 'out'], true) && $quantity < 1) {
                    $validator->errors()->add(
                        'quantity',
                        'Las entradas y salidas deben tener una cantidad mínima de 1 unidad.'
                    );
                }
            },
        ];
    }
}
