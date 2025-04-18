<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Menampilkan form untuk membuat review baru
    public function create($movie_id)
    {
        $movie = Movie::find($movie_id);
        return view('reviews.create', compact('movie'));
    }

    // Menyimpan review baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_title' => 'required|string',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Simpan ke database
        Review::create([
            'movie_title' => $validated['movie_title'],
            'review' => $validated['review'],
            'rating' => $validated['rating'],
            'user_id' => 1,       // sementara default
            'movie_id' => 1,      // sementara default
        ]);

        return redirect('/')->with('success', 'Review berhasil ditambahkan!');
    }

    // Menampilkan daftar review untuk sebuah film

    public function index()
    {
        $reviews = Review::all(); // ambil semua data review dari database
        return view('welcome', compact('reviews')); // ⬅️ ini penting!
    }

    // Menampilkan form untuk mengedit review
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.edit', compact('review'));
    }

    // Mengupdate review yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::findOrFail($id);
        $review->update([
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->route('reviews.index', ['movie_id' => $review->movie_id])
                         ->with('success', 'Review berhasil diperbarui!');
    }

    // Menghapus review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index', ['movie_id' => $review->movie_id])
                         ->with('success', 'Review berhasil dihapus!');
    }
}
