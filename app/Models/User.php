<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public function preferences()
    {
<<<<<<< HEAD
        return $this->hasMany(Preference::class, 'idPerson', 'id');
=======
        return $this->hasMany(Preferences::class, 'idPerson');
>>>>>>> 763370ad3d2cbd8ef46e83ffbed9a8ec9e8d8217
    }

    public function categories() {
        return $this->belongsTo(Categories::class, 'idCategory');
    }

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function passwordResetTokens()
    {
        return $this->hasMany(PasswordResetToken::class, 'email', 'email');
    }
}
