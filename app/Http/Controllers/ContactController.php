<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Di sini Anda bisa mengirim email atau menyimpan ke database
        // Contoh: Contact::create($validated);

        return back()->with('success', 'Pesan Anda berhasil terkirim!');
    }
}