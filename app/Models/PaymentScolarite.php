<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentScolarite extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'amount',
        'is_paid',
        'observation',
    ];
}
