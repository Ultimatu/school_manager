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

    public function car(){
        return $this->hasOne(CarInscription::class);
    }

    public function CiteInscriptions(){
        return $this->hasMany(CiteInscription::class);
    }

    public function cite(){
        return $this->hasOne(CiteInscription::class);
    }

    public function chambre(){
        return $this->hasOne(CiteInscription::class);
    }

    public function scolarite(){
        return $this->hasOne(PaymentScolarite::class);
    }

    public function versements(){
        return DetailsPayement::where('payment_scolarite_id', $this->scolarite->id)->get();
    }

    public function parents()
    {
        return $this->hasMany(ParentChilds::class, 'etudiant_id', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(AppointmentEtudiant::class);
    }
    
    public function absences(){
        return  AppointmentEtudiant::where('etudiant_id', $this->id)->where('is_present', 0)->get();
    }


    public function notes()
    {
        return $this->hasMany(Notes::class);
    }

    public function reclamations()
    {
        return $this->hasMany(Reclamantion::class);
    }

    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatar()
    {
        return $this->avatar ? asset($this->avatar) : asset('user/avatar.png');
    }


    public function scopeProfStudents($query, $professeur_id)
    {
        return $query->whereHas('classe', function ($q) use ($professeur_id) {
            $q->whereHas('classeCours', function ($q) use ($professeur_id) {
                $q->where('professor_id', $professeur_id);
            });
        })->get();
    }
}
