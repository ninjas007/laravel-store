<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_detail_id',
        'order_product_id',
    ];

    public function orderDetail()
    {
    	return $this->hasMany('App\Models\OrderDetail');
    }
}
