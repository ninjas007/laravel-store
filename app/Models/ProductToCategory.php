<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToCategory extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function products()
    {
    	return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
