<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Rutas accesibles sin iniciar sesión
Route::get('/', function () {
    return view('welcome');
});

//Pantalla principal tras iniciar sesión que necesita usuario autenticado y verificado
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


//Rutas privadas. Todas las rutas de este grupo necesitan autenticación
Route::middleware(['auth'])->group(function () {
    // Consulta del inventario permitida para empleados y administradores
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    // Consulta de categorías permitida para empleados y administradores
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    // Consulta del movimientos de stock permitida para empleados y administradores
    Route::get('/movements', [StockMovementController::class, 'index'])->name('stock-movements.index');

    //Solo los usuarios con rol administrador pueden crear, editar o dar de baja artículos
    Route::middleware(['admin'])->group(function () {
        // Rutas para gestión de artículos
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
        Route::patch('/items/{item}/restore', [ItemController::class, 'restore'])->name('items.restore');

        // Rutas para gestión de categorías, solo accesibles para administradores
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Rutas para gestión de usuarios, solo accesibles para administradores
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
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
