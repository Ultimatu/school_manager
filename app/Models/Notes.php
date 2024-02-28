<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;


    protected $fillable = [
        'etudiant_id',
        'classe_cours_id',
        'professeur_id',
        'note',
        'observation',
        'type',
        'date',
        'annee_scolaire'
    ];


    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function classeCours()
    {
        return $this->belongsTo(ClasseCours::class);
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }


    public function scopeCurrentYear($query){
        return $query->where('annee_scolaire', AnneeScolaire::valideYear())->get();
    }

}
