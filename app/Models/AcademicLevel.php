<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicLevel extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function orders(){
        return $this->hasMany(Order::class, 'academic_level_id');
    }
}
