<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['phone','zipcode','building','landmark','address','user_id'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
