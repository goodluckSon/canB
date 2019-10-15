<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','flake_id','amount_paid','txn_id','status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['status' => 'integer'];
    
    public function order()
    {
        return $this->belongsTo('App\User');
    }
    public function flake()
    {
        return $this->hasOne('App\Flake');
    }
}
