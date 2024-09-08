<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\PatientMedicalhistoryModel;
use App\Models\IllnessAndConditionModel;
use App\Models\PatientIllnessAndConditionModel;
use App\Models\MedicalhistoryModel;
use App\Models\MainMedicationModel;
use App\Common\Services\EmailService;
use Validator;
use Flash;
use Sentinel;
use Activation;
use DB;
use Reminder;
use Response;
use Session;

class MedicalhistoryController extends Controller
{

    public function __construct(UserModel                   $UserModel,
                                PatientModel                $PatientModel,
                                PatientMedicalhistoryModel  $patientmedicalhistory,
                                IllnessAndConditionModel    $illness,
                                PatientIllnessAndConditionModel $patientillness,
                                MedicalhistoryModel         $medicalhistory,
                                MainMedicationModel         $mainmedication, 
                                EmailService         $EmailService)
    {	

    	  $this->arr_view_data[]                 =  [];
      	$this->UserModel	                     =  $UserModel;
        $this->PatientModel                    =  $PatientModel;
        $this->EmailService                    =  $EmailService;
        $this->PatientMedicalhistoryModel      =  $patientmedicalhistory;
        $this->IllnessAndConditionModel        =  $illness;
        $this->PatientIllnessAndConditionModel =  $patientillness;
        $this->MedicalhistoryModel             =  $medicalhistory;
        $this->MainMedicationModel             =  $mainmedication;

        $this->module_title                    = "Medical History";
      	$this->module_view_folder              = 'front.patient.medicalhistory';
        $this->module_url_path                 = url('/').'/patient/medicalhistory';
        $this->public_img_path                 = url('/public').config('app.project.img_path.card-photo');
        $this->base_path                       = base_path().'/public';
        $this->site_url                        = url('/');

        $this->precription_public_path         = url('/public').config('app.project.img_path.precription_file');
        $this->precription_base_path           = public_path().config('app.project.img_path.precription_file');
    }	

    public function step_one($enc_id=false)
    {
        
        $member_id = 0;

        $arr_illness                = array();
        $arr_patient_illness        = array();
        $arr_medicalhistory = $arr_curr_medicalhistory = $arr_past_medicalhistory = array();
       
        $this->arr_view_data['page_title'] = str_singular($this->module_title);

        $obj_illness = $this->IllnessAndConditionModel->where('illness_status','1')
                                                      ->orderBy('illness_name','asc')->get();

        if($obj_illness)
        {
            $arr_illness = $obj_illness->toArray();
        }
        $user = Sentinel::check();
        
        if($user)
        {

            $member_id = Session::get('family_member_id');

            if($member_id=="")
            {

                $member_id = 0;
            }

            $obj_patient_illness       = $this->PatientIllnessAndConditionModel;

            $obj_patient_illness       = $obj_patient_illness->where('user_id',$user->id)
                                                         ->with(['medial_history'=>function($q) use($member_id){
                                                                    $q->where('family_member_id','=',$member_id);
                                                                    $q->select('id','family_member_id','user_id','current_past_treatment');
                                                          }])
                                                          ->where('family_member_id','=',$member_id)->first();    

                                                           
            if($obj_patient_illness)
            {
                $arr_patient_illness  = $obj_patient_illness->toArray();
            }


            /*==================Step I =========================================*/

              $obj_main_medication     =  $this->MainMedicationModel->get();
             if($obj_main_medication!=FALSE)
             {

                $arr_medication = $obj_main_medication->toArray();
             } 
             
             $obj_current_medicalhistory = $this->PatientMedicalhistoryModel->where('user_id',$user->id);
             $obj_past_medicalhistory    = $this->PatientMedicalhistoryModel->where('user_id',$user->id);
             $obj_medicalhistory         = $this->MedicalhistoryModel->where('user_id',$user->id);



            $obj_curr_medicalhistory =  $obj_current_medicalhistory->where('m_type','current')
                                                                   ->where('family_member_id',$member_id)
                                                                    ->get();

            $obj_past_medicalhistory =  $obj_past_medicalhistory->where('m_type','past')
                                                                ->where('family_member_id',$member_id)
                                                                ->get();
                
            $obj_medical_history     =  $obj_medicalhistory->where('user_id',$user->id)
                                                           ->where('family_member_id',$member_id)
                                                           ->first();
    
             if($obj_curr_medicalhistory!=FALSE)
             {

                   $arr_curr_medicalhistory =  $obj_curr_medicalhistory->toArray();
             }

             if($obj_past_medicalhistory!=FALSE)
             {

                   $arr_past_medicalhistory =  $obj_past_medicalhistory->toArray();

             }

             if($obj_medical_history!=FALSE)
             {

                   $arr_medicalhistory =  $obj_medical_history->toArray();
             }


            $this->arr_view_data['arr_medication']           = $arr_medication;
            $this->arr_view_data['arr_medicalhistory']       = $arr_medicalhistory;
            $this->arr_view_data['arr_curr_medicalhistory']  = $arr_curr_medicalhistory;
            $this->arr_view_data['arr_past_medicalhistory']  = $arr_past_medicalhistory;   

           /*=======================End=============================================*/  

        }    

        $this->arr_view_data['family_member_id']   = base64_encode($member_id);
        $this->arr_view_data['arr_patient_illness']= $arr_patient_illness;
        $this->arr_view_data['arr_illness']        = $arr_illness;
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['site_url']           = $this->site_url;
        return view($this->module_view_folder.'.medical_history_step_1',$this->arr_view_data);

    }

