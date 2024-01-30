<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_gallerys extends Model
{
    protected $table = 'booking_Gallerys';
    protected $primaryKey = 'idBooking_gallery';
    public $timestamps = false;
    protected $fillable = ['image'];
}
