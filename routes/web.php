<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GroupElectroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LowVoltageController;

// Pagina principal para todas las memorias
Route::get('/', [FormController::class, 'index'])->name('principal');

// Se usa el FormController para las vistas de Compatibilidad
Route::resource('form', FormController::class)->names('form');
Route::get('/form/{form}/word', [FormController::class, 'convertToWord'])->name('form.convertToWord');

// Memorias para el Grupo Electrogeno
Route::resource('groupElectro', GroupElectroController::class)->names('groupElectro');
Route::get('/groupElectro/{groupElectro}/word', [GroupElectroController::class, 'convertToWord'])->name('groupElectro.convertToWord');

/* Route::prefix('grupo-electrogeno')->name('groupElectro.')->group(function () {
    Route::get('/crear', [GroupElectroController::class, 'create'])->name('create');
    Route::post('/guardar', [GroupElectroController::class, 'store'])->name('store');
    Route::get('/{groupElectro}', [GroupElectroController::class, 'show'])->name('show');
    Route::get('/{groupElectro}/editar', [GroupElectroController::class, 'edit'])->name('edit');
    Route::put('/{groupElectro}', [GroupElectroController::class, 'update'])->name('update');
    Route::delete('/{groupElectro}', [GroupElectroController::class, 'destroy'])->name('destroy');
}); */

// Memorias para Baja Tensión
Route::resource('lowVoltage', lowVoltageController::class)->names('lowVoltage');

/* Route::prefix('baja-tension')->name('lowVoltage.')->group(function () {
    Route::get('/crear', [LowVoltageController::class, 'create'])->name('create');
    Route::post('/guardar', [LowVoltageController::class, 'store'])->name('store');
    Route::get('/{form}', [LowVoltageController::class, 'show'])->name('show');
    Route::get('/{form}/editar', [LowVoltageController::class, 'edit'])->name('edit');
    Route::put('/{form}', [LowVoltageController::class, 'update'])->name('update');
    Route::delete('/{form}', [LowVoltageController::class, 'destroy'])->name('destroy');
}); */

// Rutas de signup y login
Route::get('signup', [LoginController::class, 'signupForm'])->name('signupForm');
Route::post('signup', [LoginController::class, 'signup'])->name('signup');
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');