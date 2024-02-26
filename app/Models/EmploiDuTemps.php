<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id',
        'professeur_id',
        'salle_id',
        'classe_cours_id',
        'day',
        'start_date_time',
        'end_date_time',
        'annee_scolaire'
    ];


    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }


    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }


    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }


    public function classeCours()
    {
        return $this->belongsTo(ClasseCours::class);
    }




}
