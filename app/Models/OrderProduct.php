<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'qty',
        'total'
    ];

    public function orders()
    {
    	return $this->hasMany('App\Models\Order');
    }

    // public function products()
    // {
    // 	return $this->hasMany('App\Models\Product', 'id');
    // }
}
