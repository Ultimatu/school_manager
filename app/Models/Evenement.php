<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'type',
        'classes_ids',
        'date_heure_debut',
        'date_time_fin',
        'send_to_all',
        'salle_id',
        'only_for_admins',
        'only_for_profs',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'classes_ids' => 'array',
    ];

    /**
     * Get the classes for the evenement.
     */
    public function getReceivers()
    {
        if ($this->send_to_all) {
            return 'all';
        }
        foreach ($this->classes_ids as $class_id) {
            $class = Classe::find($class_id);
            $receivers[] = $class->etudiants->pluck('id');
        }
        return $receivers;
    }

    /**
     * Get the salle that owns the evenement.
     */
    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
}
