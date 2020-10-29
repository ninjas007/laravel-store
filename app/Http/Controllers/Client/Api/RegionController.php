<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\City;

class RegionController extends Controller
{
    public function cities(Request $request)
    {
    	$data['cities'] = City::where('province_id', $request->input('province_id'))->get()->toArray();

        return response()->json($data);
    }

    public function provinces()
    {
        $apikey = 'fa18cbdb6403b4f9ef4fbf626a25bd98';

        $response = Http::withHeaders([
            'key' => $apikey,
        ])->get('https://api.rajaongkir.com/starter/province');

        return $response->body();
    }
}
