<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;


Route::get('agenda-index', [AgendaController::class, 'index'])->name('agenda.index');
Route::post('agenda-store', [AgendaController::class, 'store'])->name('');
Route::get('agenda-edit/{idAgenda}', [AgendaController::class, 'edit'])->name('');
Route::post('agenda-update/{idAgenda}', [AgendaController::class, 'update'])->name('');
Route::delete('agenda-delete/{idAgenda}', [AgendaController::class, 'destroy'])->name('');