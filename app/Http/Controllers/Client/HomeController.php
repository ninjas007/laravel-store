<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Banner;
use App\Models\Product;
use Cart;
use PDF;

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

   	public function pdf1()
   	{
   		$data = [
   			'sssss', 'asdfasdf', 'asfdasdf'
   		];
   		print_r(PHP_INT_SIZE);
   		die;
   		return view('testpdf', $data);
   	}

    public function pdf()
    {
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML('<h1>Test</h1>');
    	return $pdf->stream();
    }
}
