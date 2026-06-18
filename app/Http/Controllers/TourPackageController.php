<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar paket wisata berkuda',
            'data'    => TourPackage::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
        ]);

        $tourPackage = TourPackage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paket wisata berhasil ditambahkan',
            'data'    => $tourPackage
        ], 201);
    }

    public function show(TourPackage $tour)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail paket wisata',
            'data'    => $tour
        ], 200);
    }

    public function update(Request $request, TourPackage $tour)
    {
        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric',
        ]);

        $tour->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paket wisata berhasil diubah',
            'data'    => $tour
        ], 200);
    }

    public function destroy(TourPackage $tour)
    {
        $tour->delete();

        return response()->json([
            'success' => true,
            'message' => 'Paket wisata berhasil dihapus'
        ], 200);
    }
}