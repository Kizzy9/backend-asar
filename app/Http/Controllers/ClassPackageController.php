<?php

namespace App\Http\Controllers;

use App\Models\ClassPackage;
use Illuminate\Http\Request;

class ClassPackageController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar paket kelas berkuda',
            'data'    => ClassPackage::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric',
            'duration_minutes' => 'required|integer',
            'session_count'    => 'required|integer',
        ]);

        $classPackage = ClassPackage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paket kelas berhasil ditambahkan',
            'data'    => $classPackage
        ], 201);
    }

    public function show(ClassPackage $class)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail paket kelas',
            'data'    => $class
        ], 200);
    }

    public function update(Request $request, ClassPackage $class)
    {
        $validated = $request->validate([
            'name'             => 'sometimes|required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'sometimes|required|numeric',
            'duration_minutes' => 'sometimes|required|integer',
            'session_count'    => 'sometimes|required|integer',
        ]);

        $class->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paket kelas berhasil diubah',
            'data'    => $class
        ], 200);
    }

    public function destroy(ClassPackage $class)
    {
        $class->delete();

        return response()->json([
            'success' => true,
            'message' => 'Paket kelas berhasil dihapus'
        ], 200);
    }
}