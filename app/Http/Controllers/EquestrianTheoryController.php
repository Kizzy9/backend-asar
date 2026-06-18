<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquestrianTheoryController extends Controller
{
    public function index()
    {
        // Mengambil data artikel edukasi equestrian dari database dan memformatnya
        $theories = \App\Models\Theory::all()->map(function($theory) {
            return [
                'id' => $theory->id,
                'title' => $theory->title,
                'date' => $theory->created_at ? $theory->created_at->format('d F, Y') : date('d F, Y'),
                'excerpt' => $theory->excerpt,
                'content' => $theory->content,
                'image_url' => $theory->image_url
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data materi equestrian.',
            'data' => $theories
        ], 200);
    }
}