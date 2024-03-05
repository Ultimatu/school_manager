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


    /**
     * the filiere that the classe belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }


    /**
     * the classe cours for the classe
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classeCours()
    {
        return $this->hasMany(ClasseCours::class);
    }

    /**
     * the etudiants in the classe
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    /**
     * the professeurs in the classe
     */
    public function professeurs()
    {
        return ClasseCours::where('classe_id', $this->id)->get()->map(function ($classeCours) {
            return $classeCours->professeur;
        });
    }


    /**
     * the emploi du temps for the classe
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emploiDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }


    
    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }


}
