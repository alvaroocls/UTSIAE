<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TheaterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/theaters', [TheaterController::class, 'apiIndex']);
Route::get('/theaters/{id}', [TheaterController::class, 'apiShow']);
