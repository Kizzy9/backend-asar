<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function cekStatus()
    {
        // Mengembalikan pesan JSON sederhana
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Selamat! Endpoint baru kamu berhasil menyala 100%!',
            'kode' => 200
        ]);
    }
}