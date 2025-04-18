<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function create()
    {
        // Data dummy untuk users
        $users = [
            ['id' => 1, 'name' => 'Test User 1'],
            ['id' => 2, 'name' => 'Test User 2'],
        ];

        // Data dummy untuk movies
        $movies = [
            ['id' => 1, 'title' => 'Movie 1', 'price' => 100],
            ['id' => 2, 'title' => 'Movie 2', 'price' => 150],
            ['id' => 3, 'title' => 'Movie 3', 'price' => 200],
        ];

        return view('orders.create', compact('users', 'movies'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'movie_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Data dummy untuk film
        $movies = [
            1 => ['id' => 1, 'title' => 'Movie 1', 'price' => 100],
            2 => ['id' => 2, 'title' => 'Movie 2', 'price' => 150],
            3 => ['id' => 3, 'title' => 'Movie 3', 'price' => 200],
        ];

        // Ambil detail film untuk ambil harga
        $movie = $movies[$request->movie_id];
        $price = $movie['price'];

        // Simpan ke database
        $order = Order::create([
            'user_id'     => $request->user_id,
            'movie_id'    => $request->movie_id,
            'quantity'    => $request->quantity,
            'total_price' => $price * $request->quantity,
        ]);

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Pemesanan berhasil!');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        // Data dummy untuk user
        $user = ['id' => 1, 'name' => 'Test User 1'];

        // Data dummy untuk movies
        $movies = [
            1 => ['id' => 1, 'title' => 'Movie 1', 'price' => 100],
            2 => ['id' => 2, 'title' => 'Movie 2', 'price' => 150],
            3 => ['id' => 3, 'title' => 'Movie 3', 'price' => 200],
        ];

        // Ambil data film berdasarkan movie_id dari order
        $movie = $movies[$order->movie_id];

        return view('orders.show', compact('order', 'user', 'movie'));
    }
}
