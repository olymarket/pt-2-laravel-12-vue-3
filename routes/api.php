<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('agenda-index', [AgendaController::class, 'index'])->name('admin.agenda.index');
    Route::post('agenda-store', [AgendaController::class, 'store'])->name('admin.agenda.store');
    Route::get('agenda-edit/{idAgenda}', [AgendaController::class, 'edit'])->name('admin.agenda.edit');
    Route::post('agenda-update/{idAgenda}', [AgendaController::class, 'update'])->name('admin.agenda.update');
    Route::delete('agenda-delete/{idAgenda}', [AgendaController::class, 'destroy'])->name('admin.agenda.delete');

    Route::get('/clear', function () {
        $run = Artisan::call('config:clear');
        $run = Artisan::call('view:clear');
        $run = Artisan::call('route:clear');
        $run = Artisan::call('config:cache');
        $run = Artisan::call('optimize');
        return 'Cleanup Completed';
    });
    Route::get('/local', function () {
        Artisan::call('storage:link');
        return 'Location Successfully Created';
    });
    Route::get('/server', function () {
        if (file_exists(public_path('storage'))) {
            return "The folder already exists";
        }
        app('files')->link(
            storage_path('app/public'),
            public_path('storage')
        );
        return 'Server Successfully Created.';
    });
});