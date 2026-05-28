<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;

//Rutas accesibles sin iniciar sesión
Route::get('/', function () {
    return view('welcome');
});

//Pantalla principal tras iniciar sesión que necesita usuario autenticado y verificado
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Rutas privadas. Todas las rutas de este grupo necesitan autenticación
Route::middleware(['auth'])->group(function () {
    // Consulta del inventario permitida para empleados y administradores
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');

    //Solo los usuarios con rol administrador pueden crear, editar o dar de baja artículos
    Route::middleware(['admin'])->group(function () {
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    });

    // Detalle de artículo. Se debe declarar después de las rutas específicas para evitar conflictos con /items/create, etc
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

    // Registro de movimientos de stock para cada artículo
    Route::post('/items/{item}/stock-movements', [StockMovementController::class, 'store'])
    ->name('items.stock-movements.store');

    // Rutas generadas por Breeze para editar el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación generadas por Breeze
require __DIR__.'/auth.php';
