<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperType extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function orders(){
        return $this->hasMany(Order::class, 'paper_type_id');
    }
}