    public function store_step_1(Request $request)
    {

      
       $file_name = '';
        $form_data = array();
        $form_data = $request->all();

        //dd($form_data);

        $member_id = 0;

        $curr_images['curr_images'] = array();
        $past_images['past_images'] = array();


        if(isset($form_data['family_member_id']) && $form_data['family_member_id']!='')
        {
            $member_id = base64_decode($form_data['family_member_id']);
        }


        $user = Sentinel::check();

        if($user)
        {


            $member_id = Session::get('family_member_id');

            if($member_id=="")
            {

                $member_id = 0;
            }

              $arr_illness['illness_id']         = isset($form_data['illness_name'])?$form_data['illness_name']:'';
              $arr_illness['user_id']            = $user->id;
              $arr_illness['family_member_id']   = $member_id;


              $main_arr['family_member_id']        = $member_id; 
              $main_arr['user_id']                 = $user->id;  
              $main_arr['current_past_treatment']  = $form_data['current_past_treatment'];
              
                     
              $obj_medical_history      = $this->MedicalhistoryModel->where('user_id',$user->id);
              $obj_illness              = $this->PatientIllnessAndConditionModel;


              /* check is_familiy member or user */

           
               
            if($obj_medical_history)
            {
                  $count_record_exist = $obj_medical_history->where('family_member_id',$member_id)->count();

                  if($count_record_exist>0)
                  {

                     $main_result = $obj_medical_history->where('family_member_id',$member_id)
                                                        ->update(['current_past_treatment'=>$form_data['current_past_treatment']]);
                  }
                  else
                  {     
                         
                         $main_result = $this->MedicalhistoryModel->create($main_arr);   
                  }

            }      

            if($obj_illness)
            {

                  $count_record = $obj_illness->where('user_id',$user->id)->where('family_member_id',$member_id)
                                                                          ->count();

                  if($count_record>0)
                  {

                     $obj_result    = $obj_illness->where('user_id',$user->id)->where('family_member_id',$member_id)->first();
                     $result        = $obj_result->update(['illness_id'=>$arr_illness['illness_id']]);
                                                                       
                  }
                  else
                  {
                      $result   = $obj_illness->create($arr_illness);     
                  }
            }       
           

           /*================================Step I Data==================================================*/
                           
           $this->PatientMedicalhistoryModel->where('user_id',$user->id)->where('family_member_id',$member_id)->delete();   

           //dd($request->file('curr_precription_file'));

            foreach($request->file('curr_precription_file') as $key=>$file) 
            {    

                if(isset($file) && $file!="")
                {

                    $file_name      = $file;
                    $file_extension = strtolower($file->getClientOriginalExtension());
                    $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                    $file->move($this->precription_base_path, $file_name); 

                    if(isset($form_data['old_curr_precription_file'][$key]) && $form_data['old_curr_precription_file'][$key]!="")
                    {
                      
                       @unlink($this->precription_base_path.$form_data['old_curr_precription_file'][$key]);

                    }
                     
                }
                else
                {
                    if(isset($form_data['old_curr_precription_file'][$key]) && $form_data['old_curr_precription_file'][$key]!="")
                     {
                        $file_name = $form_data['old_curr_precription_file'][$key]; 
                     }
                }

                $curr_images['curr_images'][]  = $file_name;
            }    
   
               

            if(count($form_data['curr_medication_name'])>0)
            {
          
                for($i=0;$i<count($form_data['curr_medication_name']);$i++)
                {    
                    if(isset($member_id) && $member_id!=0)
                    {
                        $arr_curr['family_member_id'] = $member_id;
                    }
                    if($form_data['curr_medication_name'][$i]!="" || $form_data['curr_number'][$i]!="" || $form_data['curr_frequency'][$i]!="" || $form_data['curr_use'][$i]!="" && $form_data['curr_date_started'][$i]!="" || $curr_images['curr_images'][$i])
                    {
                      $arr_curr['user_id']          = $user->id;
                      $arr_curr['medication_name']  = $form_data['curr_medication_name'][$i];
                      $arr_curr['date_started']     = date('Y-m-d',strtotime($form_data['curr_date_started'][$i]));
                      $arr_curr['m_number']         = $form_data['curr_number'][$i];
                      $arr_curr['frequency']        = $form_data['curr_frequency'][$i];
                      $arr_curr['m_use']            = $form_data['curr_use'][$i];
                      $arr_curr['m_type']           = 'current';
                      $arr_curr['precription_file' ]=  $curr_images['curr_images'][$i]; 
                      $result_curr_medical = $this->PatientMedicalhistoryModel->create($arr_curr);  
                    }     
                }
            }

            /*=====================Past=====================================================*/

         
            foreach($request->file('past_precription_file') as $key=>$file) 
            {    

                if($file!="")
                {

                    $file_name      = $file;
                    $file_extension = strtolower($file->getClientOriginalExtension());
                    $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                    $file->move($this->precription_base_path, $file_name); 

                  if(isset($form_data['old_past_precription_file'][$key]) && $form_data['old_past_precription_file'][$key]!="")
                    {
                        @unlink($this->precription_base_path.$form_data['old_past_precription_file'][$key]);
                    }
                }    
                else
                {
                     if(isset($form_data['old_past_precription_file'][$key]) && $form_data['old_past_precription_file'][$key]!="")
                     {
                         $file_name = $form_data['old_past_precription_file'][$key]; 
                     }
                }

                $past_images['past_images'][]  = $file_name;
                
            }    

      

            if(count($form_data['past_medication_name'])>0)
            {

                for($i=0;$i<count($form_data['past_medication_name']);$i++)
                {   

                    if(isset($member_id) && $member_id!=0)
                    {
                        $arr_curr['family_member_id'] = $member_id;
                    } 
                    if($form_data['past_medication_name'][$i]!="" || $form_data['past_number'][$i]!="" || $form_data['past_frequency'][$i]!="" || $form_data['past_use'][$i]!="" || $form_data['past_date_started'][$i]!="" || $past_images['past_images'][$i]!="")
                    {  
                      $arr_curr['user_id']          = $user->id;
                      $arr_curr['medication_name']  = $form_data['past_medication_name'][$i];
                      $arr_curr['date_started']     = date('Y-m-d',strtotime($form_data['past_date_started'][$i]));
                      $arr_curr['m_number']         = $form_data['past_number'][$i];
                      $arr_curr['frequency']        = $form_data['past_frequency'][$i];
                      $arr_curr['m_use']            = $form_data['past_use'][$i];
                      $arr_curr['m_type']           = 'past';
                      $arr_curr['precription_file'] =  $past_images['past_images'][$i];
                      $result_past_medical = $this->PatientMedicalhistoryModel->create($arr_curr);   
                    }    
                }
            }  

            /*===================================End=============================================*/    

              
          
            if($result || $result_past_medical || $result_curr_medical || $main_result)
            {

                Flash::success("Step first completed successfully."); 
                return redirect($this->module_url_path.'/step-2');
                
               
            }
            else
            {
                 Flash::error("Problem Occured, While completing step first."); 
                 return redirect()->back(); 
            }
        }  
        else
        {

             Flash::error("Invalid User."); 
             return redirect()->back(); 
        }   

        return redirect()->back();
    }

