<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiteInscriptionVersement extends Model
{
    use HasFactory;


    protected $fillable = [
        'cite_inscription_id',
        'versement',
        'date_versement',
    ];


    public function citeInscription()
    {
        return $this->belongsTo(CiteInscription::class);
    }


    public function etudiant()
    {
        return CiteInscription::find($this->cite_inscription_id)->etudiant;
    }
}
