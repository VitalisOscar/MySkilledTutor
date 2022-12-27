<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUS_PENDING = 'Pending';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_FAILED = 'Failed';

    protected $fillable = [
        'order_id',
        'amount',
        'currency',
        'method',
        'reference',
        'data',
        'status'
    ];

    public $timestamps = true;

    protected $casts = [
        'data' => 'array'
    ];


    // Relations
    public function order(){
        return $this->belongsTo(Order::class);
    }


    // Scopes
    public function scopePending($query){
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeCompleted($query){
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeFailed($query){
        return $query->where('status', self::STATUS_FAILED);
    }


}
