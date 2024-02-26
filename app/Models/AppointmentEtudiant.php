<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentEtudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'appointment_id',
        'is_present',
    ];


    public function appointment(){
       return  $this->belongsTo(Appointment::class);
    }

    public function etudiant(){
        return $this->belongsTo(Etudiant::class);
    }
}
