<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cite extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'capacity',
        'slug',
        'description',
        'type',
        'address',
    ];


    public function chambres()
    {
        return $this->hasMany(Chambre::class);
    }

    public function citeInscriptions()
    {
        return $this->hasMany(CiteInscription::class);
    }

    
}
