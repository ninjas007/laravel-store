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
        	'name' => 'Raja Ongkir',
        	'code' => 'shipping_rajaongkir',
        	'origin_city_id' => 501,
            'note' => '',
            'setting' => json_encode(['api_key' => '6e3521b3547076f10ab4605adce6c72c', 'account' => 'starter']),
        	'status' => 1
        ]);

        DB::table('shippings')->insert([
        	'name' => 'Free Ongkir',
        	'code' => 'shipping_free',
            'origin_city_id' => 501,
            'note' => 'Kurir pengiriman kami yang menentukan',
            'setting' => json_encode(['cost' => 0]),
        	'status' => 1
        ]);

        DB::table('shippings')->insert([
        	'name' => 'COD',
        	'code' => 'shipping_cod',
            'origin_city_id' => 501,
            'note' => 'Hanya berlaku daerah Yogya',
            'setting' => json_encode(['cost' => 9000, 'destination_city_id' => 501]),
        	'status' => 1
        ]);
    }
}
