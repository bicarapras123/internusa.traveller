<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{

    protected $fillable = ['booking_id', 'nik', 'kode_booking', 'tujuan_wisata'];


public function booking()
{
    return $this->belongsTo(
        Booking::class
    );
}

}