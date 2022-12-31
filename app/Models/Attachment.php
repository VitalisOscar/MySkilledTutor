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

    function getExtensionAttribute(){
        return pathinfo($this->path, PATHINFO_EXTENSION);
    }


    // Helpers
    function isImage(){
        return strtolower(explode('/', $this->type)[0]) == strtolower(self::TYPE_IMAGE);
    }

    function isPdf(){
        return !$this->isImage() && $this->extension == 'pdf';
    }

    function isWordDoc(){
        return !$this->isImage() && ($this->extension == 'docx' || $this->extension == 'doc');
    }

    function isZip(){
        return !$this->isImage() && $this->extension == 'zip';
    }

}
