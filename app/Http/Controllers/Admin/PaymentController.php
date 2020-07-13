<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['payments'] = Payment::all();

        return view('backend.contents.payments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['payment'] = Payment::find($id)
                                ->with('paymentSetting')
                                ->where('id', $id)
                                ->first()
                                ->toArray();
        // return $data['payment']['payment_setting'];
        // if ($id === 2) {
        //     $data['payment_setting'] = json_decode($paymentSEt);
        // } elseif (expr) {
        //     $data['payment_setting'] = json_decode($paymentSetting[0]->data_setting);
        // }

        // return $data['payment_setting'];

        // if ($id === 2) {


        //     \Midtrans\Config::$serverKey = $key->server_key;
        //     \Midtrans\Config::$isProduction = false;
        //     \Midtrans\Config::$isSanitized = true;
        //     \Midtrans\Config::$is3ds = true;

        //     $params = array(
        //         'transaction_details' => array(
        //             'order_id' => rand(),
        //             'gross_amount' => ,
        //         )
        //     );

        //     // $snapToken = \Midtrans\Snap::getSnapToken($params);
        //     try {
        //       // Get Snap Payment Page URL
        //       $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
              
        //       return $paymentUrl;
        //     }
        //     catch (Exception $e) {
        //       echo $e->getMessage();
        //     }    
        // }

        return view('backend.contents.payments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ((int)$id === 1) {
            // $request->validate([
            //     'value[]' => 'required'
            // ]);

            try {
                DB::beginTransaction();

                DB::table('payments')
                   ->where('id', $id)
                   ->update(['status' => $request->status]);

                DB::table('payment_settings')
                    ->where('payment_id', $id)
                    ->delete();

                foreach ($request->value as $key => $value) {
                    $data[] = [
                        'name' => $request->name[$key],
                        'value' => $value,
                        'payment_id' => $id

                    ];
                }

                DB::table('payment_settings')
                    ->insert($data);

                DB::commit();

                return redirect('admin/payments')->with('success', 'Berhasil mengupdate payment');
            } catch (\Exception $e) {
                logger($e->getMessage());
                DB::rollBack();

                return redirect('admin/payments')->with('error', 'Error server, Gagal mengupdate payment');
            }
        } else if ((int)$id === 2) {

            $request->validate([
                'client_key' => 'required',
                'server_key' => 'required',
                'status' => 'required'
            ]);
            
            try {
                DB::beginTransaction();

                DB::table('payments')
                    ->where('id', $id)
                    ->update(['status' => $request->status]);

                DB::table('payment_settings')
                    ->where('id', $request->payment_setting_id)
                    ->update(['value' => json_encode([
                                'client_key' => $request->client_key,
                                'server_key' => $request->server_key
                            ])
                    ]);

                DB::commit();

                return redirect('admin/payments')->with('success', 'Berhasil mengupdate payment');
            } catch (\Exception $e) {
                logger($e->getMessage());
                DB::rollBack();

                return redirect('admin/payments')->with('error', 'Error server, Gagal mengupdate payment');
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
