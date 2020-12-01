<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            'date_order' => date('Y-m-d'),
        	'code_order' => '000001',
        	'name' => 'Tilis Tiadi',
        	'address' => 'Jln. MT. Haryono Lr. Nipa Raya 2',
        	'phone' => '082325576616',
        	'city' => 'Bali',
        	'postal_code' => '93232',
        	'province' => 'Sulawesi Tenggara',
        	'user_id' => 2,
        	'payment_id' => 1,
        	'shipping_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
