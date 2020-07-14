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
    	$apikey = 'fa18cbdb6403b4f9ef4fbf626a25bd98';

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
