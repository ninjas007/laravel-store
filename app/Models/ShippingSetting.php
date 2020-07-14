<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingSetting extends Model
{
    public function shipping()
    {
    	return $this->hasOne(Shipping::class);
    }
}
