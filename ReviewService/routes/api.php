<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

Route::get('/reviews/{movie_id}', [ReviewController::class, 'reviewsByMovie']);