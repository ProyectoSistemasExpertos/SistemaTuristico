<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{
    protected $table = 'preferences';
    protected $primaryKey = 'idPreference';
    public $timestamps = false;

    protected $fillable = ['idPerson', 'idCategory'];
    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function place(){
        return $this->belongsTo(Bookings::class);
    }
}
