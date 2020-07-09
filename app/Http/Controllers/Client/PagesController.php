<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Banner;
use App\Models\Product;

class PagesController extends Controller
{
    public function home()
    {
    	$data['title'] = 'Home';
    	$data['categories'] = Category::all();
    	$data['banners'] = Banner::all();
        $data['products'] = Product::with('categories')->paginate(4);

    	return view('frontend.pages.home', $data);
    }

    public function product($slug)
    {
    	$data['title'] = 'Product';
    	$data['product'] = Product::where('slug', $slug)->with('categories')->first();

    	return view('frontend.pages.product', $data);
    }

    public function category($slug)
    {
        $data['title'] = 'Category';
        $data['categories'] = Category::all();
        $data['banners'] = Banner::all();        
        $data['category'] = Category::where('slug', $slug)->first();
        $data['products'] = Category::find($data['category']->id)->products()->paginate(4);

        return view('frontend.pages.category', $data);
    }
}
