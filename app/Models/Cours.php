<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_available',
        'avatar',
        'annee_scolaire',
    ];

    public function classeCours()
    {
        return $this->hasMany(ClasseCours::class);
    }

    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class, 'classe_cours', 'cours_id', 'professor_id');
    }


}
