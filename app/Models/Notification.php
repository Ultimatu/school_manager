<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'status',
        'icon',
        'link',
        'is_read'
    ];


    /**
     * the sender of the notification
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


    /**
     * the receiver of the notification
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }


    /**
     * scope to get all unread notifications
     * @param $query
     * @return mixed
     */
    public function scopeUnread($query){
        return $query->where('status', 0)->where('receiver_id', auth()->user()->id)->orWhere('is_read', 0)->where('receiver_id', auth()->user()->id)->get();
    }

    /**
     * scope to get all read notifications
     * @param $query
     * @return mixed
     */
    public function scopeRead($query){
        return $query->where('status', 1)->orWhere('is_read', 1)->get();
    }
}
