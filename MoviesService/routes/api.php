<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/movies', [MovieController::class, 'apiIndex']);
Route::get('/movies/{id}', [MovieController::class, 'apiShow']);