<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function create()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->get('http://127.0.0.1:8003/api/users');
        $users = json_decode($response->getBody(), true);

        $response = $client->get('http://127.0.0.1:8001/api/movies');
        $movies = json_decode($response->getBody(), true);

        return view('orders.create', compact('users', 'movies'));
    }

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

    public function show($id)
    {
        $order = Order::findOrFail($id);

        $client = new \GuzzleHttp\Client();

        $response = $client->get('http://127.0.0.1:8003/api/users');
        $users = json_decode($response->getBody(), true);
        $user = collect($users)->firstWhere('id', $order->user_id);

        $response = $client->get('http://127.0.0.1:8001/api/movies');
        $movies = json_decode($response->getBody(), true);
        $movie = collect($movies)->firstWhere('id', $order->movie_id);

        return view('orders.show', compact('order', 'user', 'movie'));
    }

    public function getByUser($userId)
    {
        $orders = Order::where('user_id', $userId)->get();

        return response()->json([
            'status' => 'success',
            'data'   => $orders,
        ]);
    }

    public function getByMovie($movieId)
    {
        $orders = Order::where('movie_id', $movieId)->get();

        return response()->json([
            'status' => 'success',
            'data'   => $orders,
        ]);
    }
}
