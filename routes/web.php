<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GroupElectroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PciController;
use App\Http\Controllers\LowVoltageController;

// Pagina principal para todas las memorias
Route::get('/', [FormController::class, 'index'])->name('principal')->middleware('auth');

// Se usa el FormController para las vistas de Compatibilidad
Route::resource('form', FormController::class)->names('form')->middleware('auth');
Route::get('/form/{form}/word', [FormController::class, 'convertToWord'])->name('form.convertToWord')->middleware('auth');

// Memorias para el Grupo Electrogeno
Route::resource('groupElectro', GroupElectroController::class)->names('groupElectro')->middleware('auth');
Route::get('/groupElectro/{groupElectro}/word', [GroupElectroController::class, 'convertToWord'])->name('groupElectro.convertToWord')->middleware('auth');

/* Route::prefix('grupo-electrogeno')->name('groupElectro.')->group(function () {
    Route::get('/crear', [GroupElectroController::class, 'create'])->name('create');
    Route::post('/guardar', [GroupElectroController::class, 'store'])->name('store');
    Route::get('/{groupElectro}', [GroupElectroController::class, 'show'])->name('show');
    Route::get('/{groupElectro}/editar', [GroupElectroController::class, 'edit'])->name('edit');
    Route::put('/{groupElectro}', [GroupElectroController::class, 'update'])->name('update');
    Route::delete('/{groupElectro}', [GroupElectroController::class, 'destroy'])->name('destroy');
}); */

// Memorias para Baja Tensión
Route::resource('lowVoltage', lowVoltageController::class)->names('lowVoltage')->middleware('auth');

/* Route::prefix('baja-tension')->name('lowVoltage.')->group(function () {
    Route::get('/crear', [LowVoltageController::class, 'create'])->name('create');
    Route::post('/guardar', [LowVoltageController::class, 'store'])->name('store');
    Route::get('/{form}', [LowVoltageController::class, 'show'])->name('show');
    Route::get('/{form}/editar', [LowVoltageController::class, 'edit'])->name('edit');
    Route::put('/{form}', [LowVoltageController::class, 'update'])->name('update');
    Route::delete('/{form}', [LowVoltageController::class, 'destroy'])->name('destroy');
}); */

// Rutas de signup y login
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para que funcionen los campos autocompletados según los codigos postales
Route::get('/geolookup', [App\Http\Controllers\GroupElectroController::class, 'geoLookup']);

// Rutas de signup y login
Route::get('/pci', [PciController::class, 'index'])->name('pci.index');
Route::post('/pci/calculate/ajax', [PciController::class, 'calculateAjax'])->name('pci.calculate.ajax');