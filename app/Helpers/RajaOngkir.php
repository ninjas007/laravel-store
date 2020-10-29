<?php 

namespace App\Helpers;

use App\Models\Shipping;
use Illuminate\Support\Facades\Http;

class RajaOngkir {

	private $rajaongkir;
	private $apiKey;
	private $account;
	private $originCityId;
	private $endpoint;

	public function __construct()
	{
		$this->rajaongkir = Shipping::findOrFail(1)->first();
		$this->setApiKey();
		$this->setAccount();
		$this->setOriginCityId();
		$this->setEndpoint();
	}

	private function setApiKey()
	{
		$this->apiKey = json_decode($this->rajaongkir->setting)->api_key;
	}

	private function setAccount()
	{
		$this->account = json_decode($this->rajaongkir->setting)->account;
	}

	private function setOriginCityId()
	{
		$this->originCityId = json_decode($this->rajaongkir->setting)->origin_city_id;
	}

	private function setEndpoint()
	{
		if ($this->account === 'starter') {
			$this->endpoint = 'https://api.rajaongkir.com/starter';
		} else if ($account === 'basic') {
		    $this->endpoint = 'https://api.rajaongkir.com/basic';
		} else if ($account === 'pro') {
		    $this->endpoint = 'https://pro.rajaongkir.com/api';
		}
	}

	public function cost(int $city_destination_id, $courier = 'jne', int $weight = 1000)
	{
		$query = [
		    'origin' => $this->originCityId,
		    'destination' => $city_destination_id,
		    'weight' => $weight,
		    'courier' => $courier
		];
		
		$endpoint = $this->endpoint.'/cost';
		
		if ($this->account === 'pro') {
		    $query['originType'] = 'city';
		    $query['destinationType'] = 'subdistrict';
		}

		$response = Http::withHeaders(['key' => $this->apiKey])->post($endpoint, $query);

		return $response;
	}

}