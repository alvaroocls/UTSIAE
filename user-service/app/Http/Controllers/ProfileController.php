<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function history()
{
    $user = Auth::user();
    $userId = $user->id;
    $client = new Client();

    // Ambil orders berdasarkan user
    $response = $client->get("http://127.0.0.1:8002/api/orders/user/{$userId}");
    $orders = json_decode($response->getBody(), true);

    // Ambil semua movie dari MovieService
    $response = $client->get("http://127.0.0.1:8001/api/movies");
    $movies = json_decode($response->getBody(), true);

    // Gabungkan info movie ke dalam order
    $ordersWithMovie = collect($orders['data'])->map(function ($order) use ($movies) {
        $movie = collect($movies)->firstWhere('id', $order['movie_id']); // mencari movie berdasarkan movie_id

        return [
            'id' => $order['id'],
            'movie_id' => $order['movie_id'],
            'movie_name' => $movie['title'] ?? 'Unknown', // Menampilkan nama film
            'quantity' => $order['quantity'],
            'total_price' => $order['total_price'],
            'created_at' => $order['created_at'],
            'status' => 'completed', // default status
            // Jika ingin menambahkan detail movie seperti genre, poster, dll
            'movie_genre' => $movie['genre'] ?? 'N/A',
            'movie_duration' => $movie['duration'] ?? 'N/A',
            'movie_poster' => $movie['poster'] ?? 'default.png',
        ];
    });

    return view('user.profile', [
        'user' => $user,
        'orders' => $ordersWithMovie
    ]);
}
}
