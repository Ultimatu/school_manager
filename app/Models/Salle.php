<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'is_available',
        'capacity',
        'type',
        'location',
    ];

    public function emploiDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    public function isAvailable()
    {
        return $this->is_available;
    }
}
