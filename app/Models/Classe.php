<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'level',
        'year',
        'filiere_id',
        'credits',
    ];


    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }


    public function classeCours()
    {
        return $this->hasMany(ClasseCours::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function professeurs()
    {
        return ClasseCours::where('classe_id', $this->id)->get()->map(function ($classeCours) {
            return $classeCours->professeur;
        });
    }


    public function emploiDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }


    public function examens()
    {
        return Examen::where('classe_id', $this->id)->get();
    }

}
