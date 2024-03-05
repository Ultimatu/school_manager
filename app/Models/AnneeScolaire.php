<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;


    protected $fillable = [
        'annee_scolaire',
        'debut',
        'fin',
        'is_finish',
        'status'
    ];


    public function classes(): mixed
    {
        return Classe::where('year', $this->annee_scolaire)->get();
    }

    public function etudiants(): mixed
    {
        return Etudiant::where('annee_scolaire', $this->annee_scolaire)->get();
    }

    public function professeurs(): mixed
    {
        return Professeur::where('annee_scolaire', $this->annee_scolaire)->get();
    }


    /**
     * get the current year
     * @param $query
     * @return mixed
     */
    public function scopeValideYear($query): mixed
    {
        return $query->where('status', 'en cours')->first()->annee_scolaire;
    }
}
