<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Province;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Cart;
use PDF;

class CheckoutController extends Controller
{
    public function index()
    {
    	if (Cart::count() === 0) {
    		return redirect('cart');	
    	}

        if (Auth::user()) {
            return redirect('login');
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

    public function success($code_order)
    {
        $data['title'] = 'Checkout Berhasil';
        $data['code_order'] = $code_order;

        return view('frontend.pages.alerts.checkout-success', $data);
    }

    public function invoice($code_order)
    {
        $data['code_order'] = Crypt::decryptString($code_order);
        $orderDetail = OrderDetail::with(['orders', 'payment', 'shipping', 'user', 'orderTotal'])
                                            ->where('code_order', $data['code_order'])
                                            ->first()
                                            ->toArray();

        $orderId = [];
        foreach ($orderDetail['orders'] as $key => $value) {
            $orderId[$key] = $value['id'];
        }

        $orderDetail['orders'] = DB::table('products')
                                            ->select('name', 'price', 'weight', 'qty', 'total')
                                            ->join('orders', 'orders.product_id', '=', 'products.id')
                                            ->whereIn('orders.id', $orderId)->get();

        $weight = 0;
        foreach ($orderDetail['orders'] as $item) {
            $weight += $item->weight * $item->qty;
        }

        $orderDetail['total_weight'] = $weight / 1000 . 'kg';
        $orderDetail['total_last'] = $orderDetail['order_total']['total_all'] - $orderDetail['order_total']['ongkir'];
        
        $data['orderDetail'] = $orderDetail;


        $pdf = \App::make('dompdf.wrapper');
        $html = view('frontend.invoice', $data);
        $pdf->loadHTML($html);
        
        return $pdf->stream();
    }
}
