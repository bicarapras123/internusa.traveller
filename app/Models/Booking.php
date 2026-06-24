<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'destination_id',
        'kode_booking', // <--- TAMBAHKAN INI
        'full_name',
        'email',
        'phone',
        'departure_date',
        'quantity',
        'address',
        'country',
        'card_name',
        'card_number',
        'card_expiry',
        'card_cvv',
        'total_price',
        'status'
    ];


public function destination()
{
    return $this->belongsTo(
        TravelItem::class,
        'destination_id'
    );
}


public function participants()
{
    return $this->hasMany(
        Participant::class
    );
}


}