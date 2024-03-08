<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'phone',
        'email', 
        'address',
        'profession',
        'user_id',
        'type',
        'is_legal_tutor',
        'status',
        'annee_scolaire',
        'avatar'
    ];


    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function etudiants()
    {
       return $this->hasMany(ParentChilds::class, 'parent_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
