<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    const MODEL_NAME = 'Admin';

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public $timestamps = true;



    function getMessageSenderNameAttribute(){
        return 'Tutor';
    }
}
