<?php

use App\Http\Controllers\OrderController;

Route::get('/orders/user/{userId}', [OrderController::class, 'getByUser']);
Route::get('/orders/movie/{movieId}', [OrderController::class, 'getByMovie']);
Route::get('/orders/theater/{theaterId}', [OrderController::class, 'getByTheater']);

