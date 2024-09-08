<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
	{
		$this->arr_view_data = [];
	}
    public function index()
    {
    	$this->arr_view_data['page_title'] = 'Home';
    	return view('front.home',$this->arr_view_data);
    }
}
