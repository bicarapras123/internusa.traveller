<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request; // <--- INI YANG KURANG!

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Gunakan whereHas untuk mencari data di relasi 'participants'
        $query = \App\Models\Booking::query();
    
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            
            $query->where(function($q) use ($searchTerm) {
                // Cari berdasarkan nama di tabel bookings
                $q->where('full_name', 'like', '%' . $searchTerm . '%')
                  // ATAU cari kode_booking di tabel participants
                  ->orWhereHas('participants', function($q) use ($searchTerm) {
                      $q->where('kode_booking', 'like', '%' . $searchTerm . '%');
                  });
            });
        }
    
        $bookings = $query->latest()->get();
        
        return view('admin.dashboard', compact('bookings'));
    }
    
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:pending,paid,cancelled']);
        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

}