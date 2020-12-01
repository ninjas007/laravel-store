<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingSetting;
use App\Helpers\RajaOngkir;
use App\Traits\OrderTrait;
use Cart;

class CourierController extends Controller
{
    use OrderTrait;

    public function cost(Request $request)
    {
        $destinationCityId = $request->city_destination_id;
        $courier = $request->courier;
        $weight = $this->getWeightProductsOrder();

        $rajaongkir = new RajaOngkir;
        $response = $rajaongkir->cost($destinationCityId, $courier, $weight);

        if ($response['rajaongkir']['status']['code'] == 200) {
            $data['costs'] = $response['rajaongkir'];
            return view('frontend.load_ajax.courier_cost', $data);
        } else {
            return view('frontend.load_ajax.404');
        }
    }
}
