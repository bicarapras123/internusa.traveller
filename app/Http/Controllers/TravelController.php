<?php

namespace App\Http\Controllers;

use App\Models\TravelItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    /**
     * Menampilkan halaman depan dengan daftar item terbaru
     */
// HAPUS fungsi filterByCategory() karena kita satukan di index()

    // Ganti index() Anda menjadi ini agar semua link kategori bekerja
    public function index(Request $request)
    {
        $query = TravelItem::query();
    
        // Filter Nama Wisata
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Filter Kategori
        if ($request->filled('category')) {
            $query->where('type', $request->category);
        }
    
        $items = $query->latest()->get();
    
        // Jika di dashboard, ke view dashboard. Jika tidak, ke view welcome
        if ($request->routeIs('dashboard')) {
            return view('dashboard', compact('items'));
        }
    
        return view('welcome', compact('items'));
    }
    /**
     * Menyimpan Item Wisata baru
     */
    public function storeItem(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'type'        => 'required|string',
            'is_active'   => 'required|boolean',
            'description' => 'nullable|string',
            'image_url'   => 'nullable|string',
        ]);
    
        // Generate slug otomatis dari nama
        $validated['slug'] = Str::slug($request->name);
        
        TravelItem::create($validated);
    
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail item
     */
    public function showItem(TravelItem $travelItem)
    {
        return view('travel.show', compact('travelItem'));
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $item = TravelItem::findOrFail($id);
        return view('travel.edit', compact('item'));
    }

    /**
     * Menyimpan hasil edit
     */
    public function update(Request $request, $id)
    {
        $item = TravelItem::findOrFail($id);
        $item->update($request->all());
        
        return redirect()->route('dashboard')
         ->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Menghapus item
     */
    public function destroy($id)
    {
        $item = TravelItem::findOrFail($id);
        $item->delete();
        
        return redirect()->back()->with('success', 'Wisata berhasil dihapus!');
    }

    public function filterByCategory($category)
    {
        // Mengasumsikan model TravelItem memiliki kolom 'type' atau 'category'
        // Sesuaikan dengan nama kolom di database Anda
        $travelItems = TravelItem::where('type', $category)->get(); 

        return view('category-results', compact('travelItems', 'category'));
    }

    public function search(Request $request)
    {
        $query = TravelItem::query();

        // Filter Nama
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter Kategori
        if ($request->filled('category')) {
            $query->where('type', $request->category);
        }

        $travelItems = $query->latest()->get();
        $category = $request->category ?? 'Pencarian Anda';

        // Mengembalikan ke halaman hasil yang sudah Anda buat sebelumnya
        return view('category-results', compact('travelItems', 'category'));
    }

}