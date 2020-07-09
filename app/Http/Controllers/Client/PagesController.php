<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductCategory;
use App\Models\ProductToCategory;
use App\Models\Banner;
use App\Models\Product;

class PagesController extends Controller
{
    public function home()
    {
    	$data['title'] = 'Home';
    	$data['categories'] = ProductCategory::all();
    	$data['banners'] = Banner::all();
    	// $data['products'] = Product::with('categories')->paginate(8);
        // $data['product'] = ProductToCategory::with('products')->with('categories')->get()->toArray();
        // $data['product'] = ProductToCategory::groupBy('product_id')->with('categories')->get()->toArray();
        $product = Product::find(1);
        $categories = $product->categories;

        foreach ($categories as $category) {
            echo $category;
        // dd($data['product']);
        }
        die();


    	return view('frontend.pages.home', $data);
    }

    public function product($slug)
    {
    	$data['title'] = 'Product';
    	$data['product'] = ProductToCategory::where('slug', $slug)->with('products')->first();

        dd($data['product']);

    	if (is_null($data['product'])) {
    		return view('frontend.pages.not_found', $data);
    	}

    	return view('frontend.pages.product', $data);
    }
}
