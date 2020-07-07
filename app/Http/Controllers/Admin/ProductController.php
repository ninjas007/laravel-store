<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::paginate(10);

        return view('backend.contents.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = \App\ProductCategory::all();

        return view('backend.contents.products.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:products',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|integer',
            'path_image' => 'string|max:255'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category,
            'path_image' => $request->path_image,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $product->save();

        return redirect('admin/products')->with('success', 'Success added product');
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
        $data['product'] = Product::find($id)->first();
        $data['categories'] = \App\ProductCategory::all();

        return view('backend.contents.products.edit', $data);
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
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|integer',
        ]);

        // check already product name other row
        if (Product::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect('admin/products')->with('error', 'Failed, Product name already exists other rows');
        }

        $product = Product::find($id);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category;
        $product->path_image = $request->path_image;
        $product->updated_at = date('Y-m-d H:i:s');

        $product->save();

        return redirect('admin/products')->with('success', 'Success updated product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $productIdArray = $request->input('id');
        $product = Product::whereIn('id', $productIdArray);
        
        $product->delete();
        
        return response()->json('Success deleted products', 200);
    }
}
