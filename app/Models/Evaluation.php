<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;


    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'professeur_id',
        'classe_cours_id',
        'sujet',
        'duree',
        'date',
        'annee_scolaire',
        'coefficient',
        'max_note',
    ];



    /**
     * the professeur that created the evaluation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professeur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Professeur::class);
    }

    /**
     * the classe cours that the evaluation is for
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classeCours(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ClasseCours::class);
    }


     /**
     * the evaluation notes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes(){
        return $this->hasMany(Notes::class);
    }
}
