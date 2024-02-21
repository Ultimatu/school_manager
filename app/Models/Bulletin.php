<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'classe_cours_id',
        'moyenne',
        'mention',
        'rang',
        'appreciation',
        'decision',
        'annee',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function classeCours()
    {
        return $this->belongsTo(ClasseCours::class);
    }

}
