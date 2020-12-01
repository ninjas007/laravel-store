<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'code_order',
        'name',
        'address',
        'phone',
        'city',
        'postal_code',
        'province',
        'user_id',
        'payment_id',
        'shipping_id'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderTotal()
    {
        return $this->belongsTo('App\Models\OrderTotal', 'id');
    }

    // public function orderProduct()
    // {
    //     return $this->belongsTo('App\Models\Order', 'order_product_id');
    // }
}
