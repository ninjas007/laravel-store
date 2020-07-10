<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Cart;

class ProductController extends Controller
{
    public function index($slug)
    {
    	$data['title'] = 'Product';
    	$data['product'] = Product::where('slug', $slug)->with('categories')->first();

    	return view('frontend.pages.product', $data);
    }
}
