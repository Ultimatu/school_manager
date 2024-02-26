<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id',
        'salle_id',
        'classe_cours_id',
        'professeur_id',
        'day',
        'start_date_time',
        'end_date_time',
        'annee_scolaire'
    ];


    /**
     * Get the classe that owns the Examen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    /**
     * Get the salle that owns the Examen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }



    /**
     * Get the classeCours that owns the Examen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classeCours()
    {
        return $this->belongsTo(ClasseCours::class);
    }


    /**
     * Get the professeur that owns the Examen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }


}
