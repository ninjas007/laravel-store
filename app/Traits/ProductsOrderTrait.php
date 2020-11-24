<?php 

namespace App\Traits;

use Cart;

trait ProductsOrderTrait
{
    public function getWeightProductsOrder()
    {
     	$items = Cart::content();
     	$weight = [];

     	foreach ($items as $item) {
     	    $weight[] += $item->weight * $item->qty;
     	}

     	return intval(array_sum($weight));   
    }

    public function getTotalProductsOrder()
    {
    	$items = Cart::content();
    	$total = 0;

    	foreach ($items as $item) {
    	    $total += $item->price * $item->qty;
    	}

    	return intval($total);
    }
}
