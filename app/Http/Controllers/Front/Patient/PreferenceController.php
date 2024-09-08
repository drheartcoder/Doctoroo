<?php
namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PatientModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;



class PreferenceController extends Controller
{
    public function __construct(PatientModel   $patient_model)
    {
        $this->arr_view_data            = [];
        $this->module_title             = "Prefernces";
        $this->module_url_path          = url('/').'/patient';
        $this->module_view_folder       = "front.patient";
        $this->site_url                 = url('/');

        $this->PatientModel             = $patient_model;



        $user = Sentinel::check();

        if($user!=false)
        {
           $this->user_id  = $user->id;
        }
      
    

    }
    /*
      Rohini Jagtap
      date:23 march 2017
      load page for prefernces 
    */
    public function index()
    {
          $arr_prefernce  = [];
          $obj_patient    = $this->PatientModel->where('user_id',$this->user_id)
                                              ->select('id','user_id','sms_notification','stop_notification','stop_marketing_notification')
                                              ->first();

          if($obj_patient)
          {
            $arr_prefernce = $obj_patient->toArray();
          }

          $this->arr_view_data['arr_prefernce']         = $arr_prefernce;
          $this->arr_view_data['page_title']       = 'Prefernces';
          $this->arr_view_data['module_url_path']  =  $this->module_url_path;
          return view($this->module_view_folder.'.preference',$this->arr_view_data);
    }

    /*
      Rohini Jagtap
      date:23 march 2017
      store prefernces 
    */

    public function store(Request $request)
    {
        $arr_update = $arr_pref_notification = $form_data = [];
        $obj_update = $obj_create    = $obj_pharmacy = '';

        $arr_time_data['user_id']    = $this->user_id;

        $form_data                   = $request->all();
          

          $arr_pref_notification['sms_notification']             =  isset($form_data['sms_notification'])?$form_data['sms_notification']:'';
          $arr_pref_notification['stop_notification']            =  isset($form_data['stop_notification'])?$form_data['stop_notification']:'';
          $arr_pref_notification['stop_marketing_notification']  =  isset($form_data['stop_marketing_notification'])?$form_data['stop_marketing_notification']:'';
            

          $obj_patient      = $this->PatientModel->where('user_id',$this->user_id)->first();

          if($obj_patient)
          {
              $obj_update = $obj_patient->update($arr_pref_notification);
          }
          else
          {
              $arr_pref_notification['user_id']             =  $this->user_id;
              $obj_create = $this->PatientModel->create($arr_pref_notification);
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