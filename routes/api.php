<?php
use App\Http\Controllers\MovieController;

Route::get('/movies', [MovieController::class, 'apiIndex']);
Route::get('/movies/{id}', [MovieController::class, 'apiShow']);
