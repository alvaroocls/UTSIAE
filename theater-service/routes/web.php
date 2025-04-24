<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TheaterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/theaters', [TheaterController::class, 'index'])->name('theaters.index');
Route::get('/theaters/create', [TheaterController::class, 'create'])->name('theaters.create');
Route::post('/theaters', [TheaterController::class, 'store'])->name('theaters.store');
Route::get('/theaters/{id}', [TheaterController::class, 'show'])->name('theaters.show');
Route::get('/theaters/{id}/edit', [TheaterController::class, 'edit'])->name('theaters.edit');
Route::put('/theaters/{id}/edit', [TheaterController::class, 'update'])->name('theaters.update');
Route::delete('/theaters/{id}', [TheaterController::class, 'destroy'])->name('theaters.destroy');
