<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    // La tabla solo usa created_at porque los movimientos son inmutables
    public $timestamps = false;

    // Campos permitidos para crear movimientos de stock
    protected $fillable = [
        'item_id',
        'user_id',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
        'notes',
        'created_at',
    ];

    // Trata created_at como fecha manejable por Laravel
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Cada movimiento pertenece a un artículo
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    // Cada movimiento queda asociado al usuario que lo registra
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
