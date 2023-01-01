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
        'message',
        'is_answer'
    ];

    protected $with = ['attachments', 'sender'];

    public $timestamps = true;

    // Relations
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function sender(){
        return $this->morphTo();
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachable');
    }



    // Accessors
    function getIsAnswerAttribute($val){
        if(!$val) return false;

        return $this->isFromAdmin();
    }


    // Helpers
    function isFromClient(){
        return $this->sender_type == User::MODEL_NAME;
    }

    function isFromAdmin(){
        return $this->sender_type == Admin::MODEL_NAME;
    }

    function byCurrent(){
        if(request()->is('admin*')){
            return $this->sender_type == Admin::MODEL_NAME;
        }

        return $this->sender_type == User::MODEL_NAME;
    }


}
