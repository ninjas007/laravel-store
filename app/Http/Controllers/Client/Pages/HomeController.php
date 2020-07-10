<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Banner;
use App\Models\Product;
use Cart;

class HomeController extends Controller
{
    public function index()
    {
    	$data['title'] = 'Home';
    	$data['categories'] = Category::all();
    	$data['banners'] = Banner::all();
        $data['products'] = Product::with('categories')->paginate(4);

    	return view('frontend.pages.home', $data);
    }
}
