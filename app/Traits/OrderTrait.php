<?php 

namespace App\Traits;

use Cart;

trait OrderTrait
{
    public function getWeightProductsOrder()
    {
     	$weight = [];
        $items = Cart::content();
     	
        foreach ($items as $item) {
     	    $weight[] += $item->weight * $item->qty;
     	}

     	return intval(array_sum($weight));   
    }

    public function getTotalProductsOrder()
    {
    	$total = 0;
        $items = Cart::content();

    	foreach ($items as $item) {
    	    $total += $item->price * $item->qty;
    	}

    	return intval($total);
    }

    public function getProductsOrder()
    {
        $results = [];
        $items = Cart::content();

        foreach ($items->toArray() as $value) {
            $results[] = $value;
        }

        return $results;
    }

    public function removeItemsCart()
    {
        Cart::destroy();
    }

    public function getOngkirProductsOrder()
    {
        return 50000;
    }
}
