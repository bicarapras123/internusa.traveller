<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'destination_id', 'full_name', 'email', 'phone', 'departure_date', 
        'quantity', 'address', 'country', 'card_name', 'card_number', 
        'card_expiry', 'card_cvv', 'total_price', 'status'
    ];

    // Tambahkan ini agar bisa memanggil $order->participants
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}