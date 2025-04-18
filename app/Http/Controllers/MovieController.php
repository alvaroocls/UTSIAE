<?php

namespace App\Http\Controllers;
use App\Models\Movie;

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
        // Logic to retrieve and return a single movie by ID
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
