<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;

use App\Models\UserModel;
use App\Models\DoctorModel;
use App\Models\LanguageModel;
use App\Models\TimezoneModel;
use App\Models\PrefixModel;
use App\Models\DoctorReferencesModel;
use App\Models\MobileCountryCodeModel;
use App\Models\TimezonesModel;
use App\Models\DoctorFeeModel;
use App\Models\AdminProfileModel;

use Validator;
use Flash;
use Sentinel;
use Session;
use Activation;
use URL;
use Paginator;
use DateTime;
use File;
use Mail;

/*-------------------------------Ankit Aher(20th feb 2017)---------------------------*/
class DoctorController extends Controller
{
     public function __construct(UserModel              $user,
                                 DoctorModel            $doctor,
                                 EmailService           $mail_service,
                                 LanguageModel          $language,
                                 TimezoneModel          $time,
                                 PrefixModel            $prefix,
                                 DoctorReferencesModel  $reference,
                                 MobileCountryCodeModel $mob_country_code,
                                 TimezonesModel         $TimezoneModel,
                                 DoctorFeeModel         $DoctorFeeModel,
                                 AdminProfileModel      $AdminProfileModel
                                )
    {
        $this->UserModel                        = $user;
        $this->DoctorModel                      = $doctor;
        $this->LanguageModel                    = $language;
        $this->EmailService                     = $mail_service;
        $this->TimezoneModel                    = $time;
        $this->PrefixModel                      = $prefix;
        $this->DoctorReferencesModel            = $reference;
        $this->MobileCountryCodeModel           = $mob_country_code;
        $this->TimezonesModel                   = $TimezoneModel;
        $this->DoctorFeeModel                   = $DoctorFeeModel;
        $this->AdminProfileModel                = $AdminProfileModel;

        $this->arr_view_data                    = [];
        $this->module_url_path                  = url(config('app.project.admin_panel_slug')."/doctor");
        $this->module_title                     = "Doctor";
        $this->module_view_folder               = "admin.doctor";
        $this->base_path                        = base_path().'/public';
        $this->admin_panel_slug                 = config('app.project.admin_panel_slug');

        $this->ahpra_certificate_base_path      = public_path().config('app.project.img_path.AHPRA_certificate');
        $this->driver_licence_base_path         = public_path().config('app.project.img_path.drivers_licence');
        $this->telehealth_certificate_base_path = public_path().config('app.project.img_path.telehealth_certificate');
        $this->video_base_path                  = public_path().config('app.project.img_path.doctor_video');
        $this->video_public_path                = url('/public').config('app.project.img_path.doctor_video');
        $this->doc_profile_public               = public_path().config('app.project.img_path.doctor_image');
        $this->doc_profile_pic                  = url('/public').config('app.project.img_path.doctor_image');
        $this->doc_video_public                 = public_path().config('app.project.img_path.doctor_video');
        $this->doc_video                        = url('/public').config('app.project.img_path.doctor_video');
        $this->doc_id_proof_public              = public_path().config('app.project.img_path.doctor_id_proof');
        $this->doc_id_proof                     = url('/public').config('app.project.img_path.doctor_id_proof');
        $this->doc_med_reg_public               = public_path().config('app.project.img_path.medical_registration');
        $this->doc_med_reg                      = url('/public').config('app.project.img_path.medical_registration');
        $this->doc_ins_pol_public               = public_path().config('app.project.img_path.insurance_policy');
        $this->doc_ins_pol                      = url('/public').config('app.project.img_path.insurance_policy');
        $this->doc_cyb_liabl_public             = public_path().config('app.project.img_path.cyber_liability');
        $this->doc_cyb_liabl                    = url('/public').config('app.project.img_path.cyber_liability');


    }

     /*=================Seema(updated by 24-Feb-2017)=====================*/

