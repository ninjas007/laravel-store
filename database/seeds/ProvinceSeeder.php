<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$apikey = '76036a5cf68b0d69c3e0899a0a8fbc18';

    	$response = Http::withHeaders([
    	    'key' => $apikey,
    	])->get('https://api.rajaongkir.com/starter/province');

    	foreach ($response['rajaongkir']['results'] as $province) {
    		$data[] = [
    			'id' => $province['province_id'],
    			'name' => $province['province']
    		];	
    	}

    	DB::table('provinces')->insert($data);
    }
}
