<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/run-migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return nl2br(Artisan::output());
});

Route::get("pdff", [ReceiptController::class, 'create']);

Route::controller(ReceiptController::class)->middleware(['auth'])->name('erep.')->group(function(){

    Route::get('generate', 'index')->name('main');
    Route::post('generate', 'store')->name('generate');
    Route::get('download/{id}', 'create_pdf')->name('download');

});

Route::controller(HistoryController::class)->middleware(['auth'])->name('his.')->group(function(){

    Route::get('history', 'index')->name('main');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