    public function step_two($enc_id=false)
    {

        $member_id = 0;
        $arr_medicalhistory = array();
        $this->arr_view_data['page_title'] = str_singular($this->module_title);

       $member_id = Session::get('family_member_id');

        if($member_id=="")
        {

            $member_id = 0;
        }

        $user = Sentinel::check();
        if($user)
        {


            $obj_medical_history = $this->MedicalhistoryModel;
            $obj_medical_history = $obj_medical_history->where('user_id',$user->id)
                                                           ->where('family_member_id',$member_id)
                                                           ->first();

                //dd( $obj_medical_history);
            if($obj_medical_history)
            {

                $arr_medicalhistory   = $obj_medical_history->toArray();
            }

        }   
      
                //dd( $arr_medicalhistory);
        $this->arr_view_data['arr_medicalhistory'] = $arr_medicalhistory;
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['site_url']           = $this->site_url;
        return view($this->module_view_folder.'.medical_history_step_2',$this->arr_view_data);
    }

    public function store_step_2(Request $request)
    {

      
        $form_data  =   $request->all();

        $user = Sentinel::check();
        

        $member_id = Session::get('family_member_id');

        if($member_id=="")
        {

            $member_id = 0;
        }

        if($user)
        {

            $arr_lifestyle['daily_sleep']           = isset($form_data['daily_sleep'])?$form_data['daily_sleep']:'';
            //$arr_lifestyle['smoking_status']        = isset($form_data['smoking_status'])?$form_data['smoking_status']:'';
            $arr_lifestyle['smoking_frequency']     = isset($form_data['smoking_frequency'])?$form_data['smoking_frequency']:'';
            $arr_lifestyle['diet_pattern']          = isset($form_data['diet_pattern'])?$form_data['diet_pattern']:'';
            $arr_lifestyle['diet_other']            = isset($form_data['diet_details'])?$form_data['diet_details']:'';
            $arr_lifestyle['recreational_drug_use'] = isset($form_data['recreational_drug'])?$form_data['recreational_drug']:'';
            $arr_lifestyle['excersice']             = isset($form_data['exercise'])?$form_data['exercise']:'';
            $arr_lifestyle['alcohol']               = isset($form_data['alcohol'])?$form_data['alcohol']:'';
            $arr_lifestyle['stress_level']          = isset($form_data['stress_level'])?$form_data['stress_level']:'';
            $arr_lifestyle['marital_status']        = isset($form_data['marital_status'])?$form_data['marital_status']:'';
            $arr_lifestyle['sytolic_value']         = isset($form_data['sytolic_value'])?$form_data['sytolic_value']:'';
            $arr_lifestyle['diastolic_value']       = isset($form_data['diastolic_value'])?$form_data['diastolic_value']:'';
            $arr_lifestyle['pluse_value']           = isset($form_data['pluse_value'])?$form_data['pluse_value']:'';
            $arr_lifestyle['measure_date']          = date('Y-m-d',strtotime($form_data['measure_date']));
            $arr_lifestyle['time']                  = isset($form_data['time'])?$form_data['time']:'';
            $arr_lifestyle['blood_sugar_value']     = isset($form_data['blood_sugar_value'])?$form_data['blood_sugar_value']:'';
            $arr_lifestyle['meal']                  = isset($form_data['meal'])?$form_data['meal']:'';
            $arr_lifestyle['blood_sugar_measure_date'] = date('Y-m-d',strtotime($form_data['sugar_measure_date']));
            $arr_lifestyle['blood_sugar_time']      = isset($form_data['sugar_time'])?$form_data['sugar_time']:'';

            $obj_medical_history = $this->MedicalhistoryModel->where('user_id',$user->id);
            
            $result = $obj_medical_history->where('family_member_id',$member_id)
                                              ->update($arr_lifestyle);
            if($result)
            {

                Flash::success("Step second completed successfully."); 
                return redirect($this->module_url_path.'/step-3');
     
            }
            else
            {

                Flash::error("Problem Occured, While completing step second."); 
                return redirect()->back(); 
            }

        }
        else {

                Flash::error("Invalid User."); 
                return redirect()->back(); 
            
            }    

       return redirect()->back(); 
    }

