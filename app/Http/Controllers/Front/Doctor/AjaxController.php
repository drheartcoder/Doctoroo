<?php

namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;


class AjaxController extends Controller
{
    public function __construct(UserModel $UserModel)
    {	
    	$this->arr_view_data[]  = [];
    	$this->UserModel	    =	$UserModel;
        $this->SpecialityModel  =   $SpecialityModel;
        $this->LanguageModel    =   $LanguageModel;
    	$this->module_view_folder = 'front.doctor';
    }	

    public function duplicate()
    {
        
    }

}
