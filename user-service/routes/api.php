<?php

use App\Http\Controllers\UserController;

Route::post('/users/register', [UserController::class, 'register']);
Route::get('/users/{id}', [UserController::class, 'getUserProfile']);
Route::get('/users/{id}/history', [UserController::class, 'getUserHistory']);
