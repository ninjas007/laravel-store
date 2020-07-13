<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PragmaRX\Countries\Package\Countries;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
    	if (Cart::count() === 0) {
    		return redirect('cart');	
    	}

    	$countries = new Countries();

    	$data['title'] = 'Checkout';
    	$data['countries'] = $countries->all()->pluck('name.common')->toArray();
    	$data['items'] = Cart::content();

    	return view('frontend.pages.checkout', $data);
    }
}
