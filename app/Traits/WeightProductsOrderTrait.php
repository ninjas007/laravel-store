<?php 

namespace App\Traits;

use Cart;

trait WeightProductsOrderTrait
{
    public function getWeightProductsOrder()
    {
     	$items = Cart::content();
     	$weight = [];

     	foreach ($items as $key => $item) {
     	    $weight[] += $item->weight * $item->qty;
     	}

     	return intval(array_sum($weight));   
    }
}