     public function index()
     {

        $this->arr_view_data['page_title']  =  'Verified Doctors';
        $arr_social_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
                $arr_manage =  $this->DoctorModel->whereHas('userinfo',function(){})
                                                 ->with(['userinfo.roles' => function($query) {

                                                        $query->where('slug','=','doctor');
                                                  }])
                                                  ->whereHas('userinfo', function($query)
                                                  {
                                                        //$query->where('verification_status',1);
                                                        //$query->where('admin_verification_status',1);
                                                        $query->where('profile_complete','yes');
                                                        $query->orderBy('id','DESC');
                                                       
                                                  })
                                                  ->with('stripe_connect')
                                                  ->orderBy('id','DESC')
                                                  ->get(); 

             
                if($arr_manage!=FALSE)
                {
                    $arr_manage_doctor = $arr_manage->toArray();
                }
                
                $this->arr_view_data['arr_data']        = $arr_manage_doctor;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = 'Verified Doctors';
                return view($this->module_view_folder.'/verifieddoctor',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/verifieddoctor');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    /*=================Seema(updated by 24-Feb-2017)=====================*/

    public function applications()
    {
            // $this->arr_view_data['page_title']  =  str_singular($this->module_title);
            $this->arr_view_data['page_title']  = 'Doctor Applications';
            $arr_social_settings                = array();

            $arr_manage =  $this->DoctorModel->whereHas('userinfo',function(){})
                                             ->with(['userinfo.roles' => function($query) {

                                                    $query->where('slug','=','doctor');
                                              }])
                                              ->whereHas('userinfo', function($query)
                                              {
                                                    //$query->where('admin_verification_status',0);
                                                    $query->where('profile_complete','no');
                                                    //$query->orWhere('verification_status',0);
                                                    $query->orderBy('id','DESC');
                                                   
                                              })
                                              ->orderBy('id','DESC')
                                              ->get(); 

 
            if($arr_manage!=FALSE)
            {
                $arr_manage_doctor = $arr_manage->toArray();
            }
            
            $this->arr_view_data['arr_data']        = $arr_manage_doctor;
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = 'Doctor Applications';

            return view($this->module_view_folder.'/doctorapplication',$this->arr_view_data);
    }

    /*===================End===================================================*/

    public function invitation()
    {

        $this->arr_view_data['page_title']      =  str_singular($this->module_title);
        $arr_social_settings                    = array();
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        return view($this->module_view_folder.'/invitation',$this->arr_view_data);
    
    }
    public function activate($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['user_status'=>'Active']);

                if($result_status)
                {
                    Flash::success('Doctor Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function deactivate($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['user_status'=>'Block']);

                if($result_status)
                {
                    Flash::success('Doctor  Deactivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Dectivating  Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }
    public function live($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->DoctorModel->where('user_id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['doctor_status'=>'offline']);

                if($result_status)
                {
                    Flash::success('Doctor Live Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Live Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function offline($enc_id=FALSE)
    {

        if($enc_id)
        {

            $id = base64_decode($enc_id);

            $result = $this->DoctorModel->where('user_id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['doctor_status'=>'live']);
                if($result_status)
                {
                    Flash::success('Doctor Offline Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Offline  Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

     public function delete($enc_id=FALSE)
     { 

        if($enc_id)
        {
            $id = base64_decode($enc_id);
            $deleteuser= $this->UserModel->where('id',$id)->delete();
            if($deleteuser)
            {

            $deletedoctor =    $this->DoctorModel->where('user_id',$id)->first();
           
            if($deletedoctor)
            { 
                $result_info = $deletedoctor->delete();

                if($result_info)
                {
                    Flash::success('Doctor Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Doctor.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        
           }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
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
        
                $deleteuser= $this->UserModel->where('id',$record_id)->delete();
                if($deleteuser)
                {
                    $deletedoctor =    $this->DoctorModel->where('user_id',$record_id)->first();
                if($deletedoctor)
                {
                    $result_info = $deletedoctor->delete();

                    if($result_info)
                    {
               
                        Flash::success('Doctor\'s Deleted Successfully'); 
                    }
                }        
            } 
        
        }
        elseif($multi_action=="activate")
        {

                $result = $this->UserModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['user_status'=>'Active']);

                    if($result_status)
                    { 
                        Flash::success('Doctor\'s  Activated Successfully'); 
                    }
                }        
        }
        elseif($multi_action=="deactivate")
        {
               
                $result = $this->UserModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['user_status'=>'Block']);

                    if($result_status)
                    {  
                        Flash::success('Doctor\'s  Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    }
    public function edit($enc_id=null)
    {
        $data = [];
        if($enc_id)
        {
            $id  = base64_decode($enc_id);
            $information =    $this->DoctorModel->where('user_id',$id)->with('userinfo','doctor_timezone','doctor_refernces')->first(); 
       
            if($information)
            {
                $data = $information->toArray();
               
            }   
            $obj_language = $this->LanguageModel->where('language_status', '1')->orderBy('language', 'ASC')->get();
            if($obj_language)
            {
                $arr_language = $obj_language->toArray();
            }
            $obj_timezone = $this->TimezoneModel->get();
            if($obj_timezone)
            {
                $arr_timezone = $obj_timezone->toArray();
            }

            $obj_prefix  = $this->PrefixModel->get();
            if($obj_prefix)
            {
                 $arr_prefix = $obj_prefix->toArray();
            }
/*             $date           = new DateTime("now");
                $is_dst       = intval(date_format($date, "I"));
                if($is_dst==0)
                {
                    
                        foreach($arr_timezone as $key =>$timezone)
                        {
                            $arr_timezone_dst[$key]['id']            = $timezone['id'];
                            $arr_timezone_dst[$key]['time']          = $timezone['standard_time'];
                        }
                }
                else
                {

                foreach ($arr_timezone as $key => $timezone) 
                {
                    if($timezone['summer_time']=='')
                    {
                        $arr_timezone_dst[$key]['id']            = $timezone['id'];
                        $arr_timezone_dst[$key]['time']          = $timezone['standard_time'];
                    }
                    else
                    {
                        $arr_timezone_dst[$key]['id']            = $timezone['id'];
                        $arr_timezone_dst[$key]['time']          = $timezone['summer_time'];
                    }
                   
                }
              }*/

            $get_timezone = $this->TimezoneModel->get();
            if($get_timezone)
            {
                $this->arr_view_data['timezone_data'] = $get_timezone->toArray();
            }

        $get_mob_code = $this->MobileCountryCodeModel->get();
        if($get_mob_code)
        {
            $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
        }

        $this->arr_view_data['doc_video_public']         = $this->doc_video_public;
        $this->arr_view_data['doc_video']                = $this->doc_video;
        $this->arr_view_data['doc_profile_public']       = $this->doc_profile_public;
        $this->arr_view_data['doc_profile_pic']          = $this->doc_profile_pic;
        $this->arr_view_data['doc_ins_pol_public']       = $this->doc_ins_pol_public;
        $this->arr_view_data['doc_med_reg_public']       = $this->doc_med_reg_public;
        $this->arr_view_data['doc_id_proof_public']      = $this->doc_id_proof_public;
        $this->arr_view_data['doc_id_proof']             = $this->doc_id_proof;
        $this->arr_view_data['doc_med_reg']              = $this->doc_med_reg;
        $this->arr_view_data['doc_ins_pol']              = $this->doc_ins_pol;
        $this->arr_view_data['doc_cyb_liabl']            = $this->doc_cyb_liabl;
        $this->arr_view_data['doc_cyb_liabl_public']     = $this->doc_cyb_liabl_public;
          
        $this->arr_view_data['data_info']          = $data;
        $this->arr_view_data['arr_language']       = $arr_language;
        $this->arr_view_data['arr_prefix']         = $arr_prefix;
        $this->arr_view_data['video_base_path']    = $this->video_base_path;
        $this->arr_view_data['video_public_path']  = $this->video_public_path;
        $this->arr_view_data['enc_id']             = $enc_id;
        $this->arr_view_data['page_title']         = 'Edit Doctor';
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['module_title']       = str_singular($this->module_title);

        return view($this->module_view_folder.'/editapplication',$this->arr_view_data);     
        }

        return redirect()->back();
    }   

    /*======================Seema(24-Feb-2017)============================================*/ 

    public function verify($enc_id)
    {
        $user_id    = base64_decode($enc_id);

        $user       = Sentinel::findById($user_id);

        $activation = Activation::createModel()->where('user_id', $user_id)->first();

        if(Activation::exists($user))
        {
            if(Activation::complete($user, $activation->code))
            {
                 //As per testers requirement
                 $arr_mail_data =  $this->notify_mail_data($user_id);
                 $email_status  = $this->EmailService->send_mail($arr_mail_data);

                 if($email_status)
                 {
                    Flash::success('Doctor verification mail send successfully.');
                 }  
            }
            else
            {
               Flash::error('Error, while doctor verification updating.');
            }   
        } 
        else{
                
               $activation = Activation::create($user);

               if($activation)
               {
                    $arr_mail_data =  $this->notify_mail_data($user_id);
                    $email_status  = $this->EmailService->send_mail($arr_mail_data); 

                   if($email_status)
                   { 

                       Flash::success('Doctor verification mail send successfully.');
                   } 
               }     
            }   
           
        return redirect()->back();   

    }

    public function notify_mail_data($user_id)
    {
        $user = $this->UserModel->where('id',$user_id)->first();

       if($user)
        {
            $arr_user   = $user->toArray();
            $token_code = rand(00000,99999);

            $update_result = $this->UserModel->where('id',$user_id)->update(['token'=>$token_code]);
            if($update_result)
            {
                $activation_url = '<a target="_blank" style="background:#50ab50; color:#fff; text-align:center;border-radius: 4px; padding: 15px 18px; text-decoration: none;" href="'.URL::to('doctor/verify/'.base64_encode($arr_user['id']).'/'.base64_encode($token_code) ).'">Verify Account</a>.<br/>' ;


                $arr_built_content = ['USER_FNAME'    => $arr_user['first_name'],
                                      'EMAIL'         => $arr_user['email'],
                                      'ACTIVATION_URL'=> $activation_url, 
                                      'APP_NAME'      => config('app.project.name')];


                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '6';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $arr_user;

                return $arr_mail_data;
            }       
        }

        return FALSE;
    }


    public function activations($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $user_id = base64_decode($enc_id);

            $update_arr = array('verification_status'=>'1',
                                //'user_status'=>'Active',
                                'token'      =>'');

            $user = Sentinel::findById($user_id);

            $activation = Activation::createModel()->where('user_id', $user_id)->first();

            if(Activation::exists($user))
            {
                if(Activation::complete($user, $activation->code))
                {
                     //As per testers requirement
                     
                     $resUser = $this->UserModel->where('id',$user_id)->update($update_arr);

                     if($resUser)
                     {

                        Flash::success('Doctor verification completed successfully.');
                     }
                     else
                     {
                        Flash::error('Error, while doctor verification.');
                     }      
                     
                }
                else
                {
                   Flash::error('Error, while doctor verification.');
                }   
            } 
            else
            {                   
                   $activation = Activation::create($user);

                   if($activation)
                   {

                       $resUser = $this->UserModel->where('id',$user_id)->update(['verification_status'=>'1','user_status'=>'Active','token'=>'']);
                       if($resUser)
                       { 
                           Flash::success('Doctor verification completed successfully.');
                       }
                       else
                       {
                           Flash::error('Error, while doctor verification.');
                       }      
                   }     
            }   
        
        }   
        return redirect()->back();   
    }
    /*-------------------------- Update doctor details-----------------------*/
    public function update(Request $request,$enc_id)
    {
        $user_id = base64_decode($enc_id);
        $arr_rules                          = $form_data = $arr_doctor_data = [];
        $arr_rules['first_name']            = "required";
        $arr_rules['last_name']             = "required";
        $arr_rules['gender']                = "required";
        $arr_rules['day']                   = "required";
        $arr_rules['month']                 = "required";
        $arr_rules['year']                  = "required";
        $arr_rules['citizenship']           = "required";
        $arr_rules['contact_no']            = "required";
        $arr_rules['mobile_code']           = "required";
        $arr_rules['mobile_no']             = "required";
        $arr_rules['address']               = "required";
        $arr_rules['timezone']              = "required";

        $validator  = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $obj_doctor                  = $this->DoctorModel->with(['userinfo'=>function($q){
                                                                                 $q->select('id','profile_image');
                                                                          }])->where('user_id',$user_id)->first();

        $form_data                                  = $request->all();
        

        $day   = $form_data['day'];
        $month = $form_data['month'];
        $year  = $form_data['year'];

        $dob = $year.'-'.$month.'-'.$day;

        $date = date('Y-m-d', strtotime($dob));

        $arr_doctor_data['gender']                  = $form_data['gender'];
        $arr_doctor_data['dob']                     = $date;
        $arr_doctor_data['citizenship']             = $form_data['citizenship'];
        $arr_doctor_data['contact_no']              = $form_data['enc_contact_no'];
        $arr_doctor_data['mobile_code']             = $form_data['mobile_code'];
        $arr_doctor_data['mobile_no']               = encrypt_value($form_data['mobile_no']);
        $arr_doctor_data['address']                 = $form_data['enc_address'];
        $arr_doctor_data['timezone']                = $form_data['timezone'];
        
        $arr_doctor_data['clinic_name']             = $form_data['clinic_name'];
        $arr_doctor_data['clinic_address']          = $form_data['enc_clinic_address'];
        $arr_doctor_data['clinic_contact_no']       = $form_data['enc_clinic_contact_no'];
        $arr_doctor_data['clinic_mobile_no']        = $form_data['enc_clinic_mobile_no'];
        $arr_doctor_data['clinic_mobile_no_code']   = $form_data['clinic_mobile_no_code'];
        $arr_doctor_data['experience']              = $form_data['experience'];
        $arr_doctor_data['language']                = $form_data['sel_languages'];
        $arr_doctor_data['medical_qualification']   = $form_data['enc_medical_qualification'];
        $arr_doctor_data['medical_school']          = $form_data['medical_school'];
        $arr_doctor_data['year_obtained']           = $form_data['year_obtained'];
        $arr_doctor_data['country_obtained']        = $form_data['country_obtained'];
        $arr_doctor_data['other_qualifications']    = $form_data['other_qualifications'];
        $arr_doctor_data['bank_account_name']       = $form_data['enc_bank_account_name'];
        $arr_doctor_data['bsb']                     = $form_data['enc_bsb'];
        $arr_doctor_data['account_number']          = $form_data['enc_account_number'];
        
        $arr_doctor_data['medical_registration_no'] = $form_data['enc_medical_registration_no'];
        $arr_doctor_data['medicare_provider_no']    = $form_data['enc_medicare_provider_no'];
        $arr_doctor_data['prescriber_no']           = $form_data['enc_prescriber_no'];
        $arr_doctor_data['ahpra_registration_no']   = $form_data['enc_ahpra_registration_no'];
        $arr_doctor_data['abn']                     = $form_data['abn'];

        $arr_doctor_data['about_me']                = $form_data['enc_about_me'];


        $arr_user_data['title']                     = $form_data['title'];
        $arr_user_data['first_name']                = $form_data['first_name'];
        $arr_user_data['last_name']                 = $form_data['last_name'];
        $arr_user_data['email']                     = $form_data['email'];

        $id_proof_file_name                 = "";
        $medical_registration_file_name     = "";
        $pi_insurance_policy_file_name      = "";
        $cyber_liability_file_name          = "";

        // upload id proof
        if($request->hasFile('enc_id_proof_file'))
        {
            $id_proof_file   =   $request->file('enc_id_proof_file');

            if(isset($id_proof_file) && sizeof($id_proof_file)>0)
            {
                $extention  =   strtolower($id_proof_file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('id_proof_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                    return response()->json(['status'=>'fail']);
                }
                else if($id_proof_file->getClientSize() > 5000000)
                {
                    Session::flash('id_proof_error','Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json(['status'=>'fail']);
                }
                else
                {
                    if(isset($obj_doctor['id_proof_file']) && !empty($obj_doctor['id_proof_file']) && File::exists($this->doc_id_proof_public.$obj_doctor['id_proof_file']))
                    {
                        unlink($this->doc_id_proof_public.$obj_doctor['id_proof_file']);
                    }
                    
                    $id_proof_file_name      = $request->file('enc_id_proof_file');
                    $id_proof_file_extension = strtolower($request->file('enc_id_proof_file')->getClientOriginalExtension()); 
                    $id_proof_file_name      = sha1(uniqid().$id_proof_file_name.uniqid()).'.'.$id_proof_file_extension;
                    $id_proof_upload_result  = $request->file('enc_id_proof_file')->move($this->doc_id_proof_public, $id_proof_file_name);
                    $arr_doctor_data['id_proof_file']   = $id_proof_file_name;
                }
            }
            else
            {
                Session::flash('id_proof_error','Please upload valid image/document.');
                return response()->json(['status'=>'fail']);
            }
        }

        // upload medical registration certificate
        if($request->hasFile('enc_medical_registration_certificate_file'))
        {
            $medical_registration_certificate   =   $request->file('enc_medical_registration_certificate_file');

            if(isset($medical_registration_certificate) && sizeof($medical_registration_certificate)>0)
            {
                $extention  =   strtolower($medical_registration_certificate->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('medical_registration_certificate_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                    return response()->json(['status'=>'fail']);
                }
                else if($medical_registration_certificate->getClientSize() > 5000000)
                {
                    Session::flash('medical_registration_certificate_error','Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json(['status'=>'fail']);
                }
                else
                {
                    if(isset($obj_doctor['medical_registration_certificate']) && !empty($obj_doctor['medical_registration_certificate']) && File::exists($this->doc_med_reg_public.$obj_doctor['medical_registration_certificate']))
                    {
                        unlink($this->doc_med_reg_public.$obj_doctor['medical_registration_certificate']);
                    }
                    $medical_registration_file_name     = $request->file('enc_medical_registration_certificate_file');
                    $med_reg_file_extension             = strtolower($request->file('enc_medical_registration_certificate_file')->getClientOriginalExtension()); 
                    $medical_registration_file_name     = sha1(uniqid().$medical_registration_file_name.uniqid()).'.'.$med_reg_file_extension;
                    $med_reg_upload_result              = $request->file('enc_medical_registration_certificate_file')->move($this->doc_med_reg_public, $medical_registration_file_name);

                    $arr_doctor_data['medical_registration_certificate']   = $medical_registration_file_name;
                }
            }
            else
            {
                Session::flash('medical_registration_certificate_error','Please upload valid image/document.');
                return response()->json(['status'=>'fail']);
            }
        }

        // upload insurance policy
        if($request->hasFile('enc_pi_insurance_policy_file'))
        {
            $pi_insurance_policy   =   $request->file('enc_pi_insurance_policy_file');

            if(isset($pi_insurance_policy) && sizeof($pi_insurance_policy)>0)
            {
                $extention  =   strtolower($pi_insurance_policy->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('pi_insurance_policy_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                    return response()->json(['status'=>'fail']);
                }
                else if($pi_insurance_policy->getClientSize() > 5000000)
                {
                    Session::flash('pi_insurance_policy_error','Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json(['status'=>'fail']);
                }
                else
                {
                    if(isset($obj_doctor['pi_insurance_policy']) && !empty($obj_doctor['pi_insurance_policy']) && File::exists($this->doc_ins_pol_public.$obj_doctor['pi_insurance_policy']))
                    {
                        unlink($this->doc_ins_pol_public.$obj_doctor['pi_insurance_policy']);
                    }

                    $pi_insurance_policy_file_name      = $request->file('enc_pi_insurance_policy_file');
                    $insurance_policy_file_extension    = strtolower($request->file('enc_pi_insurance_policy_file')->getClientOriginalExtension()); 
                    $pi_insurance_policy_file_name      = sha1(uniqid().$pi_insurance_policy_file_name.uniqid()).'.'.$insurance_policy_file_extension;
                    $insurance_policy_upload_result     = $request->file('enc_pi_insurance_policy_file')->move($this->doc_ins_pol_public, $pi_insurance_policy_file_name);

                    $arr_doctor_data['pi_insurance_policy']   = $pi_insurance_policy_file_name;
                }
            }
            else
            {
                Session::flash('pi_insurance_policy_error','Please upload valid image/document.');
                return response()->json(['status'=>'fail']);
            }
        }

        // upload cyber liability
        if($request->hasFile('enc_cyber_liability_file'))
        {
            $cyber_liability_insurance_policy   =   $request->file('enc_cyber_liability_file');

            if(isset($cyber_liability_insurance_policy) && sizeof($cyber_liability_insurance_policy)>0)
            {
                $extention  =   strtolower($cyber_liability_insurance_policy->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('cyber_liability_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                    return response()->json(['status'=>'fail']);
                }
                else if($cyber_liability_insurance_policy->getClientSize() > 5000000)
                {
                    Session::flash('cyber_liability_error','Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json(['status'=>'fail']);
                }
                else
                {
                    if(isset($obj_doctor['cyber_liability_insurance_policy']) && !empty($obj_doctor['cyber_liability_insurance_policy']) && File::exists($this->doc_cyb_liabl_public.$obj_doctor['cyber_liability_insurance_policy']))
                    {
                        unlink($this->doc_cyb_liabl_public.$obj_doctor['cyber_liability_insurance_policy']);
                    }
                    
                    @unlink($this->doc_cyb_liabl.$request->input('old_cyber_liability_file'));
                    $cyber_liability_file_name      = $request->file('enc_cyber_liability_file');
                    $cyber_liability_file_extension = strtolower($request->file('enc_cyber_liability_file')->getClientOriginalExtension()); 
                    $cyber_liability_file_name      = sha1(uniqid().$cyber_liability_file_name.uniqid()).'.'.$cyber_liability_file_extension;
                    $cyber_liability_upload_result  = $request->file('enc_cyber_liability_file')->move($this->doc_cyb_liabl_public, $cyber_liability_file_name);

                     $arr_doctor_data['cyber_liability_insurance_policy']   = $cyber_liability_file_name;
                }
            }
            else
            {
                Session::flash('cyber_liability_error','Please upload valid image/document.');
                return response()->json(['status'=>'fail']);
            }
        }


        if($request->hasFile('profile_image'))
        {
            $profile_image   =   $request->file('profile_image');

            if(isset($profile_image) && sizeof($profile_image)>0)
            {
                $extention  =   strtolower($profile_image->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('id_proof_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                    return response()->json(['status'=>'fail']);
                }
                else if($profile_image->getClientSize() > 5000000)
                {
                    Session::flash('id_proof_error','Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json(['status'=>'fail']);
                }
                else
                {
                    if(isset($obj_doctor['userinfo']['profile_image']) && !empty($obj_doctor['userinfo']['profile_image']) && File::exists($this->doc_profile_public.$obj_doctor['userinfo']['profile_image']))
                    {
                        unlink($this->doc_profile_public.$obj_doctor['userinfo']['profile_image']);
                    }
                    
                    $profile_image_name      = $request->file('profile_image');
                    $id_proof_file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
                    $profile_image_name      = sha1(uniqid().$profile_image_name.uniqid()).'.'.$id_proof_file_extension;
                    $id_proof_upload_result  = $request->file('profile_image')->move($this->doc_profile_public, $profile_image_name);
                    
                    $arr_user_data['profile_image']   = $profile_image_name;
                }
            }
            else
            {
                Session::flash('id_proof_error','Please upload valid image/document.');
                return response()->json(['status'=>'fail']);
            }
        }

        if($request->hasFile('profile_video'))
        {
            $profile_video   =   $request->file('profile_video');
            if(isset($profile_video) && sizeof($profile_video)>0)
            {
                $extention  =   strtolower($profile_video->getClientOriginalExtension());
                $valid_ext  =   ['mp4','ogg','webm'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('video_type_error','Please upload valid video with valid extension i.e mp4, ogg, webm');
                    return response()->json(['status'=>'fail']);
                }
                else if($profile_video->getClientSize() > 5000000)
                {
                    Session::flash('video_type_error','Please upload video with small size. Max size allowed is 5mb');
                    return response()->json(['status'=>'fail']);
                }
                else
                {
                    if(isset($obj_doctor['profile_video']) && !empty($obj_doctor['profile_video']) && File::exists($this->doc_profile_public.$obj_doctor['profile_video']))
                    {
                        unlink($this->doc_video_public.$obj_doctor['profile_video']);
                    }

                    $video_file_name      = $request->file('profile_video');
                    $file_extension       = strtolower($request->file('profile_video')->getClientOriginalExtension()); 
                    $video_file_name      = sha1(uniqid().$video_file_name.uniqid()).'.'.$file_extension;
                    $upload_result        = $request->file('profile_video')->move($this->doc_video_public, $video_file_name);

                    $arr_doctor_data['profile_video']   = $video_file_name;
                }
            }
            else
            {
                Session::flash('video_type_error','Please upload valid video.');
                return response()->json(['status'=>'fail']);
            }
        }


        if($user_id)
        {    

                $update_doctor = $this->DoctorModel->where('user_id',$user_id)->update($arr_doctor_data);

                /*======================User ===========================================================*/

                $update_arr = array('title'        => $form_data['title'],
                                    'first_name'   => $form_data['first_name'],
                                    'last_name'    => $form_data['last_name'],
                                    'email'        =>$form_data['email']);
                                      
                 $update_result = $this->UserModel->where('id',$user_id)->update($arr_user_data);

                 if($update_doctor || $update_result)
                 {

                     Flash::success("Profile has been updated successfully."); 
                     return response()->json(['status'=>'success']); 
                 }
                 else
                 {

                     Flash::error("Problem Occured, While updating profile."); 
                     return response()->json(['status'=>'fail']); 
                 }
        }         

       return response()->json(['status'=>'fail']);


    }
    
    public function download_certificate($type,$enc_id)
    { 
        $user_id         = base64_decode($enc_id); 
        $arr_certificate = [];
        $file_name       = '';

        $obj_certificate = $this->DoctorModel->where('user_id',$user_id)
                                                    ->select('AHPRA_certificate','upload_insurance_policy','upload_drivers_licence')
                                                    ->first();
        if($obj_certificate)
        {
              $arr_certificate    = $obj_certificate->toArray();
              if($type=='ahpra')
              {                  
                        $file_name       = $arr_certificate['AHPRA_certificate'];
                        $pathToFile      = $this->ahpra_certificate_base_path.$file_name;

                        $file_exits      = file_exists($pathToFile);
                        if($file_exits)
                        {
                           //ob_end_clean(); //clear the buffer memory before download file
                           return response()->download($pathToFile, $file_name); 
                        }
                        else
                        {
                           Flash::error("Error while downloading an document.");
                        }
                        
                  
              }
              else if($type=='insurance')
              {
                        $file_name       = $arr_certificate['upload_insurance_policy'];
                        $pathToFile      = $this->telehealth_certificate_base_path.$file_name;

                        $file_exits      = file_exists($pathToFile);
                        if($file_exits)
                        {
                           //ob_end_clean(); //clear the buffer memory before download file
                           return response()->download($pathToFile, $file_name); 
                        }
                        else
                        {
                           Flash::error("Error while downloading an document.");
                        }
              }
              else if($type=='drivers_licence')
              {
                        $file_name          = $arr_certificate['upload_drivers_licence'];
                        $pathToFile         = $this->driver_licence_base_path.$file_name;

                        $file_exits         = file_exists($pathToFile);
                        if($file_exits)
                        {
                           //ob_end_clean(); //clear the buffer memory before download file
                           return response()->download($pathToFile, $file_name); 
                        }
                        else
                        {
                           Flash::error("Error while downloading an document.");
                        }
              }
        
        }
        return redirect()->back();
    }



    /*
    | Function  : Doctor verification by admin
    | Author    : Deepak Arvind Salunke
    | Date      : 25/09/2017
    | Output    : Success or Error
    */

    public function admin_verified_mini($enc_id = FALSE)
    {
        if($enc_id != "")
        {
            $user_id = base64_decode($enc_id);

            $update_arr = array('admin_verification_status_mini' => '1',
                                'verification_status'            => '1',
                                //'user_status'                    => 'Active',
                                'token'                          => '');

            $user = Sentinel::findById($user_id);
                     
            $resUser = $this->UserModel->where('id',$user_id)->update($update_arr);

            if($resUser)
            {

                /*$activation_link    ='<a class="btn_emailer_cls" href="'.url('/doctor/signup/step1/'.base64_encode($user->id)).'"> Sign-up Now </a>';
                $arr_built_content = [ 
                                        'FIRST_NAME' => $user->first_name,
                                        'APP_NAME' => config('app.project.name'),
                                        'ACTIVATION_LINK' => $activation_link,
                                     ];

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '44';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $user;
                $email_status  = $this->EmailService->send_mail($arr_mail_data);*/


                /* -- send mail to client -- */
                /* content variables in view */
                $content['activation_link']     = '<a class="btn_emailer_cls" href="'.url('/doctor/signup/step1/'.base64_encode($user->id)).'"> Click here to complete registration </a>';
                $content['first_name']          = $user['first_name'];
                $content['last_name']           = $user['last_name'];
                $content['email']               = $user['email'];
                /* end content variables in view */


                /* built content variables in view */
                $content             =  view('front.email.doctor_signup_verify',compact('content'))->render();
                $content             =  html_entity_decode($content);
                /* end built content variables in view */
               
                $to_email_id         = $user['email'];
                $project_name        = config('app.project.name');
                $mail_subject        = config('app.project.name').' - Application successfully reviewed';


                /* get admin email */
                    $get_admin       = $this->AdminProfileModel->first();
                    $get_admin       = $get_admin->toArray();
                    $mail_form       = $get_admin['contact_email'];
                /* end get admin email */    

                if(!empty($mail_form))
                {
                    $mail_form           = $mail_form;
                }
                else{
                    $mail_form           = config('app.project.admin_email');
                }
                $mail_form               = $mail_form;

                $send_mail = Mail::send(array(), array(), function ($message) use ($to_email_id, $mail_form, $project_name, $mail_subject, $content) {
                      $message->from($mail_form, $project_name);
                      $message->to($to_email_id)
                      ->subject($mail_subject)
                      ->setBody($content, 'text/html');
                });
                /* -- end  mail to client-- */

                Flash::success('Doctor verification completed successfully.');

            }
            else
            {
                Flash::error('Error, while doctor verification.');
            }      
                  
        
        }   
        return redirect()->back();
    } // end admin_verified_mini



    /*
    | Function  : Doctor verification by admin
    | Author    : Deepak Arvind Salunke
    | Date      : 25/09/2017
    | Output    : Success or Error
    */

    public function admin_verified_main($enc_id = FALSE)
    {
        if($enc_id != "")
        {
            $user_id = base64_decode($enc_id);

            $update_arr = array('admin_verification_status_main' => '1',
                                'user_status'                    => 'Active',
                                'token'                          => '');

            $user = Sentinel::findById($user_id);
                     
            $resUser = $this->UserModel->where('id',$user_id)->update($update_arr);

            if($resUser)
            {

                $activation_link    ='<a class="btn_emailer_cls" href="'.url('/doctor/signup/step1/'.base64_encode($user->id)).'"> Sign-up Now </a>';
                $arr_built_content = [ 
                                        'FIRST_NAME' => $user->first_name,
                                        'APP_NAME' => config('app.project.name'),
                                        'ACTIVATION_LINK' => $activation_link,
                                     ];

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '44';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $user;
                $email_status  = $this->EmailService->send_mail($arr_mail_data);

                Flash::success('Doctor verification completed successfully.');
            }
            else
            {
                Flash::error('Error, while doctor verification.');
            }      
                  
        
        }   
        return redirect()->back();
    } // end admin_verified_main


    public function show($enc_id=null)
    {
        $data=[];
        if($enc_id)
        {
            $id  = base64_decode($enc_id);
            $information =    $this->DoctorModel->where('user_id',$id)->with('userinfo','doctor_refernces','doctor_timezone','mobile_country_code')->first(); 
            if($information)
            {
                $data = $information->toArray();
            }   
            $obj_language = $this->LanguageModel->get();
            if($obj_language)
            {
                $arr_language = $obj_language->toArray();
            }
            $obj_timezone = $this->TimezoneModel->get();
            if($obj_timezone)
            {
                $arr_timezone = $obj_timezone->toArray();
            }

            $obj_prefix  = $this->PrefixModel->get();
            if($obj_prefix)
            {
                 $arr_prefix = $obj_prefix->toArray();
            }
/*             $date           = new DateTime("now");
                $is_dst       = intval(date_format($date, "I"));
                if($is_dst==0)
                {
                    
                        foreach($arr_timezone as $key =>$timezone)
                        {
                            $arr_timezone_dst[$key]['id']            = $timezone['id'];
                            $arr_timezone_dst[$key]['time']          = $timezone['standard_time'];
                        }
                }
                else
                {

                foreach ($arr_timezone as $key => $timezone) 
                {
                    if($timezone['summer_time']=='')
                    {
                        $arr_timezone_dst[$key]['id']            = $timezone['id'];
                        $arr_timezone_dst[$key]['time']          = $timezone['standard_time'];
                    }
                    else
                    {
                        $arr_timezone_dst[$key]['id']            = $timezone['id'];
                        $arr_timezone_dst[$key]['time']          = $timezone['summer_time'];
                    }
                }
              }*/
             
            $this->arr_view_data['doc_video_public']         = $this->doc_video_public;
            $this->arr_view_data['doc_video']                = $this->doc_video;
            $this->arr_view_data['doc_profile_public']       = $this->doc_profile_public;
            $this->arr_view_data['doc_profile_pic']          = $this->doc_profile_pic;
            $this->arr_view_data['doc_ins_pol_public']       = $this->doc_ins_pol_public;
            $this->arr_view_data['doc_med_reg_public']       = $this->doc_med_reg_public;
            $this->arr_view_data['doc_id_proof_public']      = $this->doc_id_proof_public;
            $this->arr_view_data['doc_id_proof']             = $this->doc_id_proof;
            $this->arr_view_data['doc_med_reg']              = $this->doc_med_reg;
            $this->arr_view_data['doc_ins_pol']              = $this->doc_ins_pol;
            $this->arr_view_data['doc_cyb_liabl']            = $this->doc_cyb_liabl;
            $this->arr_view_data['doc_cyb_liabl_public']     = $this->doc_cyb_liabl_public;

            $this->arr_view_data['data_info']                = $data;
            $this->arr_view_data['arr_language']             = $arr_language;
            $this->arr_view_data['arr_prefix']               = $arr_prefix;
            $this->arr_view_data['video_base_path']          = $this->video_base_path;
            $this->arr_view_data['video_public_path']        = $this->video_public_path;
            $this->arr_view_data['enc_id']                   = $enc_id;
            $this->arr_view_data['page_title']               = 'Doctor Details';
            $this->arr_view_data['module_url_path']          = $this->module_url_path;
            $this->arr_view_data['module_title']             = str_singular($this->module_title);

            return view($this->module_view_folder.'/show',$this->arr_view_data);     
        }

        return redirect()->back();
    }


    public function show_fee_schedule($enc_id=null)
    {
        $data = [];
        if($enc_id)
        {
            $id  = base64_decode($enc_id);
            
            $get_fee_schedule = $this->DoctorFeeModel->where('doctor_id', $id)->orderBy('id','DESC')->get();
            if($get_fee_schedule)
            {
                $this->arr_view_data['fee_schedule'] = $get_fee_schedule->toArray();
            }

            $this->arr_view_data['enc_id']                   = $enc_id;
            $this->arr_view_data['page_title']               = 'Doctor Fee Schedule';
            $this->arr_view_data['module_url_path']          = $this->module_url_path;
            $this->arr_view_data['module_title']             = str_singular($this->module_title);

            return view($this->module_view_folder.'/show_fee_schedule',$this->arr_view_data);     
        }

        return redirect()->back();
    }

    /*======================End==========================================================*/    
}   
