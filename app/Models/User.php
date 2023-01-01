<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const MODEL_NAME = 'User';

    const SECURITY_QUESTIONS = [
        1 => 'Which city were you born in?',
        2 => 'What high school did you attend',
        3 => 'What is your favorite movie?',
        4 => 'What is the best book you have read?',
        5 => 'What is your favorite video game?',
        6 => 'What is your favorite sport?',
        7 => 'What is your favorite animal?',
        8 => 'What is your favorite holiday?',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'security_question',
        'security_question_answer',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'security_question',
        'security_question_answer',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = true;


    // RELATIONS
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function countable_orders(){
        return $this->orders()->where(function($q){
            $q->whereIn('status', Order::COUNTABLE_ORDER_STATUS);
        });
    }


    // Accessors
    public function getFmtCreatedAtAttribute(){
        return $this->created_at->diffForHumans();
    }


    function getMessageSenderNameAttribute(){
        return $this->name;
    }



    // Helpers
}
