<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $apikey = '76036a5cf68b0d69c3e0899a0a8fbc18'; // starter
        $apikey = '6e3521b3547076f10ab4605adce6c72c';

        $response = Http::withHeaders([
            'key' => $apikey,
        ])->get('https://pro.rajaongkir.com/api/city');

        foreach ($response['rajaongkir']['results'] as $city) {
        	$data[] = [
        		'id' => $city['city_id'],
        		'city_name' => $city['city_name'],
        		'type' => $city['type'],
        		'postal_code' => $city['postal_code'],
        		'province' => $city['province'],
        		'province_id' => $city['province_id']
        	];
        }

        DB::table('cities')->insert($data);
    }
}
