<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInscriptionVersement extends Model
{
    use HasFactory;


    protected $fillable = [
        'car_inscription_id',
        'versement',
        'date_versement',
    ];


    public function carInscription()
    {
        return $this->belongsTo(CarInscription::class);
    }


    public function etudiant()
    {
        return CarInscription::find($this->car_inscription_id)->etudiant;
    }
}
