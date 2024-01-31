<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housings extends Model
{
    protected $table = 'housings';
    protected $primaryKey = 'idHousing';
    public $timestamps = false;

   
    public function booking(){
        return $this->hasOne(Bookings::class, 'idBooking');
    }
    public function user(){
        return $this->belongsTo(Person::class);
    }
}
