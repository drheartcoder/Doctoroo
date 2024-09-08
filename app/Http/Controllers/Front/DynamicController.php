<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\StaticPagesModel;

use Validator;
use Flash;
use Sentinel;
use Activation;

class DynamicController extends Controller
{

    public function __construct(StaticpagesModel $StaticpagesModel)
    {	
    	$this->arr_view_data[]  =   [];
    	$this->StaticpagesModel	    =	$StaticpagesModel;
    	$this->module_view_folder = 'front.home';
    }	

    public function index()
    {
    	$arr_dynamic = array();
        $dyanmic_arr = $this->StaticPagesModel->get();
        if($dyanmic_arr)
        {
            $arr_dynamic = $dyanmic_arr->toArray();
        }
        
        //dd($arr_dynamic);
        $this->arr_view_data['arr_dynamic'] = $arr_dynamic;
       
        return view($this->module_view_folder.'.dynamic',$this->arr_view_data);
    }

   
}
