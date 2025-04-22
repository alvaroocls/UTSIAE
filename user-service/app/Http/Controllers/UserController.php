<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
        public function showForm()
        {
            return view('register');
        }
    
        public function register(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:15',
            ]);
    
            $response = Http::post('http://localhost:8000/api/users/register', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
    
            if ($response->successful()) {
                return redirect()->route('register.form')->with('success', 'User successfully registered');
            } else {
                return redirect()->route('register.form')->with('error', 'Failed to register user');
            }
        }
        
    public function profile()
    {
        $user = Auth::user();

        $orders = [];
        try {
            $response = Http::get("http://localhost:8002/api/orders/user/{$user->id}"); 
            if ($response->successful()) {
                $orders = $response->json();
            }
        } catch (\Exception $e) {
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

    public function showall(){
        $users = User::all();
        return response()->json($users);
    }

}

    

