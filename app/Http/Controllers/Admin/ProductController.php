<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

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
        $data['categories'] = Category::all();

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
            'path_image' => 'string|max:255'
        ]);

        try {    
            DB::beginTransaction();

            $product = Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'price' => $request->price,
                'weight' => $request->weight,
                'tax' => $request->tax,
                'description' => $request->description,
                'stock' => $request->stock,
                'path_image' => $request->path_image
            ]);

            $product->save();

            foreach ($request->category as $category) {
                DB::table('category_product')->insert([
                    'product_id' => $product->id,
                    'category_id' => $category
                ]);
            }

            DB::commit();

            return redirect('admin/products')->with('success', 'Success added product');

        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/products')->with('error', 'Error server, failed added product');
        }
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
        $data['product'] = Product::where('id', $id)->with('categories')->first();
        $data['categories'] = Category::all();

        if (is_null($data['product'])) {
            echo 'No data';
            die;    
        }

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
        ]);

        // check already product name other row
        if (Product::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect('admin/products')->with('error', 'Failed, Product name already exists other rows');
        }

        $product = Product::find($id);

        try {
            DB::beginTransaction();

            $product->name = $request->name;
            $product->slug = Str::slug($request->name, '-');
            $product->price = $request->price;
            $product->description = $request->description;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->tax = $request->tax;
            $product->path_image = $request->path_image;
            $product->updated_at = date('Y-m-d H:i:s');

            $product->save();
            $productCategory = DB::table('category_product')->where('product_id', $id)->delete();

            foreach ($request->category as $category) {
                DB::table('category_product')->insert([
                    'product_id' => $product->id,
                    'category_id' => $category
                ]);
            }

            DB::commit();
            
            return redirect('admin/products')->with('success', 'Success updated product');
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/products')->with('error', 'Error server, failed added product');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $productIdArray = $request->input('id');
        try {
            DB::beginTransaction();
            Product::whereIn('id', $productIdArray)->delete();
            DB::commit();

            return response()->json('Success deleted products', 200);
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();
            return response()->json('Failed deleted products', 400);
        }
        
    }
}
