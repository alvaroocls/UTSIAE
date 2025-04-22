<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        // Ambil data movies dan users dari API
        $movies = Http::get('http://127.0.0.1:8001/api/movies')->json();
        $users = Http::get('http://127.0.0.1:8003/api/users')->json();

        return view('welcome', compact('reviews', 'movies', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|integer',
            'user_id' => 'required|integer',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $movies = collect(Http::get('http://127.0.0.1:8001/api/movies')->json());
        $movie = $movies->firstWhere('id', $validated['movie_id']);
        $movieTitle = $movie['title'] ?? 'Unknown';

        Review::create([
            'movie_title' => $movieTitle,
            'review' => $validated['review'],
            'rating' => $validated['rating'],
            'user_id' => $validated['user_id'],
            'movie_id' => $validated['movie_id'],
        ]);

        return redirect('/')->with('success', 'Review berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.edit', compact('review'));
    }

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

        return redirect('/')->with('success', 'Review berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect('/')->with('success', 'Review berhasil dihapus!');
    }

    public function reviewsByMovie($movie_id)
    {
        $reviews = Review::where('movie_id', $movie_id)->get();
        return response()->json($reviews);
    }
}

