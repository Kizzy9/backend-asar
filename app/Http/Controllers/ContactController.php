<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Informasi kontak tempat berkuda',
            'data'    => Contact::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'whatsapp_number' => 'required|string|max:20',
            'email'           => 'nullable|email|max:255',
            'address'         => 'nullable|string',
            'instagram_link'  => 'nullable|url',
        ]);

        $contact = Contact::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kontak berhasil ditambahkan',
            'data'    => $contact
        ], 201);
    }

    public function show(Contact $contact)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail info kontak',
            'data'    => $contact
        ], 200);
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'whatsapp_number' => 'sometimes|required|string|max:20',
            'email'           => 'nullable|email|max:255',
            'address'         => 'nullable|string',
            'instagram_link'  => 'nullable|url',
        ]);

        $contact->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kontak berhasil diubah',
            'data'    => $contact
        ], 200);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kontak berhasil dihapus'
        ], 200);
    }
}