<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi input dari Vue.js / Postman
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required',
        ]);

        // 2. Cari user berdasarkan email atau username
        $user = User::where('email', $request->login_id)
                    ->orWhere('username', $request->login_id)
                    ->first();

        // 3. Cek apakah user ada dan password-nya cocok
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username/Email atau password salah.'
            ], 401);
        }

        // 4. Buat token baru khusus untuk admin ini
        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'token'   => $token,
            'user'    => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        // Hapus token yang sedang digunakan saat ini agar tidak bisa dipakai lagi
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil, token telah dihapus.'
        ], 200);
    }
}