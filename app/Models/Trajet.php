<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'slug',
        'waypoints',
        'city_departure_time',
        'school_departure_time',
    ];


    public function chauffeurs(){
        return $this->hasMany(Chauffeur::class);
    }

}
