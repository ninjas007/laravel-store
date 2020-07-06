<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = [];

    public function product()
    {
    	// return $this->hasMany(Product::class, 'category_id');
        // return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
}
