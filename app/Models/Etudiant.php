<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Etudiant extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'classe_id',
        'avatar',
        'student_mat',
        'card_id',
        'nationality',
        'birth_date',
        'birth_place',
        'cin',
        'user_id',
        'status',
        'urgent_phone',
        'annee_scolaire',
        'gender',
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

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }


    public function bulletins()
    {
        return $this->hasMany(Bulletin::class);
    }


    public function carInscriptions(){
        return $this->hasMany(CarInscription::class);
    }

    public function CiteInscriptions(){
        return $this->hasMany(CiteInscription::class);
    }

    public function scolarite(){
        return $this->hasOne(PaymentScolarite::class);
    }

    public function versements(){
        return DetailsPayement::where('payment_scolarite_id', $this->scolarite->id)->get();
    }


    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatar()
    {
        return $this->avatar ? asset('students/' . $this->avatar) : asset('students/avatar.png');
    }


}
