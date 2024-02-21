<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Administration extends Model
{
    use  HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'role',
        'status',
        'responsability',
        'gender',
        'user_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'directeur';
    }


    public function isDirector()
    {
        return $this->role === 'directeur';
    }

    public function isComptable()
    {
        return $this->role === 'comptable';
    }


    public function isSecretaire()
    {
        return $this->role === 'secretaire';
    }

    public function isConsellor()
    {
        return $this->role === 'conselleir';
    }

}

