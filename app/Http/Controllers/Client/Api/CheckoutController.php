<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentSetting;
use App\Traits\OrderTrait;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderDetail;
use App\Models\OrderTotal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class CheckoutController extends Controller
{
	use OrderTrait;

    public function getPayments(Request $request)
    {
    	$data['payment_method_id'] = $request->payment_method_id;
    	$data['payments'] = PaymentSetting::where('payment_id', $data['payment_method_id'])
    	                        ->get()
    	                        ->toArray();
    	
    	return view('frontend.load_ajax.payment_methods', $data);
    }

    public function checkoutOrder(Request $request)
    {
		try {    
		    DB::beginTransaction();

            $productsOrder = $this->getProductsOrder();

            $detailsOrder = new OrderDetail;
            $detailsOrder->date_order = date('Y-m-d');
            $detailsOrder->code_order = date('mdHis') . OrderDetail::latest()->first()->id;
            $detailsOrder->name = 'name';
            $detailsOrder->address = 'address';
            $detailsOrder->phone = '34343434343';
            $detailsOrder->city = 'bali';
            $detailsOrder->postal_code = '45454545';
            $detailsOrder->province = 'sulawesi tenggara';
            $detailsOrder->user_id = 2;
            $detailsOrder->payment_id = $request->payment_method_id;
            $detailsOrder->shipping_id = 1;
            $detailsOrder->created_at = date('Y-m-d H:i:s');
            $detailsOrder->updated_at = date('Y-m-d H:i:s');

            $detailsOrder->save();

            foreach ($productsOrder as $value) {
                $order = new Order;
                $order->qty = $value['qty'];
                $order->order_detail_id = $detailsOrder->id;
                $order->product_id = $value['id'];
                $order->total = $value['subtotal'];

                $order->save();
            }
            
            $totalOrder = new OrderTotal;
            $totalOrder->order_detail_id = $detailsOrder->id;
            $totalOrder->ongkir = $this->getOngkirProductsOrder();
            $totalOrder->total_all = $this->getTotalProductsOrder();

            $totalOrder->save();

		    DB::commit();

            $this->removeItemsCart();

            $data['payments'] = PaymentSetting::where('payment_id', $request->payment_method_id)
                                    ->get()
                                    ->toArray();

            return response()->json(['status' => 200, 'code_order' => Crypt::encryptString($detailsOrder->code_order)], 200);

		} catch (\Exception $e) {
		    logger($e->getMessage());
		    DB::rollBack();
            return response()->json(['status' => 500, 'msg' => 'Error, silahkan refresh browser atau contact admin'], 500);
		}    	
    }

}
