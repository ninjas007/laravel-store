<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTotal extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_detail_id',
        'total_all',
    ];

    protected $hidden = [
        'order_detail_id', 'id',
    ];

    public function orderDetail()
    {
    	return $this->belongsTo('App\Models\OrderDetail');
    }
}
