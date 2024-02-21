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

    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function professor()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function bulletins()
    {
        return $this->hasMany(Bulletin::class);
    }

}
