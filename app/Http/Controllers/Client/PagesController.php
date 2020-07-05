<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
    	$data['title'] = 'Home';

    	return view('client.pages.home', $data);
    }
}
