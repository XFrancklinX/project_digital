<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'livewire.pages.auth.ingresar');
Route::post('ingreso', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    //Correspondencia
Route::view('correspondencia', 'correspondencia.index')->name('correspondencia');
Route::view('anulados', 'correspondencia.anulados')->name('anulados');
Route::get('get_categorias', [DataController::class, 'getCategorias'])->name('get.categorias');
Route::post('correspondencia_store', [DataController::class, 'correspondencia_store'])->name('correspondencia.store');
Route::get('correspondencia_edit/{id}', [DataController::class, 'correspondencia_edit'])->name('correspondencia.edit');
Route::post('correspondencia_update', [DataController::class, 'correspondencia_update'])->name('correspondencia.update');
Route::get('correspondencia_anule', [DataController::class, 'correspondencia_anule'])->name('correspondencia.anule');
Route::get('correspondencia_table', [DataController::class, 'correspondencia_table'])->name('correspondencia.table');


//Personas
Route::post('personas_store', [DataController::class, 'personas_store'])->name('personas.store');

//Institucions
Route::post('institucions_store', [DataController::class, 'institucions_store'])->name('institucions.store');

//Gestion
Route::view('gestion', 'gestion.index')->name('gestion');
Route::post('gestion_personas_store', [DataController::class, 'gestion_personas_store'])->name('gestion.personas.store');
Route::post('gestion_institucions_store', [DataController::class, 'gestion_institucions_store'])->name('gestion.institucions.store');
Route::post('gestion_categorias_store', [DataController::class, 'gestion_categorias_store'])->name('gestion.categorias.store');
Route::post('gestion_unidades_store', [DataController::class, 'gestion_unidades_store'])->name('gestion.unidades.store');
Route::get('gestion_edit', [DataController::class, 'gestion_edit'])->name('gestion.edit');
Route::post('gestion_personas_update', [DataController::class, 'gestion_personas_update'])->name('gestion.personas.update');
Route::post('gestion_unidades_update', [DataController::class, 'gestion_unidades_update'])->name('gestion.unidades.update');
Route::post('gestion_categorias_update', [DataController::class, 'gestion_categorias_update'])->name('gestion.categorias.update');
Route::post('gestion_institucions_update', [DataController::class, 'gestion_institucions_update'])->name('gestion.institucions.update');


//Reportes
Route::view('reportes', 'reportes.index')->name('reportes');
Route::get('reportes_data', [DataController::class, 'reportes_data'])->name('reportes.data');

//Perfil
Route::get('perfil', [DataController::class, 'perfil'])->name('perfil');
Route::post('perfil_update', [DataController::class, 'perfil_update'])->name('perfil.update');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
});

require __DIR__ . '/auth.php';
