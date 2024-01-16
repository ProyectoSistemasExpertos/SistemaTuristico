<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';
    protected $primaryKey = 'idPerson';
    public $timestamps = false;

    public function recomendation(){
        return $this->belongsTo(Recommendation::class);
    }
}


