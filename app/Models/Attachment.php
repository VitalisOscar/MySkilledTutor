<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    const TYPE_FILE = 'File';
    const TYPE_IMAGE = 'Image';

    protected $fillable = [
        'path',
        'type',
        'name',
        'attachable_id',
        'attachable_type'
    ];

    public $timestamps = true;

    protected $hidden = [
        'attachable_id',
        'attachable_type',
        'path',
        'type',
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'url'
    ];



    // RELATIONS
    public function attachable(){
        return $this->morphTo();
    }


    // ACCESSORS
    public function getUrlAttribute(){
        return asset('storage/'.$this->path);
    }


    // Helpers
    function isImage(){
        return $this->type == self::TYPE_IMAGE;
    }

}
