<?php
namespace App\Http\Controllers\Front\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PharmacyModel;
use App\Models\UserModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;



class PreferncesController extends Controller
{
    public function __construct( PharmacyModel       $temp_pharmacy,
                                  UserModel          $user_model)
    {
        $this->arr_view_data            = [];
        $this->module_title             = "Prefernces";
        $this->module_url_path          = url('/').'/pharmacy';
        $this->module_view_folder       = "front.pharmacy.profile";
        $this->site_url                 = url('/');

        $this->UserModel                = $user_model;
        $this->PharmacyModel            = $temp_pharmacy;

        $this->arr_days        = [];
        $this->arr_days['MON'] = "Monday";
        $this->arr_days['TUE'] = "Tuesday";
        $this->arr_days['WED'] = "Wednesday";
        $this->arr_days['THU'] = "Thursday";
        $this->arr_days['FRI'] = "Friday";
        $this->arr_days['SAT'] = "Saturday";
        $this->arr_days['SUN'] = "Sunday";

        $user = Sentinel::check();
        if($user!=false)
        {
           $this->user_id  = $user->id;
        }
      
    

    }
    /*
      Rohini Jagtap
      date:22 march 2017
      load page for prefernces 
    */
    public function index()
    {
          $arr_prefernce = $arr_days = [];
          $arr_days      = $this->arr_days;
          $this->arr_view_data['arr_days']         = $arr_days;
          $this->arr_view_data['arr_prefernce']    = 'arr_prefernce';
          $this->arr_view_data['page_title']       = 'Prefernces';
          $this->arr_view_data['module_url_path']  =  $this->module_url_path;
          return view($this->module_view_folder.'.prefernces',$this->arr_view_data);
    }
    public function store(Request $request)
    {
        $arr_days      = $arr_time_data = [];
        $arr_days      = $this->arr_days;
        if(sizeof($arr_days)>0)
        {
               foreach ($arr_days as $day_key => $day) 
               {

                     $arr_time_data['from_time'] = null;
                     $arr_time_data['to_time']   = null;
                     $arr_time_data['status']    = '0';

                     $status = $request->input($small_case_day_slug.'_status');

                     $small_case_day_slug        = strtolower($day_key); 
                     $arr_time_data['day']       = $small_case_day_slug;
                     $arr_time_data['from_time'] = date("H:i ",strtotime($request->input($small_case_day_slug.'_from_time')));               
                     $arr_time_data['to_time']   = date("H:i ",strtotime($request->input($small_case_day_slug.'_to_time')));

                      $arr_time_data['status']   = $status;


               }

        }
    }
}