<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProductCategory;
use App\Banner;
use App\Product;

class PagesController extends Controller
{
    public function home()
    {
    	$data['title'] = 'Home';
    	$data['categories'] = ProductCategory::all();
    	$data['banners'] = Banner::all();
    	$data['products'] = Product::with('categories')->paginate(8);

    	return view('frontend.pages.home', $data);
    }
}
