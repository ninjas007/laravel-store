<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PaymentSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_settings')->insert([
        	[
        		'name' => 'BCA',
        		'value' => 'Bank BCA a/n Member Akhirat No Rek 12345678987',
                'image' => 'bca.jpg',
        		'payment_id' => 1
        	],
        	[
        		'name' => 'BNI',
        		'value' => 'Bank BNI a/n Member Akhirat No Rek 933434343434',
                'image' => 'bni.png',
        		'payment_id' => 1
        	],
        	[
        		'name' => 'BRI',
        		'value' => 'Bank BRI a/n Member Akhirat No Rek 555555555555',
                'image' => 'bri.png',
        		'payment_id' => 1
        	],
        	[
        		'name' => 'Midtrans',
        		'value' => json_encode([
                    'client_key' => 'SB-Mid-client-e8LPI7KOkxIR3J-Z',
                    'server_key' => 'SB-Mid-server-yoTf7WQntCF3Glo8u-yxkz6a', 
                ]),
                'image' => 'Midtrans.png',
        		'payment_id' => 2
        	],
            [
                'name' => 'Bitcoin',
                'value' => json_encode([
                    'btc_address' => 'SB-Mid-client-e8LPI7KOkxIR3J-Z',
                ]),
                'image' => 'bitcoin.png',
                'payment_id' => 3
            ],
        ]);
    }
}
