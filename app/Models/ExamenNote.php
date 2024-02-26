<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'examen_id',
        'etudiant_id',
        'note',
        'annee_scolaire'
    ];


    public function examen(){
        return $this->belongsTo(Examen::class);
    }

    public function etudiant(){
        return $this->belongsTo(Etudiant::class);
    }

    public function forThisYear(){
        $year = date('Y');
        $recentYear = $year - 1;
        $anneeScolaire = $recentYear . '-' . $year;
        return $this->where('annee_scolaire', 'like', '%' . $anneeScolaire . '%')->get();
    }


}
