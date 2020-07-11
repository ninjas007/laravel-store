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
                'description' => $request->description,
                'stock' => $request->stock,
                'path_image' => $request->path_image,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $product->save();

            foreach ($request->category as $category) {
                $categoryProduct = \App\Models\CategoryProduct::create([
                    'product_id' => $product->id,
                    'category_id' => $category,
                ]);   
            }

            DB::commit();

            return redirect('admin/products')->with('success', 'Success added product');

        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();

            return redirect('admin/products')->with('error', $e->getMessage());
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
        $product->description = $request->description;
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
