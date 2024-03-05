<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamantion extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'evaluation_id',
        'examen_id',
        'objet',
        'message',
        'status',
        'date',
        'file',
        'is_exam'
    ];

    /**
     * the response of the reclamantion
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function response()
    {
        return $this->hasOne(ReclamationResponse::class);
    }

    /**
     * the etudiant that created the reclamantion
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    /**
     * the evaluation that the reclamantion is for
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    /**
     * the exam that the reclamantion is for
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
    
    /**
     * the notes that the reclamantion is for
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * the notes that the reclamantion is for
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    /**
     * the notes that the reclamantion is for
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scopeExam($query)
    {
        return $query->where('is_exam', true);
    }

    /**
     * the notes that the reclamantion is for
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scopeEvaluation($query)
    {
        return $query->where('is_exam', false);
    }

  
}
