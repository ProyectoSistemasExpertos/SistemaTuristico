<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $table = 'preference';
    protected $primaryKey = 'idPreference';
    public $timestamps = false;


    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function place(){
        return $this->belongsTo(Booking::class);
    }
}
