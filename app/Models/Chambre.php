<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'type',
        'status',
        'cite_id',
        'is_occupied',
        'location',
        'capacity',
        'slug'
    ];


    public function cite()
    {
        return $this->belongsTo(Cite::class);
    }

    public function occupants()
    {
        return CiteInscription::where('chambre_id', $this->id)->get();
    }
    
}
