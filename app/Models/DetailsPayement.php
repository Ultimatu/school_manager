<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsPayement extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_scolarite_id',
        'amount',
        'date',
        'observation',
    ];

    public function paymentScolarite()
    {
        return $this->belongsTo(PaymentScolarite::class);
    }
}
