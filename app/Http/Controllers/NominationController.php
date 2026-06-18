<?php

namespace App\Http\Controllers;

use App\Models\Nomination;
use Illuminate\Http\Request;

class NominationController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar nominasi dan prestasi',
            'data'    => Nomination::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'year'        => 'required|integer|digits:4',
            'description' => 'nullable|string',
        ]);

        $nomination = Nomination::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Nominasi berhasil ditambahkan',
            'data'    => $nomination
        ], 201);
    }

    public function show(Nomination $nomination)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail nominasi',
            'data'    => $nomination
        ], 200);
    }

    public function update(Request $request, Nomination $nomination)
    {
        $validated = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'year'        => 'sometimes|required|integer|digits:4',
            'description' => 'nullable|string',
        ]);

        $nomination->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Nominasi berhasil diubah',
            'data'    => $nomination
        ], 200);
    }

    public function destroy(Nomination $nomination)
    {
        $nomination->delete();

        return response()->json([
            'success' => true,
            'message' => 'Nominasi berhasil dihapus'
        ], 200);
    }
}