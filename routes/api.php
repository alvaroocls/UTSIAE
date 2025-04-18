<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

Route::prefix('reviews')->group(function () {
    // Simpan review baru
    Route::post('/', [ReviewController::class, 'store']);

    // Ambil semua review berdasarkan movie_id
    Route::get('/movie/{movie_id}', [ReviewController::class, 'reviewsByMovie']);
});
