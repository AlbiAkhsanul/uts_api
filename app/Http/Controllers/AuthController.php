<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());

            // Buat API key baru jika belum ada atau sudah kadaluarsa
            if (!$user->api_key || now()->greaterThan($user->api_key_expires_at)) {
                $user->api_key = Str::random(24);
                $user->api_key_expires_at = now()->addDays(7);
                $user->save();
            }

            return response()->json([
                'message' => 'Login berhasil',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'api_key' => $user->api_key,
                'api_key_expires_at' => $user->api_key_expires_at,
            ]);
        }

        return response()->json(['message' => 'Login gagal'], 401);
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Register Berhasil',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 201);
    }
}