    public function step_three($enc_id=false)
    {
        $member_id = $patient_age = 0;

        $arr_medicalhistory = $arr_patient = array();
        $this->arr_view_data['page_title'] = str_singular($this->module_title);

        $user = Sentinel::check();
        
        $member_id = Session::get('family_member_id');

        if($member_id=="")
        {

            $member_id = 0;
        }

        if($user)
        {

            $obj_patient = $this->PatientModel->where('user_id',$user->id)->select('gender','date_of_birth')
                                                                          ->first();

            if($obj_patient)
            {
                $arr_patient = $obj_patient->toArray();
                if(isset($arr_patient['date_of_birth']))
                {
                    $patient_age = date_diff(date_create($arr_patient['date_of_birth']),date_create('now'))->y;

                }
            }

           $obj_record = $this->MedicalhistoryModel->where('user_id',$user->id)
                                                   ->where('family_member_id','=',$member_id)
                                                   ->first();
              
           
            if($obj_record)
            {
                $arr_medicalhistory = $obj_record->toArray();
            }

        }  

        $this->arr_view_data['patient_age']        = $patient_age; 
        $this->arr_view_data['arr_patient']        = $arr_patient; 
        $this->arr_view_data['family_member_id']   = base64_encode($member_id);
        $this->arr_view_data['arr_medicalhistory'] = $arr_medicalhistory;
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['site_url']           = $this->site_url;
        return view($this->module_view_folder.'.medical_history_step_3',$this->arr_view_data);
    }

