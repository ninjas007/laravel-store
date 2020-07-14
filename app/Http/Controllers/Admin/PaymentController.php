<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\DB;

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);

        $data['payment'] = $payment->with('paymentSetting')
                                    ->where('id', $id)
                                    ->first()
                                    ->toArray();

        // route to bank transfer 
        if ((int)$id === 1) {
            return view('backend.contents.settings.payment.bank_transfer', $data);
        }
        // route to midtrans 
        else if ((int)$id === 2) {
            return view('backend.contents.settings.payment.midtrans', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // update bank transfer
        if ((int)$id === 1) {
            return $this->updateBankTransfer($request, $id);
        } 
        // update midtrans
        else if ((int)$id === 2) {
            return $this->updateMidtrans($request, $id);
        }
        else {
            return redirect('backend.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBankTransfer($request, $id)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required'
        ]);

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

            return redirect('admin/payments')->with('success', 'Berhasil mengupdate pembayaran');
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/payments')->with('error', 'Error server, Gagal mengupdate pembayaran');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMidtrans($request, $id)
    {
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
                ->where('payment_id', $id)
                ->update(['value' => json_encode([
                            'client_key' => $request->client_key,
                            'server_key' => $request->server_key
                        ])
                ]);

            DB::commit();

            return redirect('admin/payments')->with('success', 'Berhasil mengupdate pembayaran');
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/payments')->with('error', 'Error server, Gagal mengupdate pembayaran');
        }
    }
}
