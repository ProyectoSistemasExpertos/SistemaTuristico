<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housing extends Model
{
    protected $table = 'housing';
    protected $primaryKey = 'idHousing';
    public $timestamps = false;

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function user(){
        return $this->belongsTo(Person::class);
    }
}
