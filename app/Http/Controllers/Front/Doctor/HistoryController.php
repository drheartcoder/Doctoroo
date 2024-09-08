<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PatientConsultationBookingModel;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;



class HistoryController extends Controller
{
    public function __construct(PatientConsultationBookingModel $consultation_booking)
    {
        $this->arr_view_data                   = [];
        $this->module_title                    = "Patient Past History";
        $this->module_consult_path             = url('/').'/doctor/consultation';
        $this->module_url_path                 = url('/').'/doctor/profile';
        $this->module_view_folder              = "front.doctor";

        $this->PatientConsultationBookingModel = $consultation_booking;

        $user = Sentinel::check();
        if($user!=false)
        {
           $this->user_id  = $user->id;
        }

    }
    /*
        Rohini jagtap
        date:13 Apr 2017
        desc:show list of past history,pas prescription & past medical certificate of patient
    */
    public function index()
    {
        $arr_past_consultation = $arr_past_prescription = $arr_past_medical_certificate = [];
        
        $arr_past_consultation              = $this->get_past_consultation();
        $arr_past_prescription              = $this->get_past_prescription();
        $arr_past_medical_certificate       = $this->get_past_medical_certificate();

        $this->arr_view_data['arr_medical_certificate']   = $arr_past_medical_certificate;
        $this->arr_view_data['arr_past_prescription']     = $arr_past_prescription;
        $this->arr_view_data['arr_past_consultation']     = $arr_past_consultation;

        $this->arr_view_data['page_title']                = $this->module_title;
        $this->arr_view_data['module_consult_path']        = $this->module_consult_path;
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
        
        return view($this->module_view_folder.'.patient_history',$this->arr_view_data);
    }

    public function get_past_prescription()
    {
        $current_date     = date('Y-m-d');
        $arr_consultation_for = $arr_past_prescription = [];
        $obj_consultation = $this->PatientConsultationBookingModel->where('doctor_user_id','=',$this->user_id)
                                                                  ->with(['patient_user_details'=>function($q){
                                                                        $q->select('id','first_name','last_name');
                                                                  }])
                                                                   ->with(['familiy_member_info'=>function($q){
                                                                        $q->select('id','user_id','first_name','last_name');
                                                                  }])
                                                                  ->where('consultation_date','<',$current_date)
                                                                  ->orderBy('id','=','DESC')
                                                                  ->get();     
        if($obj_consultation)
        {
              $arr_consultation = $obj_consultation->toArray();
              if(isset($arr_consultation) && sizeof($arr_consultation)>0)
              {
                    foreach($arr_consultation as $consultation)
                    {
                        if(isset($consultation['consultation_for']) && $consultation['consultation_for']!='')
                        {
                            $arr_consultation_for = explode(',',$consultation['consultation_for']);
                
                        }
                        /* check that given word is present at given array */
                        if(in_array("prescription",$arr_consultation_for))
                        {
                            array_push($arr_past_prescription,$consultation);    
                        }
                    }
              }
        }
        return $arr_past_prescription;
    }

    public function get_past_consultation()
    {
        $current_date     = '';
        $arr_consultation = [];

        $current_date     = date('Y-m-d');
        $obj_consultation = $this->PatientConsultationBookingModel->where('doctor_user_id','=',$this->user_id)
                                                                  ->with(['patient_user_details'=>function($q){
                                                                        $q->select('id','first_name','last_name');
                                                                  }])
                                                                  ->with(['familiy_member_info'=>function($q){
                                                                        $q->select('id','user_id','first_name','last_name');
                                                                  }])
                                                                  ->where('consultation_date','<',$current_date)
                                                                  ->Where('booking_status','<>','Pending')
                                                                  ->orderBy('id','=','DESC')
                                                                  ->get();     
        if($obj_consultation)
        {
          $arr_consultation = $obj_consultation->toArray();
        }
        return $arr_consultation;
    }
    public function get_past_medical_certificate()
    {
          $current_date            = date('Y-m-d');
          $arr_medical_certificate = $arr_consultation_for = [];

          $obj_consultation = $this->PatientConsultationBookingModel->where('doctor_user_id','=',$this->user_id)
                                                                    ->with(['patient_user_details'=>function($q){
                                                                          $q->select('id','first_name','last_name');
                                                                    }])
                                                                     ->with(['familiy_member_info'=>function($q){
                                                                          $q->select('id','user_id','first_name','last_name');
                                                                    }])
                                                                    ->where('consultation_date','<',$current_date)
                                                                    ->orderBy('id','=','DESC')
                                                                    ->get();     
          if($obj_consultation)
          {
                $arr_consultation = $obj_consultation->toArray();
                if(isset($arr_consultation) && sizeof($arr_consultation)>0)
                {
                      foreach($arr_consultation as $consultation)
                      {
                          if(isset($consultation['consultation_for']) && $consultation['consultation_for']!='')
                          {
                              $arr_consultation_for = explode(',',$consultation['consultation_for']);
                  
                          }
                          /* check that given word is present at given array */
                          if(in_array("medical_certificate",$arr_consultation_for))
                          {
                              array_push($arr_medical_certificate,$consultation);    
                          }
                      }
                }
          }
          return $arr_medical_certificate;
    }
}
?>