<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


    protected $fillable = [
        'matricule',
        'marque',
        'model',
        'type',
        'status'
    ];


    public function carInscriptions()
    {
        return $this->hasMany(CarInscription::class);
    }


    public function chauffeur()
    {
        return $this->hasOne(Chauffeur::class);
    }


}
