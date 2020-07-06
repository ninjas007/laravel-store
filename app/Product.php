<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public function categories()
	{
	    return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
	}
}
