<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Cart;

class CartController extends Controller
{
    public function index()
    {
    	$data['title'] = 'Cart';
    	$data['carts'] = Cart::content();

    	return view('frontend.pages.cart', $data);
    }
}
