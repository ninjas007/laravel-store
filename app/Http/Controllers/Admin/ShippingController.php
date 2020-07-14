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
        // return $data['shipping'];


        // rajaongkir route
        if ((int)$id === 1) {
            $data['cities'] = \App\Models\City::all();
            return view('backend.contents.settings.shipping.rajaongkir', $data);
        } 
        // flat route 
        else if((int)$id === 2) {
            return view('backend.contents.settings.shipping.flat', $data);
        }
        // cod route
        else if((int)$id === 3) {
            $data['cities'] = \App\Models\City::all();
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
        // update flat ongkir
        else if ((int)$id === 2) {
            return $this->updateFlat($request, $id);
        } 
        // update cod
        else if ((int)$id === 3) {
            return $this->updateCod($request, $id);
        }
        else {
            return view('backend.404');
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
                    'setting' => json_encode([
                        'api_key' => $request->api_key,
                        'account' => $request->account,
                        'origin_city_id' => $request->city_id,
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

            return redirect('admin/shippings')->with('success', 'Berhasil mengupdate pengiriman');
            
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/shippings')->with('error', 'Error server, '.$e->getMessage().' Gagal mengupdate pengiriman');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function updateFlat($request, $id)
    {
        $request->validate([
            'name' => 'required|max:20',
            'status' => 'required',
            'cost' => 'min:0'
        ]);

        try {
            DB::beginTransaction();

            DB::table('shippings')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'note' => $request->note,
                    'status' => $request->status,
                    'setting' => json_encode(['cost' => $request->cost])
            ]);

            DB::commit();

            return redirect('admin/shippings')->with('success', 'Berhasil mengupdate pengiriman');
            
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/shippings')->with('error', 'Error server, '.$e->getMessage().' Gagal mengupdate pengiriman');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function updateCod($request, $id)
    {
        $request->validate([
            'name' => 'required|max:20',
            'status' => 'required',
            'cost' => 'min:0',
            'city_id' => 'required'
        ]);

        try {
            DB::beginTransaction();

            DB::table('shippings')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'note' => $request->note,
                    'status' => $request->status,
                    'setting' => json_encode([
                        'cost' => $request->cost, 'destination_city_id' => $request->city_id
                    ])
            ]);

            DB::commit();

            return redirect('admin/shippings')->with('success', 'Berhasil mengupdate pengiriman');
            
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/shippings')->with('error', 'Error server, '.$e->getMessage().' Gagal mengupdate pengiriman');
        }
    }
}
