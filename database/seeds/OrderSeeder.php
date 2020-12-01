<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'qty' => 3,
        	'order_detail_id' => 1,
            'product_id' => 1,
            'total' => 417000,
        ]);

        DB::table('orders')->insert([
            'qty' => 1,
        	'order_detail_id' => 1,
            'product_id' => 2,
            'total' => 99000,
        ]);
    }
}
