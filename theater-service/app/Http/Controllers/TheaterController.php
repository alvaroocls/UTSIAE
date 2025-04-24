<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TheaterController extends Controller
{
    public function index()
    {
        $theaters = Theater::all();
        return view('theaters.index', compact('theaters'));
    }

    public function show($id)
    {
        $theater = Theater::find($id);
        if (!$theater) {
            return response()->json(['message' => 'Theater not found'], 404);
        }

        $movies = [];
        try {
            $response = Http::get("http://127.0.0.1:8001/api/movies");

            if ($response->successful()) {
                $movies = $response->json();
            }
        } catch (\Exception $e) {
            $movies = [];
        }

        return view('theaters.show', compact('theater', 'movies'));
    }

    public function edit($id){
        $theater = Theater::find($id);
        if (!$theater) {
            return response()->json(['message' => 'Theater not found'], 404);
        }
        return view('theaters.edit', compact('theater'));
    }

    public function create()
    {
        return view('theaters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        Theater::create($validated);
        return redirect()->route('theaters.index')->with('success', 'Theater berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $theater = Theater::find($id);
        if (!$theater) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        $theater->update($validated);
        return redirect()->route('theaters.index')->with('success', 'Theater updated successfully');
    }

    public function destroy($id)
    {
        $theater = Theater::find($id);
        if (!$theater) {
            return response()->json(['message' => 'Theater not found'], 404);
        }
        $theater->delete();
        return redirect()->route('theaters.index')->with('success', 'Theater deleted successfully');
    }

    public function apiIndex()
    {
        $theaters = Theater::all();
        return response()->json($theaters);
    }

    public function apiShow($id)
    {
        $theaters = Theater::find($id);
        if (!$theaters) {
            return response()->json(['message' => 'Theater not found'], 404);
        }

        return response()->json($theaters);
    }
}
