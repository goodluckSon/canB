<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flake extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'order_id', 'data',];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['data' => 'object',];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
