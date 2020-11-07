<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\ShippingSetting;
use App\Models\Province;
use App\Models\City;
use App\Helpers\RajaOngkir;
use App\Traits\WeightProductsOrderTrait;
use Cart;

class ShippingController extends Controller
{
	use WeightProductsOrderTrait;

    public function shippingMethods(Request $request)
    {
        $data['provinces'] = Province::all();
        $data['shippings'] = Shipping::with('shippingSetting')
                                ->where('status', 1)
                                ->get()
                                ->toArray();

        return view('frontend.load_ajax.shipping_methods', $data);
    }

    public function setShippingMethod(Request $request)
    {
     	if ($this->validateShippingMethod($request)) {
     		$cityDestination = City::where('id', (int) $request->city_destination_id)->first();
            
     		if(is_null($cityDestination)) {
     			return false;
     		}

     		$weight = $this->getWeightProductsOrder();
     		$rajaongkir = new RajaOngkir;
     		$response = $rajaongkir->cost($request->city_destination_id, $request->courier, $weight);
     		$cost = $this->checkService($request->service, $response);

     		if ($cost) {
                
                $items = Cart::content();
                $total = 0;
                foreach ($items as $item) {
                    $total += $item->price * $item->qty;
                }

     			$data = [
     				'city_destination' =>  $cityDestination->city_name,
     				'courier' => strtoupper($request->courier),
     				'service' => $request->service,
     				'cost' => format_uang($cost),
                    'total_akhir' => format_uang($total + $cost),
                    'alamat_pengiriman' => $request->alamat,
                    'weight' => 200
     			];

                return response()->json($data);

                return view('frontend.load_ajax.total_akhir', $data);
     		}

    	}
    }

    private function validateShippingMethod($request)
    {
    	if (is_null(Shipping::where('id', $request->shipping_method_id)->first())) {
    		return false;
    	}

    	if (is_null(ShippingSetting::where(['shipping_id' => 1, 'value' => $request->courier])->first())) {
    		return false;
    	}

    	if (is_null($request->service)) {
    		return false;
    	}

    	return true;
    }

    private function checkService($service, $response)
    {
    	foreach ($response['rajaongkir']['results'][0]['costs'] as $cost) {
    		if ($service == $cost['service']) {
    			return $cost['cost'][0]['value'];
    		}
    	}
    	return false;
    }
}