    public function store_step_3(Request $request)
    {
        $member_id      = 0;
        $form_data      = array();
        $form_data      = $request->all();
        
        $member_id = Session::get('family_member_id');

        if($member_id=="")
        {

            $member_id = 0;
        }

        $user = Sentinel::check();
        
        if($user)
        {

            

             $arr_info['allergies']                = isset($form_data['allergies'])?$form_data['allergies']:'';
             $arr_info['surgeries_and_procedures'] = isset($form_data['surgeries_and_procedures'])?$form_data['surgeries_and_procedures']:'';
             $arr_info['had_colonoscopy']          = isset($form_data['had_colonoscopy'])?$form_data['had_colonoscopy']:'';
             $arr_info['obstetrics']               = isset($form_data['obstetrics'])?$form_data['obstetrics']:'';
             $arr_info['complications']            = isset($form_data['complications'])?$form_data['complications']:'';
             $arr_info['family_history']           = isset($form_data['family_history'])?$form_data['family_history']:'';
             $arr_info['any_genetic_diseases']     = isset($form_data['any_genetic_diseases'])?$form_data['any_genetic_diseases']:'';
             $arr_info['other']                    = isset($form_data['other'])?$form_data['other']:'';

           
                $record_exist = $this->MedicalhistoryModel->where('user_id',$user->id)
                                                           ->where('family_member_id',$member_id)
                                                           ->count();
                 if($record_exist>0)
                 {
                     $result   = $this->MedicalhistoryModel->where('user_id',$user->id)
                                                           ->where('family_member_id',$member_id)
                                                           ->update($arr_info);
                 }
                 else
                 {
                    $arr_info['user_id']          = $user->id;
                    $arr_info['family_member_id'] = $member_id;
                    $result   = $this->MedicalhistoryModel->create($arr_info);  
                 }
           
            if($result)
            {

                Flash::success("Step third completed successfully."); 
                return redirect($this->module_url_path.'/step-3');
              
            }
            else
            {

                Flash::error("Problem Occured, While completing step third."); 
                return redirect()->back(); 
            }
        }
        
       return redirect()->back();     
    }

