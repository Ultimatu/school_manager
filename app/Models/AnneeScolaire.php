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


    public function classes()
    {
        return Classe::where('year', $this->annee_scolaire)->get();
    }

    public function etudiants(){
        return Etudiant::where('annee_scolaire', $this->annee_scolaire)->get();
    }
}
