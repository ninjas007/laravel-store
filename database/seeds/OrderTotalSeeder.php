<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_totals')->insert([
        	'order_detail_id' => 1,
            'ongkir' => 30000,
        	'total_all' => 516000
        ]);
    }
}
