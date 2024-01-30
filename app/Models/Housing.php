<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housing extends Model
{
    protected $table = 'housings';
    protected $primaryKey = 'idHousing';
    public $timestamps = false;

   
    public function booking(){
        return $this->hasOne(Booking::class, 'idBooking');
    }
    public function user(){
        return $this->belongsTo(Person::class);
    }
}
