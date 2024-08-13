<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, '__invoke'])
    ->name('index');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->
group(function () {
    Route::get('/listas', [ListasController::class, 'index'])->
    name('listas.index');
    Route::get('/listas/criar', [ListasController::class, 'create'])->name('listas.create');
    Route::post('/listas', [ListasController::class, 'store'])->name('listas.store');
    Route::get('/listas/{lista}', [ListasController::class, 'show'])->name('listas.show');
    Route::get('/listas/{lista}/editar', [ListasController::class, 'edit'])->name('listas.edit');
    Route::put('/listas/{lista}', [ListasController::class, 'update'])->name('listas.update');
    Route::delete('/listas/{lista}', [ListasController::class, 'destroy'])->name('listas.destroy');
});

require __DIR__ . '/auth.php';
