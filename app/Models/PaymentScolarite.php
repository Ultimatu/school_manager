<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentScolarite extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'amount',
        'is_paid',
        'observation',
        'annee_scolaire',
    ];


    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }


    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'annee_scolaire', 'annee_scolaire');
    }

    public function details(){
        return $this->hasMany(DetailsPayement::class);
    }
}
