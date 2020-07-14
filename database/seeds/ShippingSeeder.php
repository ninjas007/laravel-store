<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
        	'key' => 'Raja Ongkir',
            'name' => 'Kurir',
        	'code' => 'shipping_rajaongkir',
            'note' => '',
            'setting' => json_encode([
                'api_key' => '6e3521b3547076f10ab4605adce6c72c', 'account' => 'starter', 'origin_city_id' => 501 // 501 jogja
            ]),
        	'status' => 1
        ]);

        DB::table('shippings')->insert([
        	'key' => 'Flat',
            'name' => 'Flat',
        	'code' => 'shipping_free',
            'note' => 'Kurir pengiriman kami yang menentukan',
            'setting' => json_encode(['cost' => 0]),
        	'status' => 1
        ]);

        DB::table('shippings')->insert([
        	'key' => 'COD',
            'name' => 'Cash Of Delivery',
        	'code' => 'shipping_cod',
            'note' => 'Hanya berlaku daerah Yogya',
            'setting' => json_encode(['cost' => 9000, 'destination_city_id' => 0]), 
        	'status' => 1
        ]);
    }
}
