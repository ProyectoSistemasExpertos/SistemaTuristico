<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $table = 'preferences';
    protected $primaryKey = 'idPreference';
    public $timestamps = false;


    public function user()
{
    return $this->belongsTo(User::class, 'idPerson', 'id'); // Ajusta los nombres de columna según tu base de datos
}
    public function categories() {
        return $this->belongsTo(Category::class, 'idCategory');
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function place(){
        return $this->belongsTo(Booking::class);
    }
}
