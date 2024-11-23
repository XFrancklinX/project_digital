<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'livewire.pages.auth.ingresar');
Route::post('ingreso', [LoginController::class, 'authenticate'])->name('authenticate');
//Correspondencia
Route::view('correspondencia', 'correspondencia.index')->name('correspondencia');
Route::get('get_categorias', [DataController::class, 'getCategorias'])->name('get.categorias');


Route::view('gestion', 'gestion.index')->name('gestion');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
