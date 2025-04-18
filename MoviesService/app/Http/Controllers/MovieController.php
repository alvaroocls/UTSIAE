<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function show($id)
    {
        // Ambil movie dari DB lokal
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        // Ambil data orders dari API eksternal
        $orders = [];
        try {
            $response = Http::get("http://127.0.0.1:8002/api/orders/movie/{$id}");
            if ($response->successful()) {
                $orders = $response['data']; // ambil data dari response
            }
        } catch (\Exception $e) {
            // Optional: log error atau isi $orders dengan pesan error
            $orders = [];
        }

        // Ambil data reviews dari API eksternal
        $reviews = [];
        try {
            $response = Http::get("http://127.0.0.1:8004/api/reviews/{$id}");
            if ($response->successful()) {
                $reviews = $response->json(); // langsung ambil array JSON
            }
        } catch (\Exception $e) {
            $reviews = [];
        }

        // Kirim semuanya ke view
        return view('movies.show', compact('movie', 'orders', 'reviews'));
    }


    public function edit($id){
        // Logic to retrieve and return a single movie by ID for editing
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        return view('movies.edit', compact('movie'));
    }

    public function create(){
        return view('movies.create');
    }

    public function store(Request $request)
    {
        // Logic to create a new movie
        $validated = $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'duration' => 'required|integer',
            'description' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
    
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $path; // simpan path ke DB
        }
    
        $movie = Movie::create($validated);
        return redirect()->route('movies.index')->with('success', 'Movie created successfully');
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'duration' => 'required|integer',
            'description' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $path;
        }

        $movie->update($validated);
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully');
    }


    public function destroy($id)
    {
        // Logic to delete a movie by ID
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully');
    }

    // API - Tampilkan semua movie
    public function apiIndex()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    // API - Tampilkan 1 movie berdasarkan ID
    public function apiShow($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json($movie);
    }
}
