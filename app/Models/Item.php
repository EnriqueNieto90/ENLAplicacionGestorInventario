<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    // Campos permitidos para ser rellenados
    protected $fillable = [
        'sku',
        'name',
        'description',
        'category_id',
        'stock',
        'min_stock',
        'is_active',
    ];

    // Convierte is_active a booleano en PHP
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Añade el estado calculado al convertir el modelo a array o JSON
    protected $appends = [
        'status',
    ];

    // Un artículo pertenece a una categoría
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Un artículo puede tener muchos movimientos de stock
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    // Calcula el estado del artículo a partir del stock actual y mínimo
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn () => match (true) {
                $this->stock === 0 => 'agotado',
                $this->stock <= $this->min_stock => 'bajo stock',
                default => 'disponible',
            }
        );
    }
}
