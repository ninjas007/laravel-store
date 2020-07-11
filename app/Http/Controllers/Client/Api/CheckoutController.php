<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PragmaRX\Countries\Package\Countries;

class CheckoutController extends Controller
{
    public function state(Request $request)
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
}
