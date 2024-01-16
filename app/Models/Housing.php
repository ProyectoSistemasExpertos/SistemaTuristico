<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housing extends Model
{
    protected $table = 'housing';
    protected $primaryKey = 'idHousing';
    public $timestamps = false;
}
