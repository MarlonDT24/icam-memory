<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FormController::class, 'index'])->name('principal');

Route::resource('form', FormController::class);

Route::get('/form/{form}/convert-word', [FormController::class, 'convertToWord'])->name('form.convert.word');
Route::get('/form/{form}/convert-pdf', [FormController::class, 'convertToPDF'])->name('form.convert.pdf');

