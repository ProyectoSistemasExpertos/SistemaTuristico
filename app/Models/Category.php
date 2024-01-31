<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'idCategory';
    public $timestamps = false;

    public function recommendation(){
        return $this->belongsTo(Recommendation::class);
    }
}
