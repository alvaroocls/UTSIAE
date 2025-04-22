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
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $orders = [];
        try {
            $response = Http::get("http://127.0.0.1:8002/api/orders/movie/{$id}");
            if ($response->successful()) {
                $orders = $response['data']; 
            }
        } catch (\Exception $e) {
            $orders = [];
        }

        $reviews = [];
        try {
            $response = Http::get("http://127.0.0.1:8004/api/reviews/{$id}");
            if ($response->successful()) {
                $reviews = $response->json(); 
            }
        } catch (\Exception $e) {
            $reviews = [];
        }

        return view('movies.show', compact('movie', 'orders', 'reviews'));
    }


    public function edit($id){
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
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully');
    }

    public function apiIndex()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    public function apiShow($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json($movie);
    }
}
