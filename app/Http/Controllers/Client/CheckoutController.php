<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Shipping;
use App\Models\Province;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
    	if (Cart::count() === 0) {
    		return redirect('cart');	
    	}

    	$data['title'] = 'Checkout';
    	$data['items'] = Cart::content();
    	$data['provinces'] = Province::all();
        $data['payments'] = Payment::with('paymentSetting')
                                ->where('status', 1)
                                ->get()
                                ->toArray();

    	return view('frontend.pages.checkout', $data);
    }
}
