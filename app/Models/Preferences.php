<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{
    protected $table = 'preferences';
    protected $primaryKey = 'idPreference';
    public $timestamps = false;

<<<<<<< HEAD:app/Models/Preference.php

    public function user()
{
    return $this->belongsTo(User::class, 'idPerson', 'id'); // Ajusta los nombres de columna según tu base de datos
}
    public function categories() {
        return $this->belongsTo(Category::class, 'idCategory');
    }

=======
    protected $fillable = ['idPerson', 'idCategory'];
>>>>>>> 763370ad3d2cbd8ef46e83ffbed9a8ec9e8d8217:app/Models/Preferences.php
    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function place(){
        return $this->belongsTo(Bookings::class);
    }
}
