<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\RegularDoctorModel;
use App\Models\UserModel;
use App\Models\ChangeMobileNoModel;
use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\MobileCountryCodeModel;


use Twilio\Rest\Client;
use Validator;
use Flash;
use Sentinel;
use Session;

class MobileNumberChangeRequestController extends Controller
{
     public function __construct(RegularDoctorModel $regulardoctor,
                                 UserModel $user,
                                 ChangeMobileNoModel $ChangeMobileNoModel,
                                 DoctorModel                $DoctorModel,
                                 MobileCountryCodeModel     $MobileCountryCodeModel,
                                 PatientModel $PatientModel
                                )
    {
        $this->RegularDoctorModel      = $regulardoctor;
        $this->UserModel               = $user;
        $this->ChangeMobileNoModel     = $ChangeMobileNoModel;
        $this->DoctorModel             = $DoctorModel;
        $this->PatientModel            = $PatientModel;
        $this->MobileCountryCodeModel  = $MobileCountryCodeModel;

        $this->arr_view_data           = [];
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/mobile_number_change_request");
        $this->module_title            = "Mobile Number Change Requests";
        $this->module_view_folder      = "admin.mobile-number-change-requests";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');



        $this->sid                     = config('services.twilio')['accountSid'];
        $this->token                   = config('services.twilio')['auth_token'];
        $this->service_id              = config('services.twilio')['service_id'];
        $this->client                  = new Client($this->sid,$this->token);
    }


    public function doctor_requests()
     {
      
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();



        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
               $arr_manage=$this->ChangeMobileNoModel
                                ->select('dod_change_mobile_no.id',
                                         'dod_change_mobile_no.doctor_id',
                                         'dod_change_mobile_no.patient_id',
                                         'dod_change_mobile_no.first_name',
                                         'dod_change_mobile_no.last_name',
                                         'dod_change_mobile_no.old_phone_no',
                                         'dod_change_mobile_no.new_country_code',
                                         'dod_change_mobile_no.new_phone_no',
                                         'dod_change_mobile_no.dob',
                                         'dod_change_mobile_no.address',
                                         'dod_change_mobile_no.last_consult_date',
                                         'dod_change_mobile_no.additional_notes',
                                         'dod_change_mobile_no.created_at' ) 
                                ->where('patient_id','=',0)
                                ->get();                                          
  
                if($arr_manage!=FALSE)
                {
                    $arr_requests = $arr_manage->toArray(); 
                }
   
                $this->arr_view_data['arr_data']        = $arr_requests;               
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
              
                return view($this->module_view_folder.'/doctor',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    public function patient_requests()
     {
      
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();



        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
               $arr_manage=$this->ChangeMobileNoModel
                                ->select('dod_change_mobile_no.id',
                                         'dod_change_mobile_no.doctor_id',
                                         'dod_change_mobile_no.patient_id',
                                         'dod_change_mobile_no.first_name',
                                         'dod_change_mobile_no.last_name',
                                         'dod_change_mobile_no.old_phone_no',
                                         'dod_change_mobile_no.new_country_code',
                                         'dod_change_mobile_no.new_phone_no',
                                         'dod_change_mobile_no.dob',
                                         'dod_change_mobile_no.address',
                                         'dod_change_mobile_no.last_consult_date',
                                         'dod_change_mobile_no.additional_notes',
                                         'dod_change_mobile_no.created_at' ) 
                                ->where('doctor_id','=',0)
                                ->get();                                          
  
                if($arr_manage!=FALSE)
                {
                    $arr_requests = $arr_manage->toArray(); 
                }
   
                $this->arr_view_data['arr_data']        = $arr_requests;               
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
              
                return view($this->module_view_folder.'/patient',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    public function request_delete($enc_id=FALSE)
    {     
        if($enc_id)
        {
            $id = base64_decode($enc_id);
          
            $deleterequest =    $this->ChangeMobileNoModel->where('id',$id)->delete();
                
            if($deleterequest)
            {
               
                Flash::success('Mobile number change request deleted successfully.');
            }
            else
            {
               
                Flash::error('Problem Occured, While Deleting mobile number change request.');
            }
        }
        else
        {
            Flash::error('Invalid Request.');
        }
        
        return redirect()->back();
    }

    public function multi_action(Request $request)
    {      

        $arr_rules = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            {    
                $deleteuser= $this->ChangeMobileNoModel->where('id',$record_id)->delete();
                if($deleteuser)
                {
                    Flash::success('Mobile number change  Request\'s deleted successfully.'); 
                }            
            } 
        
        }
                    
       return redirect()->back();
    }
    public function accept_request($doctor_id,$patient_id,$new_mobile_no,$mobile_code)
    { 

       $doctor_id     = base64_decode($doctor_id);
       $patient_id    = base64_decode($patient_id); 
       $new_mobile_no = base64_decode($new_mobile_no);  
       $mobile_code   = base64_decode($mobile_code);  



       if($patient_id == '0'){
                 $change_doctor_number = $this->DoctorModel->where('user_id' , $doctor_id)->update(['mobile_no'=>encrypt_value($new_mobile_no),'mobile_code'=>$mobile_code]);
                 if($change_doctor_number){
                    $this->ChangeMobileNoModel->where('doctor_id',$doctor_id)->delete();
                 }

                 /* send msg to admin */
                
                if(isset($mob_code) && $mob_code != ''){
                    $to = '+'.$mob_code.''.$new_mobile_no;;
                    $message = 'Your new mobile number has been changed successfully';

                    $sid            = env('TWILIO_SMS_SID');
                    $token          = env('TWILIO_SMS_TOKEN');
                    $twilioNumber   = env('TWILIO_NUMBER');
                    
                    $client = new Client($sid, $token);
                    try
                    {
                            $client->messages->create(
                                $to,
                                [
                                    "body" => $message,
                                    "from" => $twilioNumber
                                ]
                            );
                    }
                    catch (Exception $e)
                    {
                    }
                }
                /* end send msg to admin */


                 Flash::success('Doctor mobile number has been successfully changed');
                 return redirect()->back();
       }
       else if($doctor_id == '0') {
             $change_patient_number = $this->PatientModel->where('user_id' , $patient_id)->update(['mobile_no'=>encrypt_value($new_mobile_no),'mobile_code'=>$mobile_code]);
             if($change_patient_number){
                $this->ChangeMobileNoModel->where('patient_id',$patient_id)->delete();
             }

                /* send msg to admin */
                $get_mob_data = $this->MobileCountryCodeModel->where('id', $mobile_code)->first();
                if($get_mob_data)
                {
                    $mob_data = $get_mob_data->toArray();
                    $mob_code = $mob_data['phonecode'];
                }
                if(isset($mob_code) && $mob_code != ''){
                    $to = '+'.$mob_code.''.$new_mobile_no;;
                    $message = 'Your new mobile number has been changed successfully';

                    $sid            = env('TWILIO_SMS_SID');
                    $token          = env('TWILIO_SMS_TOKEN');
                    $twilioNumber   = env('TWILIO_NUMBER');
                    
                    $client = new Client($sid, $token);
                    try
                    {
                            $client->messages->create(
                                $to,
                                [
                                    "body" => $message,
                                    "from" => $twilioNumber
                                ]
                            );
                    }
                    catch (Exception $e)
                    {
                    }
                }
                /* end send msg to admin */


             Flash::success('Patient mobile number has been successfully changed');
             return redirect()->back();
       }
       else{
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
       }
    }
}