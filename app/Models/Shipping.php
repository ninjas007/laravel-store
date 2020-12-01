<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
	protected $guarded = [];

	// protected $hidden = [
	// 	'setting'
	// ];

    public function shippingSetting()
    {
    	return $this->hasMany(ShippingSetting::class);
    }
}
