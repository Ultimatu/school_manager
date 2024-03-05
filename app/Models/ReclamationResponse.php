<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReclamationResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'reclamantion_id',
        'message',
        'date',
        'piece_jointe',
    ];

    /**
     * the reclamantion that the response is for
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reclamantion()
    {
        return $this->belongsTo(Reclamantion::class);
    }

    public function scopeCurrentYear($query){
        return $query->where('date', '>=', AnneeScolaire::valideYear())->get();
    }

    public function scopeCurrentMonth($query){
        return $query->where('date', '>=', now()->subMonth())->get();
    }

    public function scopeCurrentWeek($query){
        return $query->where('date', '>=', now()->subWeek())->get();
    }

    public function scopeCurrentDay($query){
        return $query->where('date', '>=', now()->subDay())->get();
    }

    public function scopeCurrentHour($query){
        return $query->where('date', '>=', now()->subHour())->get();
    }
}
