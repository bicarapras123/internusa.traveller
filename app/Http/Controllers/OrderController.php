<?php

namespace App\Http\Controllers;


use App\Models\Order; // Model ini sekarang terhubung ke tabel 'bookings'
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Booking;

class OrderController extends Controller
{
    public function index()
    {
        // Jika admin, arahkan ke dashboard admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard'); 
        }
    
        // Jika user biasa, tampilkan pesanan milik mereka saja
        $orders = Order::where('email', auth()->user()->email)->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function searchForm()
    {
        return view('orders.search');
    }

    // Proses cek booking
    public function search(Request $request)
    {
        $request->validate([
            'kode_booking' => 'required',
            'email' => 'required|email',
        ]);

        $participant = Participant::where('kode_booking', $request->kode_booking)
            ->first();

        if (!$participant) {
            return back()->withErrors([
                'error' => 'Kode booking tidak ditemukan.'
            ]);
        }

        $booking = Booking::with('participants')
            ->where('id', $participant->booking_id)
            ->where('email', $request->email)
            ->first();

        if (!$booking) {
            return back()->withErrors([
                'error' => 'Email tidak sesuai dengan booking.'
            ]);
        }

        return view('orders.result', compact('booking'));
    }
}