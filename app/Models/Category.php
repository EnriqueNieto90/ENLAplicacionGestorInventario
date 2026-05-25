<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Campos permitidos para ser rellenados
    protected $fillable = [
        'name',
        'description',
    ];

    // Una categoría puede tener muchos artículos
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
