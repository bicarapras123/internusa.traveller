<?php

namespace App\Http\Controllers;

use App\Models\TravelItem;
use App\Models\Booking;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index($id)
    {
        $destination = TravelItem::findOrFail($id);
        return view('checkout', compact('destination'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Ketat
        $request->validate([
            'destination_id' => 'required|exists:travel_items,id',
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:20',
            'nik'            => 'required|array|min:1',
            'nik.*'          => 'required|digits:16',
            'departure_date' => 'required|date',
            'quantity'       => 'required|integer|min:1|max:5',
            'address'        => 'required',
            'country'        => 'required',
            'card_name'      => 'required',
            'card_number'    => 'required|digits:16',
            'card_expiry'    => 'required',
            'card_cvv'       => 'required|digits:3',
        ]);

        $travel = TravelItem::findOrFail($request->destination_id);
        $kodeBooking = 'TRV-' . strtoupper(Str::random(8));

        // 2. Gunakan Transaksi Database agar aman saat di Hosting
        return DB::transaction(function () use ($request, $travel, $kodeBooking) {
            try {
                $booking = Booking::create([
                    'destination_id' => $travel->id,
                    'full_name'      => $request->full_name,
                    'email'          => $request->email,
                    'phone'          => $request->phone,
                    'departure_date' => $request->departure_date,
                    'quantity'       => $request->quantity,
                    'address'        => $request->address,
                    'country'        => $request->country,
                    'card_name'      => $request->card_name,
                    'card_number'    => encrypt($request->card_number),
                    'card_expiry'    => $request->card_expiry,
                    'card_cvv'       => encrypt($request->card_cvv),
                    'total_price'    => $travel->price * $request->quantity,
                    'status'         => 'pending',
                ]);

                foreach ($request->nik as $nik) {
                    Participant::create([
                        'booking_id'    => $booking->id,
                        'nik'           => $nik,
                        'kode_booking'  => $kodeBooking,
                        'tujuan_wisata' => $travel->name,
                    ]);
                }

                return redirect()->back()->with('success', 'Pesanan berhasil dibuat! Kode: ' . $kodeBooking);

            } catch (\Exception $e) {
                // Ganti sementara menjadi dd($e->getMessage());
                dd($e->getMessage()); 
                
                \Log::error('Checkout Error: ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
            }
        });
    }
}