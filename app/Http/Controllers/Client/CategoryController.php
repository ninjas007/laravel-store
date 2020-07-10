<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use Cart;

class CategoryController extends Controller
{
    public function index($slug)
    {
    	$data['title'] = 'Category';
        $data['categories'] = Category::all();
        $data['banners'] = Banner::all();        
        $data['category'] = Category::where('slug', $slug)->first();
        $data['products'] = Category::find($data['category']->id)->products()->paginate(4);

        return view('frontend.pages.category', $data);
    }
}
