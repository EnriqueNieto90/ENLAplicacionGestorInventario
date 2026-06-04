<?php

use App\Http\Controllers\Api\ItemApiController;
use Illuminate\Support\Facades\Route;

Route::get('/items', [ItemApiController::class, 'index'])
    ->name('api.items.index');

Route::get('/items/critical', [ItemApiController::class, 'critical'])
    ->name('api.items.critical');

Route::get('/items/{sku}', [ItemApiController::class, 'showBySku'])
    ->name('api.items.show-by-sku');
