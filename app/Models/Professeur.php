<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'gender',
        'is_available',
        'matricule',
        'specialities',
        'user_id',
        'annee_scolaire',

    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \bcrypt($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function courses()
    {
        return $this->hasMany(ClasseCours::class);
    }

    public function emploiDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    public function notes()
    {
        return $this->hasMany(Notes::class);
    }

    public function hasCourseToday()
    {
        return $this->emploiDuTemps()->where('start_date_time', 'like', '%' . date('Y-m-d') . '%')->exists();
    }


    public function dailyEmplois(){
        return $this->emploiDuTemps()->where('start_date_time', 'like', '%' . date('Y-m-d') . '%')->get();
    }
}
