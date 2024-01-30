<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $table = 'recommendations';
    protected $primaryKey = 'idRecommendation';
    public $timestamps = false;


    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function place(){
        return $this->belongsTo(Booking::class);
    }
    
}//End of recommendation

 
