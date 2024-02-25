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
        'address',
        'etudiants_ids',
        'profession',
        'user_id',
        'type',
        'is_legal_tutor',
        'status',
        'annee_scolaire',
    ];


    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }


    public function user()
    {
        return $this->morphOne(User::class, 'role');
    }


}
