<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Validator;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data['carts'] = Cart::content();
    	$data['subtotal'] = Cart::subtotal();
    	$data['count'] = Cart::count();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $data['message'] = 'Failed added item to cart';
            $data['count'] = Cart::count();
            return response()->json($data, 400);
        }

        $product = Product::findOrFail($request->product_id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'weight' => 100,
            'price' => $product->price,
            'options' => [
                'image' => $product->path_image
            ]
        ]);

        $data['message'] = 'Success added item to cart';
        $data['count'] = Cart::count();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Cart::update($request->rowid, $request->qty);

        $data['message'] = 'Success updated item cart';
        $data['count'] = Cart::count();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Cart::remove($request->rowid);

        $data['message'] = 'Success removed item cart';
        $data['count'] = Cart::count();

        return response()->json($data);
    }
}
