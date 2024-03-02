<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'trajet_id',
        'is_paid',
        'total_amount',
        'annee_scolaire'
    ];

   
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function versements()
    {
        return $this->hasMany(CarInscriptionVersement::class);
    }


    
}
