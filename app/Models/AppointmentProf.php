<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentProf extends Model
{
    use HasFactory;


    protected $fillable = [
        'professeur_id',
        'appointment_id',
        'is_present',
    ];


    public function appointment(){
       return  $this->belongsTo(Appointment::class);
    }

    public function professeur(){
        return $this->belongsTo(Professeur::class);
    }
}
