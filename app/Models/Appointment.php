<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'start_date',
        'end_date',
        'annee_scolaire',
        'classe_id',
        'professeur_id',
        'classe_cours_id',
        'date'
    ];

    public function etudiantAppointments(){
        return $this->hasMany(AppointmentEtudiant::class);
    }

    public function profAppointments(){
        return $this->hasMany(AppointmentProf::class);
    }
}
