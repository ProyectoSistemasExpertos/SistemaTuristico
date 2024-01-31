<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $primaryKey = 'email'; // Assuming 'email' is the primary key
    public $incrementing = false;

    protected $fillable = ['email', 'token'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
