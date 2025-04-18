<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;  // Pastikan untuk mengimpor Http facade

class ProfileController extends Controller
{
    public function history()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Ambil data order dari OrderService (misalnya di localhost pada port 8002)
        $userId = $user->id;  // Menggunakan ID user yang sedang login

        // Menggunakan Http facade untuk membuat request GET ke API OrderService
        $response = Http::get("http://localhost:8002/api/orders/user/{$userId}");

        // Mengecek apakah request berhasil
        if ($response->ok()) {
            // Jika berhasil, ambil data order dalam format JSON
            $orders = $response->json();
        } else {
            // Jika gagal, beri data dummy atau kosong
            $orders = [];
        }

        // Kirim data user dan order history ke view
        return view('profile.history', compact('user', 'orders'));
    }
}
