<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'livewire.pages.auth.ingresar');
Route::post('ingreso', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', function () {
    Auth::logout();  // Cerrar la sesión del usuario
    
    return redirect('/');  // Redirigir a la página de login o inicio
})->name('logout');

//Correspondencia
Route::view('correspondencia', 'correspondencia.index')->name('correspondencia');
Route::get('get_categorias', [DataController::class, 'getCategorias'])->name('get.categorias');
Route::post('correspondencia_store', [DataController::class, 'correspondencia_store'])->name('correspondencia.store');
Route::get('correspondencia_edit/{id}', [DataController::class, 'correspondencia_edit'])->name('correspondencia.edit');
Route::post('correspondencia_update', [DataController::class, 'correspondencia_update'])->name('correspondencia.update');
Route::get('correspondencia_anule', [DataController::class, 'correspondencia_anule'])->name('correspondencia.anule');


//Personas
Route::post('personas_store', [DataController::class, 'personas_store'])->name('personas.store');

//Institucions
Route::post('institucions_store', [DataController::class, 'institucions_store'])->name('institucions.store');


Route::view('gestion', 'gestion.index')->name('gestion');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
