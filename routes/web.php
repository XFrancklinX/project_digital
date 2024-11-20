<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'livewire.pages.auth.ingresar');
Route::post('ingreso', [LoginController::class, 'authenticate'])->name('authenticate');
//Correspondencia
Route::view('correspondencia', 'correspondencia.index')->name('correspondencia');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
