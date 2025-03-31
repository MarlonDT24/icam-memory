<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

// Pagina principal para todas las memorias
Route::get('/', [FormController::class, 'index'])->name('principal');


// Se usa el FormController para las vistas de Compatibilidad
Route::resource('form', FormController::class);

// Se usa el LowVoltageController para las vistas de Baja Tensión
