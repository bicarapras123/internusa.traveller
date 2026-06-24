<?php

namespace App\Http\Controllers;

use App\Models\Order; // Model ini sekarang terhubung ke tabel 'bookings'
use Illuminate\Support\Facades\Auth;

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
}