<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'showall']);
Route::post('/users/register', [UserController::class, 'register']);
Route::get('/users/{id}', [UserController::class, 'getUserProfile']);
Route::get('/users/{id}/history', [UserController::class, 'getUserHistory']);
