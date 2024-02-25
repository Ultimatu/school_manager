<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    use HasFactory;


    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'avatar',
        'status',
        'car_id',
        'trajet_id',
        'annee_scolaire',
        'slug'
    ];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }


    
}
