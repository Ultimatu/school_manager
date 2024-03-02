<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseCours extends Model
{
    use HasFactory;


    protected $fillable = [
        'classe_id',
        'cours_id',
        'professor_id',
        'semester',
        'start_date',
        'end_date',
        'is_available',
        'is_done',
        'credit',
        'total_hours',
        'annee_scolaire'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professor_id');
    }

    public function bulletins()
    {
        return $this->hasMany(Bulletin::class);
    }

    public function notes(){
        return $this->hasMany(Notes::class);
    }

    public function examen(){
        return $this->hasOne(ExamenNote::class);
    }


    public function scopeProfCours($query){
      return   $query->where('professor_id', auth()->user()->professeur->id)->get();
    }

    public function scopeEtudiantCours($query){
        return   $query->where('classe_id', auth()->user()->etudiant->classe_id)->get();
      }

}
