<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Http;
use App\Models\Province;

class RegionController extends Controller
{
    public function states(Request $request)
    {
    	$countries = new Countries();

    	$data['states'] = $countries->where('name.common', $request->input('state'))
    									->first()
								    	->hydrateStates()
								    	->states
								    	->sortBy('name')
								    	->pluck('name', 'postal');

		return response()->json($data);
    }

    public function cities()
    {
    	$apikey = 'fa18cbdb6403b4f9ef4fbf626a25bd98';

        $response = Http::withHeaders([
            'key' => $apikey,
        ])->get('https://api.rajaongkir.com/starter/city');

        return $response['rajaongkir']['results'];
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
