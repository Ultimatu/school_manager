<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiteInscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'chambre_id',
        'is_paid',
        'versements',
        'total_amount',
        'annee_scolaire'
    ];

    public function chambre(){
        return $this->belongsTo(Chambre::class);
    }


    public function etudiant(){
        return $this->belongsTo(Etudiant::class);
    }
}
