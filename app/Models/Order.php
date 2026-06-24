<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'bookings'; // <--- Tambahkan ini agar Laravel mencari tabel 'bookings'

    protected $fillable = [
        'full_name', 'email', 'phone', 'departure_date', 
        'quantity', 'address', 'country', 'status', 'total_price'
    ];
}