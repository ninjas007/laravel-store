<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentSetting;
use Cart;

class CheckoutController extends Controller
{
    public function getPayments(Request $request)
    {
    	$data['payment_method_id'] = $request->payment_method_id;
    	$data['total'] = 
    	$data['payments'] = PaymentSetting::where('payment_id', $data['payment_method_id'])
    	                        ->get()
    	                        ->toArray();
    	
    	return view('frontend.load_ajax.payment_methods', $data);
    }

    public function order(Request $request)
    {
    	echo "string";
    }
}
