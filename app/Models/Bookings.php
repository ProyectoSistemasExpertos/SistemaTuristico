<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'idBooking';
    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'state', 'price', 'location', 'totalPossibleReservation', 'uploadDate', 'idPerson', 'idCategory'
    ];

    public function user(){
        return $this->belongsTo(Person::class);
    }
   
    public function booking_gallery(){
        return $this->hasMany(Booking_gallerys::class, 'idBooking');
    }
}
