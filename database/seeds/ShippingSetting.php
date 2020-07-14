<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_settings')->insert([
            [
                'name' => 'JNE',
                'value' => 'jne',
                'shipping_id' => 1
            ],
            [
                'name' => 'POS',
                'value' => 'pos',
                'shipping_id' => 1
            ],
            [
                'name' => 'TIKI',
                'value' => 'tiki',
                'shipping_id' => 1
            ]
        ]);
    }
}
