<?php
namespace App\Http\Controllers\Front\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PharmacyModel;
use App\Models\UserModel;
use App\Models\PharmacyPreferencesModel;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;



class PreferenceController extends Controller
{
    public function __construct(  PharmacyModel        $pharmacy_model,
                                  UserModel            $user_model,
                                  PharmacyPreferencesModel $prefernces_model)
    {
        $this->arr_view_data            = [];
        $this->module_title             = "Preference";
        $this->module_url_path          = url('/').'/pharmacy';
        $this->module_view_folder       = "front.pharmacy";
        $this->site_url                 = url('/');

        $this->UserModel                  = $user_model;
        $this->PharmacyModel              = $pharmacy_model;
        $this->PharmacyPreferencesModel   = $prefernces_model;

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
          $arr_prefernce = $arr_days = $arr_data = [];
          $arr_days      = $this->arr_days;

           $obj_preference   = $this->PharmacyPreferencesModel->where('user_id','=',$this->user_id)
                                                           ->whereHas('pharmacy_details',function(){

                                                           })
                                                           ->with(['pharmacy_details'=>function($q){

                                                            $q->select('id','user_id','noti_message','noti_new_patient','noti_new_booking','noti_ans_a_question','noti_accept_aust_patients');

                                                           }])
                                                           ->get();
          if($obj_preference)
          {
            $arr_preference = $obj_preference->toArray();
          }
          if(isset($arr_preference) && sizeof($arr_preference)>0)
          {
                  foreach ($arr_preference as $key=>$prefernces) 
                  {

                      $day                = $prefernces['day'];

                      $arr_data[$day.'_'.'from_time'] = $prefernces['from_time'];
                      $arr_data[$day.'_'.'to_time']   = $prefernces['to_time'];
                      $arr_data[$day.'_'.'status']    = $prefernces['status'];

                      $arr_data['noti_message']               = $prefernces['pharmacy_details']['noti_message'];
                      $arr_data['noti_new_patient']           = $prefernces['pharmacy_details']['noti_new_patient'];
                      $arr_data['noti_new_booking']           = $prefernces['pharmacy_details']['noti_new_booking'];
                      $arr_data['noti_ans_a_question']        = $prefernces['pharmacy_details']['noti_ans_a_question'];
                      $arr_data['noti_accept_aust_patients']  = $prefernces['pharmacy_details']['noti_accept_aust_patients'];

                  }

          }

          $this->arr_view_data['arr_data']         = $arr_data;
          $this->arr_view_data['arr_days']         = $arr_days;
          $this->arr_view_data['page_title']       = 'Preference';
          $this->arr_view_data['module_url_path']  =  $this->module_url_path;
          return view($this->module_view_folder.'.preference',$this->arr_view_data);
    }
    public function store(Request $request)
    {
        $arr_days                    = $arr_time_data = $arr_update = $arr_pref_notification =[];
        $obj_update                  = $obj_create    = $obj_pharmacy = '';

        $arr_days                    = $this->arr_days;
        $arr_time_data['user_id']    = $this->user_id;

        $form_data                   = [];
        $form_data                   = $request->all();
        

        if(sizeof($arr_days)>0)
        {
               foreach ($arr_days as $day_key => $day) 
               {

                     $arr_time_data['from_time'] = null;
                     $arr_time_data['to_time']   = null;
                     $status     = 0;
                     $small_case_day_slug        = strtolower($day_key); 
                     $status                     = $request->input($small_case_day_slug.'_status');

                     
                     $arr_time_data['day']       = $small_case_day_slug;
                     $arr_time_data['from_time'] = convert_12_to_24($request->input($small_case_day_slug.'_from_time'));           
                     $arr_time_data['to_time']   = convert_12_to_24($request->input($small_case_day_slug.'_to_time'));

                    if($status!="")
                    {
                      $arr_time_data['status']   = $status;
                    }
                    else
                    {
                       $arr_time_data['status']   = 0; 
                    }

                    $is_exist_count = $this->PharmacyPreferencesModel->where('user_id','=',$this->user_id)
                                                                     ->where('day','=',$small_case_day_slug)
                                                                     ->count();
                    if($is_exist_count>0)
                    {
                          $arr_update['from_time']  = $arr_time_data['from_time'];
                          $arr_update['to_time']    = $arr_time_data['to_time'];
                          $arr_update['status']     = $arr_time_data['status'];

                           $obj_update = $this->PharmacyPreferencesModel
                                              ->where('user_id','=',$this->user_id)
                                              ->where('day',$small_case_day_slug)->update($arr_update);
                    }   
                    else
                    {
                          $obj_create = $this->PharmacyPreferencesModel->create($arr_time_data);

                    }
                  
               }


              $arr_pref_notification['noti_message']              =  isset($form_data['noti_message'])?$form_data['noti_message']:'';
              $arr_pref_notification['noti_new_patient']          =  isset($form_data['noti_new_patient'])?$form_data['noti_new_patient']:'';
              $arr_pref_notification['noti_new_booking']          =  isset($form_data['noti_new_booking'])?$form_data['noti_new_booking']:'';
              $arr_pref_notification['noti_ans_a_question']       =  isset($form_data['noti_ans_a_question'])?$form_data['noti_ans_a_question']:'';
              $arr_pref_notification['noti_accept_aust_patients'] =  isset($form_data['noti_accept_aust_patients'])?$form_data['noti_accept_aust_patients']:'';

              $obj_pharmacy      = $this->PharmacyModel->where('user_id',$this->user_id)->first();
              if($obj_pharmacy)
              {
                   $obj_pharmacy = $obj_pharmacy->update($arr_pref_notification);
              }
              else
              {
                   $arr_pref_notification['user_id']             =  $this->user_id;
                   $obj_pharmacy = $this->PharmacyModel->create($arr_pref_notification);
              }
            

        }

        if($obj_create || $obj_update)
        {
            Flash::success('Preferences saved successfully.');

        }
        else
        {
            Flash::error('Error while creating prefernces.');
        }
        return redirect()->back();
    }
}