<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'idBooking';
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(Person::class);
    }
   
    public function booking_gallery(){
        return $this->hasMany(Booking_gallery::class, 'idBooking');
    }
}
