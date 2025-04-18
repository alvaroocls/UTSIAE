<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
        // Menampilkan form registrasi
        public function showForm()
        {
            return view('register');
        }
    
        // Menangani request registrasi
        public function register(Request $request)
        {
            // Validasi data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:15',
            ]);
    
            // Kirim data ke API UserService untuk registrasi
            $response = Http::post('http://localhost:8000/api/users/register', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
    
            // Periksa apakah API berhasil merespon
            if ($response->successful()) {
                return redirect()->route('register.form')->with('success', 'User successfully registered');
            } else {
                return redirect()->route('register.form')->with('error', 'Failed to register user');
            }
        }
        
    public function profile()
    {
        $user = Auth::user();

        // Contoh pemanggilan OrderService
        $orders = [];
        try {
            $response = Http::get("http://localhost:8002/api/orders/user/{$user->id}"); // ganti URL sesuai OrderService kamu
            if ($response->successful()) {
                $orders = $response->json();
            }
        } catch (\Exception $e) {
            // Bisa ditampilkan pesan error juga di view kalau mau
            $orders = [];
        }

        return view('user.profile', compact('user', 'orders'));
    }

    public function getUserProfile($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json($user);
}

}

    