    public function download_precription($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            
            $id = base64_decode($enc_id);

            $obj_medication_info = $this->PatientMedicalhistoryModel->where('id',$id)->first();
            if($obj_medication_info!=FALSE)
            {

                $arr_medication = $obj_medication_info->toArray();

                if(sizeof($arr_medication)>0)
                {

                    if(isset($arr_medication['precription_file']) && $arr_medication['precription_file']!=""  && file_exists($this->precription_base_path.$arr_medication['precription_file']))
                    {    
                 
                        $file     = $this->precription_base_path.$arr_medication['precription_file'];
                        return Response::download($file);

                    }    
                }    
            }
           
       }
      
      return redirect()->back();      
         
    }

    /*==============================Health Section(Seema)===============================================*/

    public function show_health()
    {
        $arr_illness                             = $arr_curr_medicalhistory = $arr_past_medicalhistory =[];
        $arr_medical_history                     = $arr_curr_prescription   = $arr_past_prescription   =[];
        $this->arr_view_data['page_title']       = 'My Health';
        $arr_medicalhistory                      = array();
        $illness_str                             = '';
        $user                                    = Sentinel::check();
        $member_id                               = Session::get('family_member_id');

        if($user)
        {

            $obj_medical_history = $this->MedicalhistoryModel
                                        ->with(['illnessinfo'=>function($q) use ($user,$member_id){

                                                $q->where('user_id','=',$user->id); 
                                                $q->where('family_member_id','=',$member_id); 

                                        },'patient_medical_history'])
                                        ->where('user_id',$user->id)
                                        ->where('family_member_id','=',0)
                                        ->first();
          
            if($obj_medical_history!=FALSE)
            {
                $arr_medical_history = $obj_medical_history->toArray();

            }
            
            /*get patient medications*/
            $obj_current_medicalhistory = $this->PatientMedicalhistoryModel->where('user_id',$user->id);
            $obj_past_medicalhistory    = $this->PatientMedicalhistoryModel->where('user_id',$user->id);

            if(isset($member_id) && $member_id!=0)
            {

                $obj_curr_medicalhistory =  $obj_current_medicalhistory->where('m_type','current')
                                                                       ->where('family_member_id',$member_id)
                                                                       ->get();

                $obj_past_medicalhistory =  $obj_past_medicalhistory->where('m_type','past')
                                                                       ->where('family_member_id',$member_id)
                                                                       ->get();

                 
            }
            else
            {
                $obj_curr_medicalhistory =  $obj_current_medicalhistory->where('m_type','current')
                                                                      ->where('family_member_id','=',0)
                                                                      ->get();

                $obj_past_medicalhistory =  $obj_past_medicalhistory->where('m_type','past')
                                                                    ->where('family_member_id','=',0)
                                                                    ->get();

     
            }

             if($obj_curr_medicalhistory!=FALSE)
             {

                   $arr_curr_medicalhistory =  $obj_curr_medicalhistory->toArray();
                   //dd($arr_curr_medicalhistory);
             }

             if($obj_past_medicalhistory!=FALSE)
             {

                   $arr_past_medicalhistory =  $obj_past_medicalhistory->toArray();

             }


            /* get illness name */
            if(isset($arr_medical_history) && sizeof($arr_medical_history))
            {   
                  if(isset($arr_medical_history['illnessinfo']['illness_id']) && $arr_medical_history['illnessinfo']['illness_id']!='')
                    {
                        foreach($arr_medical_history['illnessinfo']['illness_id'] as $illness_id)
                        {
                            $obj_illness   =   $this->IllnessAndConditionModel->where('id',$illness_id)->select('illness_name')->first();
                           //dd($obj_illness);
                            $arr_illness[] =   $obj_illness->illness_name;


                        }
                        $illness_str   = implode(',',$arr_illness);
                    }

            }
            /*get current prescription*/
            if(isset($arr_curr_medicalhistory) && sizeof($arr_curr_medicalhistory)>0)
            {
                 foreach ($arr_curr_medicalhistory as $key => $value) 
                 {
                    if(isset($value['precription_file']) && $value['precription_file']!='')
                    {
                         $arr_curr_prescription[$key]['file_name'] = $value['precription_file'];
                         $arr_curr_prescription[$key]['id']        = $value['id'];

                    }
                   
                 }
                 //dd($arr_curr_prescription);   
            }


             /*get past prescription*/
            if(isset($arr_past_medicalhistory) && sizeof($arr_past_medicalhistory)>0)
            {
                 foreach ($arr_past_medicalhistory as $key => $value) 
                 {
                     if(isset($value['precription_file']) && $value['precription_file']!='')
                     {
                        $arr_past_prescription[$key]['file_name'] = $value['precription_file'];
                        $arr_past_prescription[$key]['id']        = $value['id'];
                     }
                 }   
            }

        }

        

        $this->arr_view_data['module_url_path']          = $this->module_url_path;

        $this->arr_view_data['arr_curr_medicalhistory']  = $arr_curr_medicalhistory;
        $this->arr_view_data['arr_past_medicalhistory']  = $arr_past_medicalhistory;

        $this->arr_view_data['arr_curr_prescription']    = $arr_curr_prescription;
        $this->arr_view_data['arr_past_prescription']    = $arr_past_prescription;

        $this->arr_view_data['family_member_id']         = base64_encode($member_id);
        $this->arr_view_data['illness_str']              = $illness_str;
        $this->arr_view_data['arr_medical_history']      = $arr_medical_history;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;
        $this->arr_view_data['site_url']                 = $this->site_url;
        return view($this->module_view_folder.'.health',$this->arr_view_data);
    }
    /*
        rohini jagtap
        16 march 2017
        description:add currrent or pass medication
    */
    public function add_medication(Request $request)
    {
        $form_data  = $arr_medicine = [];
        $user       = Sentinel::check();
        $form_data  =   $request->all();
   
        $member_id  = Session::get('family_member_id');
 
        
        if($user)
        {   
            
            $arr_medicine['user_id']           = $user->id;  
            $arr_medicine['medication_name']   = $form_data['medication_name'];
            $arr_medicine['date_started']      = isset($form_data['medication_date'])?date('Y-m-d',strtotime ($form_data['medication_date'])):'';
            $arr_medicine['m_number']          = $form_data['medication_quantity'];
            $arr_medicine['frequency']         = $form_data['period_taken'];
            $arr_medicine['m_use']             = $form_data['use'];

            if($form_data['type']=='current')
            {
                $arr_medicine['m_type']  = 'current';
            }
            else
            {
                $arr_medicine['m_type']  = 'past';
            }


            if($request->hasFile('current_medication_file')) 
            {
                $curr_medication_file            = $request->file('current_medication_file');

                $img_valiator   = Validator::make(array('image'=>$curr_medication_file),array('image' => 'mimes:png,jpeg,jpg')); 

                if($curr_medication_file->isValid() && $img_valiator->passes())
                {

                      $fileExtension             = strtolower($curr_medication_file->getClientOriginalExtension()); 
                      $enc_medication_file       = sha1(uniqid().$curr_medication_file.uniqid()).'.'.$fileExtension;
                      $curr_medication_file->move($this->precription_base_path,$enc_medication_file);
                      
                      $arr_medicine['precription_file'] = $enc_medication_file;

                }
                else
                {
                     Flash::error('Invalid file extension,please select valid image.');
                     return redirect()->back();
                }
                    
            }


            if($request->hasFile('past_medication_file')) 
            {
                $past_medication_file            = $request->file('past_medication_file');

                $img_valiator   = Validator::make(array('image'=>$past_medication_file),array('image' => 'mimes:png,jpeg,jpg')); 

                if($past_medication_file->isValid() && $img_valiator->passes())
                {

                      $fileExtension             = strtolower($past_medication_file->getClientOriginalExtension()); 
                      $enc_medication_file       = sha1(uniqid().$past_medication_file.uniqid()).'.'.$fileExtension;
                      $past_medication_file->move($this->precription_base_path,$enc_medication_file);
                      
                      $arr_medicine['precription_file'] = $enc_medication_file;

                }
                else
                {
                     Flash::error('Invalid file extension,please select valid image.');
                     return redirect()->back();
                }
                    
            }

            /*===================Health issues================================================*/
            $obj_medical_history           = $this->PatientMedicalhistoryModel->where('user_id',$user->id);

            if($obj_medical_history)
            {
                if(isset($member_id) && $member_id!='')
                {
                    $arr_medicine['family_member_id'] = $member_id;  
   
                    $result = $this->PatientMedicalhistoryModel->create($arr_medicine);   
                    
                }
                else
                {
                   
                    $result = $this->PatientMedicalhistoryModel->create($arr_medicine);   
                 
                }
              
            }
        }

        if($result)
        {
             Flash::success("Medication details added successfully."); 
        }
        else
        {
            Flash::error("Problem Occured, While adding an medication."); 
        }
        return redirect()->back();
    }
     /*
        rohini jagtap
        16 march 2017
        description:add currrent or pass medication
    */
    public function delete_medication($enc_id)
    {
        if(isset($enc_id) && $enc_id!='')
        {
            $medicine_id  = base64_decode($enc_id);

            $delete_status = $this->PatientMedicalhistoryModel->where('id','=',$medicine_id)->delete();
            if($delete_status)
            {
                Flash::success("Medication details deleted successfully."); 
            }
            else
            {
                Flash::error("Problem Occured, While deleteing an medication."); 
            }
            return redirect()->back();
        }
    }
    /*================================End=========================================================*/
    public function medication_listing()
    {


            $arr_result      = $arr_medication = [];
            $term            = \Request::get('term');
            $obj_result      = $this->MainMedicationModel->where('name','like',$term.'%')
                                                         ->select('id','name')
                                                         ->groupBy('name')
                                                         ->get();

            if(isset($obj_result) && $obj_result!='' && sizeof($obj_result)>0)
            {

                  $arr_result = $obj_result->toArray();
                  if(count($arr_result) > 0)
                  {
                      foreach ($arr_result as $key => $value) 
                      {

                      
                        $arr_medication[$key]['label'] = $value['name'];
                        $arr_medication[$key]['id']     = $value['id'];
                      }
                      
                  }
                  else
                  {
                      $arr_medication['label'] = 'Result not found.';

                  }
            }
            else
            {
                $arr_medication['label'] = 'Result not found.';

            }

            return response()->json($arr_medication);
      }
      /*--------------rohini changes----------------*/
      public function set_familiy_member(Request $request)
      {
            $form_data = [];
            $form_data = $request->all();

            if(isset($form_data['family_member_id']) && $form_data['family_member_id']!='')
            {
                 $member_id = base64_decode($form_data['family_member_id']);
                 Session::put('family_member_id',$member_id);
            }
           

      }

}