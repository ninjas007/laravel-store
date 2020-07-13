<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
        	'name' => 'Bank Transfer',
        	'code' => 'payment_bank',
        	'status' => 1,
        ]);

        DB::table('payments')->insert([
        	'name' => 'Midtrans',
        	'code' => 'payment_midtrans',
        	'status' => 1,
        ]);
    }
}
