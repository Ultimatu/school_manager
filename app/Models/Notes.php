<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;


    protected $fillable = [
        'evaluation_id', // add this line
        'etudiant_id',
        'note',
        'observation',
        'annee_scolaire'
    ];


    public function evalutation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }


    public function scopeCurrentYear($query){
        return $query->where('annee_scolaire', AnneeScolaire::valideYear())->get();
    }

}
