<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const MODEL_NAME = 'Message';

    protected $fillable = [
        'order_id',
        'sender_id',
        'sender_type',
        'text',
    ];

    public $timestamps = true;

    // Relations
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function sender(){
        return $this->morphTo();
    }


}
