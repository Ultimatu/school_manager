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



}
