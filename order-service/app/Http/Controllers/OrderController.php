<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    // 🔹 Tampilkan form pemesanan
    public function create()
    {
        $client = new \GuzzleHttp\Client();

        // Ambil data users dari UserService
        $response = $client->get('http://127.0.0.1:8003/api/users');
        $users = json_decode($response->getBody(), true);

        // Ambil data movies dari MovieService
        $response = $client->get('http://127.0.0.1:8001/api/movies');
        $movies = json_decode($response->getBody(), true);

        return view('orders.create', compact('users', 'movies'));
    }

    // 🔹 Simpan order baru
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id'     => $request->user_id,
            'movie_id'    => $request->movie_id,
            'quantity'    => $request->quantity,
            'total_price' => 40000 * $request->quantity,
        ]);

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Pemesanan berhasil!');
    }

    // 🔹 Tampilkan detail order tertentu
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $client = new \GuzzleHttp\Client();

        // Ambil semua user
        $response = $client->get('http://127.0.0.1:8003/api/users');
        $users = json_decode($response->getBody(), true);
        $user = collect($users)->firstWhere('id', $order->user_id);

        // Ambil semua movie
        $response = $client->get('http://127.0.0.1:8001/api/movies');
        $movies = json_decode($response->getBody(), true);
        $movie = collect($movies)->firstWhere('id', $order->movie_id);

        return view('orders.show', compact('order', 'user', 'movie'));
    }

    // 🔹 🔽 Tambahan API Endpoint agar bisa diakses oleh service lain 🔽 🔹

    // Ambil semua order berdasarkan user_id (dipakai oleh UserService)
    public function getByUser($userId)
    {
        $orders = Order::where('user_id', $userId)->get();

        return response()->json([
            'status' => 'success',
            'data'   => $orders,
        ]);
    }

    // (Opsional) Ambil semua order berdasarkan movie_id (dipakai oleh MovieService)
    public function getByMovie($movieId)
    {
        $orders = Order::where('movie_id', $movieId)->get();

        return response()->json([
            'status' => 'success',
            'data'   => $orders,
        ]);
    }
}
