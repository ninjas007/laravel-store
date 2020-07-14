<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shipping;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['shippings'] = Shipping::all();

        return view('backend.contents.shippings.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);

        $data['shipping'] = $shipping->with('shippingSetting')
                                    ->where('id', $id)
                                    ->first()
                                    ->toArray();

        $data['cities'] = \App\Models\City::all();

        // rajaongkir route
        if ((int)$id === 1) {
            return view('backend.contents.settings.shipping.rajaongkir', $data);
        } 
        // free route 
        else if((int)$id === 2) {
            return view('backend.contents.settings.shipping.free', $data);
        }
        // cod route
        else if((int)$id === 2) {
            return view('backend.contents.settings.shipping.cod', $data);
        }
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
        // update rajaongkir
        if ((int)$id === 1) {
            return $this->updateRajaOngkir($request, $id);
        } 
        // update free ongkir
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
    private function updateRajaOngkir($request, $id)
    {
        $request->validate([
            'api_key' => 'required',
            'name' => 'required|max:20',
            'account' => 'required',
            'city_id' => 'required',
            'status' => 'required',
            'courier' => 'required'
        ]);

        try {
            DB::beginTransaction();

            DB::table('shippings')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'note' => $request->note,
                    'status' => $request->status,
                    'origin_city_id' => $request->city_id,
                    'setting' => json_encode([
                        'api_key' => $request->api_key,
                        'account' => $request->account
                ])
            ]);

            DB::table('shipping_settings')
                ->where('shipping_id', $id)
                ->delete();

            foreach ($request->courier as $courier) {
                $couriers[] = [
                    'name' => strtoupper($courier),
                    'value' => strtolower($courier),
                    'shipping_id' => $id
                ];
            }

            DB::table('shipping_settings')
                ->insert($couriers);

            DB::commit();

            return redirect('admin/shippings')->with('success', 'Berhasil mengupdate shipping');
            
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/shippings')->with('error', 'Error server, '.$e->getMessage().' Gagal mengupdate shipping');
        }
    }
}
