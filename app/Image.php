<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
class Image extends Model
{
    protected $appends = ['url'];
    public function getUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
