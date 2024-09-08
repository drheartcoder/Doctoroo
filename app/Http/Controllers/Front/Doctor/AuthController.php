<?php

namespace App\Http\Controllers\Front\Doctor;

use App\Http\Requests;
use Illuminate\Http\Request;

use Twilio\Rest\Client;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;
use App\Common\Services\VirgilService;

use App\Models\UserModel;
use App\Models\SpecialityModel;
use App\Models\LanguageModel;
use App\Models\DoctorModel;
use App\Models\PrefixModel;
use App\Models\TimezonesModel;
use App\Models\TimezoneModel;
use App\Models\OtpModel;
use App\Models\MobileCountryCodeModel;
use App\Models\MembershipPaymentModel;
use App\Models\DoctroFeesModel;
use App\Models\DoctorPremiumRateModel;
use App\Models\PatientModel;
use App\Models\AdminProfileModel;
use App\Models\ChangeMobileNoModel;
use App\Models\AdminNotificationModel;

use Validator;
use Flash;
use Sentinel;
use Activation;
use Session;
use Image;
use URL;
use Exception;
use Mail;
use Response;

class AuthController extends Controller
{

    public function __construct(UserModel                   $UserModel,
                                 SpecialityModel            $SpecialityModel,
                                 LanguageModel              $LanguageModel,
                                 DoctorModel                $DoctorModel,
                                 EmailService               $email_service,
                                 VirgilService              $virgil_service,
                                 PrefixModel                $PrefixModel,
                                 TimezonesModel             $TimezonesModel,
                                 TimezoneModel              $TimezoneModel,
                                 OtpModel                   $OtpModel,
                                 MobileCountryCodeModel     $mob_country_code,
                                 DoctroFeesModel            $DoctroFeesModel,
                                 MembershipPaymentModel     $MembershipPaymentModel,
                                 DoctorPremiumRateModel     $DoctorPremiumRateModel,
                                 PatientModel               $PatientModel,
                                 AdminProfileModel          $AdminProfileModel,
                                 ChangeMobileNoModel        $ChangeMobileNoModel,
                                 AdminNotificationModel     $AdminNotificationModel)
    {	

    	$this->arr_view_data[]         =   [];
        $this->module_title            =   "Doctor";
    	$this->module_view_folder      =   'front.doctor';
        $this->module_url_path         =   url('/').'/doctor';
        $this->doctor_image_url        =   url('/public').config('app.project.img_path.doctor_image');

        $this->doc_profile_public      =   public_path().config('app.project.img_path.doctor_image');
        $this->doc_profile_pic         =   url('/public').config('app.project.img_path.doctor_image');
        $this->doc_video_public        =   public_path().config('app.project.img_path.doctor_video');
        $this->doc_video               =   url('/public').config('app.project.img_path.doctor_video');
        $this->doc_id_proof_public     =   public_path().config('app.project.img_path.doctor_id_proof');
        $this->doc_id_proof            =   url('/public').config('app.project.img_path.doctor_id_proof');
        $this->doc_med_reg_public      =   public_path().config('app.project.img_path.medical_registration');
        $this->doc_med_reg             =   url('/public').config('app.project.img_path.medical_registration');
        $this->doc_ins_pol_public      =   public_path().config('app.project.img_path.insurance_policy');
        $this->doc_ins_pol             =   url('/public').config('app.project.img_path.insurance_policy');
        $this->doc_cyb_liabl_public    =   public_path().config('app.project.img_path.cyber_liability');
        $this->doc_cyb_liabl           =   url('/public').config('app.project.img_path.cyber_liability');

        $this->UserModel               =   $UserModel;
        $this->SpecialityModel         =   $SpecialityModel;
        $this->LanguageModel           =   $LanguageModel;
        $this->DoctorModel             =   $DoctorModel;
        $this->EmailService            =   $email_service;
        $this->VirgilService           =   $virgil_service;
        $this->PrefixModel             =   $PrefixModel;
        $this->TimezonesModel          =   $TimezonesModel;
        $this->TimezoneModel           =   $TimezoneModel;
        $this->OtpModel                =   $OtpModel;
        $this->MobileCountryCodeModel  =   $mob_country_code;
        $this->MembershipPaymentModel  =   $MembershipPaymentModel;
        $this->PatientModel            =   $PatientModel;
        $this->DoctorPremiumRateModel  =   $DoctorPremiumRateModel;
        $this->DoctroFeesModel         =   $DoctroFeesModel;
        $this->AdminProfileModel       =   $AdminProfileModel;
        $this->ChangeMobileNoModel     =   $ChangeMobileNoModel;
        $this->AdminNotificationModel  =   $AdminNotificationModel;

        $this->sid                     = config('services.twilio')['accountSid'];
        $this->token                   = config('services.twilio')['auth_token'];
        $this->service_id              = config('services.twilio')['service_id'];
        $this->client                  = new Client($this->sid,$this->token);

    }	

    public function index()
    {
    	$arr_speciality = array();
        $speciality_arr = $this->SpecialityModel->where('speciality_status','Active')->get();
        if($speciality_arr)
        {
            $arr_speciality = $speciality_arr->toArray();
        }

        $language_arr = $this->LanguageModel->where('language_status','1')->where('user_id','0')->orderBy('language','ASC')->get();
        if($language_arr)
        {
            $arr_language = $language_arr->toArray();
        }

        $get_mob_code = $this->MobileCountryCodeModel->get();
        if($get_mob_code)
        {
            $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
        }

        $this->arr_view_data['user_type']      = 'doctor';
        $this->arr_view_data['arr_speciality'] = $arr_speciality;
        $this->arr_view_data['arr_language']   = $arr_language;
        $this->arr_view_data['page_title']     = $this->module_title;

        // for seo 
        $this->arr_view_data['title']               = "Diet Doctor, City Doctors, Phone doctor, Home Doctor, After Hours Doctor";
        $this->arr_view_data['keyword']             = "Diet Doctor, City Doctors, Phone doctor, Home Doctor, After Hours Doctor";
        $this->arr_view_data['description']         = "Doctoroo provides a Diet Doctor, City Doctors, Phone doctor, Home Doctor, After Hours Doctor to book dr online for quick consultation. Dial a doctor anywhere & anytime.";
        return view($this->module_view_folder.'.doctor_business',$this->arr_view_data);
    }

    public function duplicate(Request $request)
    {
        $email_id = $request->input('email_id');
        if($email_id)
        {
            $num = $this->UserModel->where('email',$email_id)->withTrashed()->count();
            if($num > 0)
            {
                return Response::json('error');
            }
            else
            {
                return Response::json('success');
            }
        }
    }

     public function duplicate_mobile_no_check(Request $request)
    {
         $count = $this->DoctorModel->where('mobile_no' ,$request->mobile_no)->count();
          if($count > 0)
          {
             $arr_response['status'] = 'error';
          }                            
          else
          {
            $arr_response['status'] = 'success';
          }  

          return response()->json($arr_response);
    }

    /*
    | Function  : Doctor signup step1
    | Author    : Deepak Arvind Salunke
    | Date      : 04/08/2017
    | Output    : show the signup step1 page
    */

    public function signup_step1(Request $request, $enc_id)
    {
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {
            $prev_url = URL::previous();
            if(isset($prev_url) && !empty($prev_url))
            {
                $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

                if($pageWasRefreshed )
                {

                }
                else {
                    $url = explode("/",$prev_url);
                    $page = isset($url[count($url)-2]) ? $url[count($url)-2] : '';
                    if( $page == 'step2' || $page == 'step3'|| $page == 'step4' || $page == 'step5')
                    {

                    }
                    else
                    {
                        Session::forget('doctor_signup');  
                    }
                }    
            }

            $get_doctor_data = $this->DoctorModel->where('user_id',$doctor_id)->with('userinfo')->first();
            if($get_doctor_data)
            {
                $this->arr_view_data['exists_doctor_data'] = $get_doctor_data->toArray();
            }

            $get_pre = $this->PrefixModel->orderBy('name', 'ASC')->get();
            if($get_pre)
            {
                $this->arr_view_data['prefix_data'] = $get_pre->toArray();
            }
            
            //For International timezone 
            /*$get_timezone = $this->TimezonesModel->get();
            if($get_timezone)
            {
                $this->arr_view_data['timezone_data'] = $get_timezone->toArray();
            }*/

            //For australia timezone
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

            $this->arr_view_data['enc_doctor_id']             = $enc_id;
            $this->arr_view_data['page_title']                = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']           = $this->module_url_path;

            return view($this->module_view_folder.'.signup_step1',$this->arr_view_data);

        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }
    } // end signup_step1

    /*
    | Function  : Store step1 data in session
    | Author    : Deepak Arvind Salunke
    | Date      : 04/08/2017
    | Output    : redirect to signup step2 page
    */

    public function store_step1(Request $request, $enc_id)
    {
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {
            $arr_rules['first_name']    =   "required";
            $arr_rules['last_name']     =   "required";
            $arr_rules['title']         =   "required";
            $arr_rules['gender']        =   "required";
            $arr_rules['datebirth']     =   "required";
            $arr_rules['citizenship']   =   "required";
            
            $arr_rules['password']      =   "required";
            //$arr_rules['contact_no']    =   "required";
            //$arr_rules['mobile_no_code']=   "required";
            $arr_rules['mobile_no']     =   "required";
            $arr_rules['address']       =   "required";
            $arr_rules['timezone']      =   "required";

            /* Encrypted filed Validation */
            /*$arr_rules['enc_first_name']  =   "required";
            $arr_rules['enc_last_name']   =   "required";*/
            //$arr_rules['enc_mobile_no']   =   "required";
            $arr_rules['enc_address']     =   "required";

            if(Session::has('doctor_signup.step1'))
            {
                Session::forget('doctor_signup.step1');
            }

            Session::put(array('doctor_signup.step1' => array(
                                                 'first_name'           => ucwords(strtolower($request->input('first_name'))),
                                                 'last_name'            => ucwords(strtolower($request->input('last_name'))),
                                                 'title'                => $request->input('title'),
                                                 'gender'               => $request->input('gender'),
                                                 'datebirth_submit'     => $request->input('datebirth_submit'),
                                                 'citizenship'          => $request->input('citizenship'),
                                                 'email'                => $doctor->email,
                                                 'password'             => $request->input('password'),
                                                 'contact_no'           => $request->input('enc_contact_no'),
                                                 'mobile_no_code'       => $request->input('mobile_no_code'),
                                                 'mobile_no'            => encrypt_value($request->input('mobile_no')),
                                                 'address'              => $request->input('enc_address'),
                                                 'timezone'             => $request->input('timezone'),
                                                 'abn'                  => $request->input('abn')
                        )      )                 );

            $validator  =   Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                return back()->withInput($request->all())->withErrors($validator);
            }

            /*$num = $this->UserModel->where('email',$doctor->email)->count();
            if($num > 0)
            {
                Session::flash('msg','Email id already exist.');
                return back()->withInput($request->all())->withErrors($validator);
            }*/

            $count = $this->DoctorModel->where('mobile_no' ,$request->input('mobile_no'))->count();
            if($count > 0)
            {
                $same_user = $this->DoctorModel->where('user_id', $doctor_id)
                							   ->where('mobile_no' ,$request->input('mobile_no'))
                							   ->count();
         		if($same_user > 0)
         		{

         		}
         		else
         		{
         			Session::flash('mobile_error_msg','This mobile number is already registered ! try another.');
                    return back()->withInput($request->all())->withErrors($validator);
         		}
            }

            return redirect(url('').'/doctor/signup/step2/'.$enc_id);
        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }

    } // end store_step1

    /*
    | Function  : Doctor signup step2
    | Author    : Deepak Arvind Salunke
    | Date      : 04/08/2017
    | Output    : show the signup step2 page
    */

    public function signup_step2(Request $request, $enc_id)
    {
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {
            $prev_url = URL::previous();
            if(isset($prev_url) && !empty($prev_url))
            {
                $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

                if($pageWasRefreshed )
                {

                }
                else
                {
                    $url = explode("/",$prev_url);
                    $page = isset($url[count($url)-2]) ? $url[count($url)-2] : '';
                
                    if( $page == 'step1' || $page == 'step3'|| $page == 'step4' || $page == 'step5')
                    {

                    }
                    else
                    {
                        Session::forget('doctor_signup');        
                    }
                }
            }

            if(empty(Session::get('doctor_signup.step1')) && Session::get('doctor_signup.step1') == null)
            {
                return redirect(url('').'/doctor/signup/step1/'.$enc_id);
            }
            
            $get_language = $this->LanguageModel->where('language_status','1')->where('user_id','0')->orderBy('language','ASC')->get();
            if($get_language)
            {
                $this->arr_view_data['language_data'] = $get_language->toArray();
            }

            $get_mob_code = $this->MobileCountryCodeModel->get();
            if($get_mob_code)
            {
                $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
            }

            $get_doctor_data = $this->DoctorModel->where('user_id',$doctor_id)->with('userinfo')->first();
            if($get_doctor_data)
            {
                $this->arr_view_data['exists_doctor_data'] = $get_doctor_data->toArray();
            }

            $this->arr_view_data['enc_id']                    = $enc_id;
            $this->arr_view_data['page_title']                = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']           = $this->module_url_path;

            return view($this->module_view_folder.'.signup_step2',$this->arr_view_data);
        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }

    } // end signup_step2

    /*
    | Function  : Store step2 data in session
    | Author    : Deepak Arvind Salunke
    | Date      : 04/08/2017
    | Output    : redirect to signup step3 page
    */

    public function store_step2(Request $request, $enc_id)
    {
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {

               /* $arr_rules['clinic_name']       =   "required";
                $arr_rules['clinic_address']    =   "required";
                $arr_rules['clinic_email']      =   "required|email";*/
                $arr_rules['experience']        =   "required";
                $arr_rules['language']          =   "required";

                /* Encryption Files*/
                /*$arr_rules['enc_clinic_address']    =   "required";
                $arr_rules['enc_clinic_email']      =   "required";*/
                $arr_rules['enc_clinic_contact_no'] =   "required";
                $arr_rules['enc_clinic_mobile_no']  =   "required";
                
                $other_languages =[];

                $validator  =   Validator::make($request->all(),$arr_rules);
                if($validator->fails())
                {
                    return back()->withInput($request->all())->withErrors($validator);
                }

                /*$num    =   $this->UserModel->where('email',$request->input('email'))->count();
                if($num > 0)
                {
                    Session::flash('msg','Email id already exist.');
                    return back()->withInput($request->all())->withErrors($validator);
                }*/

                if(empty(Session::get('doctor_signup.step1')) && Session::get('doctor_signup.step1') == null)
                {
                    return redirect(url('').'/doctor/signup/step1/'.$enc_id);
                }
                if(Session::has('doctor_signup.step2'))
                {
                    Session::forget('doctor_signup.step2');
                }

                if(!empty($request->input('other_languages')))
                {

                        Session::put('other_languages_session',$request->input('other_languages'));
                        $data=[];
                        $other_language_id = [];
                        if(!empty($request->input('multi_languages')))
                        {
                          $multi_languages  = explode(',', $request->input('multi_languages'));
                        }
                        $other_languages  = explode(',', $request->input('other_languages'));

                          if(isset($other_languages)){
                            foreach($other_languages as $other_lan){


                                 $getExist = \DB::table('dod_language')->where('user_id',$doctor_id)->where('language',ucfirst($other_lan))->first();
                                 if(count($getExist) > 0){
                                    $other_language_id[] = $getExist->id;
                                 }
                                 else{
                                    if($other_lan != ""){
                                         $data['user_id']         = $doctor_id;
                                         $data['language']        = ucfirst($other_lan);
                                         $data['language_status'] = '1';
                                         $other_language_id[] = \DB::table('dod_language')->insertGetId($data);
                                     }
                                 }

                            }      
                        }
                        $lang_string = implode(",", array_merge($multi_languages, $other_language_id)); 
                        $multi_languages = str_replace("Other,","",$lang_string);
                        Session::put('other_lan','yes');
                }
                else{
                   $multi_languages =  $request->input('multi_languages');

                    Session::forget('other_lan');
                    Session::forget('other_languages_session');
                }
                
                $step2 = array(
                            'clinic_name'           => $request->input('clinic_name'),
                            'clinic_address'        => $request->input('enc_clinic_address'),
                            'clinic_email'          => $request->input('enc_clinic_email'),
                            'clinic_contact_no'     => $request->input('enc_clinic_contact_no'),
                            'clinic_mobile_no_code' => $request->input('clinic_mobile_no_code'),
                            'clinic_mobile_no'      => $request->input('enc_clinic_mobile_no'),
                            'experience'            => $request->input('experience'),
                            'language'              => $multi_languages,
                        );

                Session::put('doctor_signup', array_add($doctor_signup = Session::get('doctor_signup'), 'step2', $step2));
                return redirect(url('').'/doctor/signup/step3/'.$enc_id);

        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }


    } // end store_step2

    /*
    | Function  : Doctor signup step3
    | Author    : Deepak Arvind Salunke
    | Date      : 04/08/2017
    | Output    : show the signup step3 page
    */

    public function signup_step3(Request $request, $enc_id)
    {
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {

                $prev_url = URL::previous();
                if(isset($prev_url) && !empty($prev_url))
                {
                    $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

                    if($pageWasRefreshed )
                    {

                    }
                    else
                    {
                       
                        $url = explode("/",$prev_url);
                        $page = isset($url[count($url)-2]) ? $url[count($url)-2] : '';
                    
                        if( $page == 'step1' || $page == 'step2'|| $page == 'step4' || $page == 'step5')
                        {

                        }
                        else
                        {
                            Session::forget('doctor_signup');        
                        }
                    }
                        
                }

                if(empty(Session::get('doctor_signup.step1')) && Session::get('doctor_signup.step1') == null)
                {
                    return redirect(url('').'/doctor/signup/step1/'.$enc_id);
                }
                if(empty(Session::get('doctor_signup.step2')) && Session::get('doctor_signup.step2') == null)
                {         
                    return redirect(url('').'/doctor/signup/step2/'.$enc_id);
                }

                $get_doctor_data = $this->DoctorModel->where('user_id',$doctor_id)->with('userinfo')->first();
                if($get_doctor_data)
                {
                    $this->arr_view_data['exists_doctor_data'] = $get_doctor_data->toArray();
                }

                $this->arr_view_data['page_title']                = str_singular($this->module_title);
                $this->arr_view_data['enc_id']                    = $enc_id;
                $this->arr_view_data['module_url_path']           = $this->module_url_path;

                return view($this->module_view_folder.'.signup_step3',$this->arr_view_data);
        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }


    } // end signup_step3

    /*
    | Function  : Store step3 data in session
    | Author    : Deepak Arvind Salunke
    | Date      : 05/08/2017
    | Output    : redirect to signup step4 page
    */

    public function store_step3(Request $request, $enc_id)
    {
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {
                $arr_rules['medical_qualification']     =   "required";
                $arr_rules['medical_school']            =   "required";
                $arr_rules['year_obtained']             =   "required";
                $arr_rules['country_obtained']          =   "required";
                /*$arr_rules['bank_account_name']         =   "required";
                $arr_rules['bsb']                       =   "required";
                $arr_rules['account_number']            =   "required";*/
                /* Encryption Fileds */
                $arr_rules['enc_medical_qualification'] =   "required";
                /*$arr_rules['enc_bank_account_name']     =   "required";
                $arr_rules['enc_bsb']                   =   "required";
                $arr_rules['enc_account_number']        =   "required";*/

                $validator  =   Validator::make($request->all(),$arr_rules);
                if($validator->fails())
                {
                    return back()->withInput($request->all())->withErrors($validator);
                }

                if(empty(Session::get('doctor_signup.step1')) && Session::get('doctor_signup.step1') == null)
                {
                    return redirect(url('').'/doctor/signup/step1/'.$enc_id);
                }
                if(empty(Session::get('doctor_signup.step2')) && Session::get('doctor_signup.step2') == null)
                {         
                    return redirect(url('').'/doctor/signup/step2/'.$enc_id);
                }

                if(Session::has('doctor_signup.step3'))
                {
                    Session::forget('doctor_signup.step3');
                }

                $step3 = array(
                             'medical_qualification'        => $request->input('enc_medical_qualification'),
                             'medical_school'               => $request->input('medical_school'),
                             'year_obtained'                => $request->input('year_obtained'),
                             'country_obtained'             => $request->input('country_obtained'),
                             'other_qualifications'         => $request->input('other_qualifications'),
                             'bank_account_name'            => $request->input('enc_bank_account_name'),
                             'bsb'                          => $request->input('enc_bsb'),
                             'account_number'               => $request->input('enc_account_number'),
                              );

                Session::put('doctor_signup', array_add($doctor_signup = Session::get('doctor_signup'), 'step3', $step3));

                return redirect(url('').'/doctor/signup/step4/'.$enc_id);
        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }

    } // end store_step3


    /*
    | Function  : Doctor signup step4
    | Author    : Deepak Arvind Salunke
    | Date      : 05/08/2017
    | Output    : show the signup step4 page
    */

    public function signup_step4(Request $request, $enc_id)
    {
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {
                $prev_url = URL::previous();

                if(isset($prev_url) && !empty($prev_url))
                {
                    $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

                    if($pageWasRefreshed )
                    {

                    }
                    else {
                       
                        $url = explode("/",$prev_url);
                        $page = isset($url[count($url)-2]) ? $url[count($url)-2] : '';
                        
                        if( $page == 'step1' || $page == 'step2'|| $page == 'step3' || $page == 'step5')
                        {
                            
                        }
                        else
                        {
                            Session::forget('doctor_signup');        
                        }
                    }
                }

                if(empty(Session::get('doctor_signup.step1')) && Session::get('doctor_signup.step1') == null)
                {
                    return redirect(url('').'/doctor/signup/step1/'.$enc_id);
                }
                if(empty(Session::get('doctor_signup.step2')) && Session::get('doctor_signup.step2') == null)
                {         
                    return redirect(url('').'/doctor/signup/step2/'.$enc_id);
                }
                if(empty(Session::get('doctor_signup.step3')) && Session::get('doctor_signup.step3') == null)
                {         
                    return redirect(url('').'/doctor/signup/step3/'.$enc_id);
                }

                $get_doctor_data = $this->DoctorModel->where('user_id',$doctor_id)->with('userinfo')->first();
                if($get_doctor_data)
                {
                    $this->arr_view_data['exists_doctor_data'] = $get_doctor_data->toArray();
                }

                $this->arr_view_data['page_title']                = str_singular($this->module_title);
                $this->arr_view_data['enc_id']                    = $enc_id;
                $this->arr_view_data['module_url_path']           = $this->module_url_path;

                return view($this->module_view_folder.'.signup_step4',$this->arr_view_data);
        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }


    } // end signup_step4

    /*
    | Function  : Store step3 data in session
    | Author    : Deepak Arvind Salunke
    | Date      : 05/08/2017
    | Output    : redirect to signup step4 page
    */

    public function store_step4(Request $request, $enc_id)
    {
        // /dd($request->all());
        $arr_response = [];
        $arr_response['status']   = 'fail';
        $arr_response['redirect'] = url("/").'/doctor/signup/step4/'.$enc_id;
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {
            if(empty(Session::get('doctor_signup.step1')) && Session::get('doctor_signup.step1') == null)
            {
                $arr_response['redirect'] = url("/").'/doctor/signup/step1/'.$enc_id;
                return response()->json($arr_response);
            }
            if(empty(Session::get('doctor_signup.step2')) && Session::get('doctor_signup.step2') == null)
            {         
                $arr_response['redirect'] = url("/").'/doctor/signup/step2/'.$enc_id;
                return response()->json($arr_response);
            }
            if(empty(Session::get('doctor_signup.step3')) && Session::get('doctor_signup.step3') == null)
            {         
                $arr_response['redirect'] = url("/").'/doctor/signup/step3/'.$enc_id;
                return response()->json($arr_response);
            }

            $id_proof_file_name                 = "";
            $medical_registration_file_name     = "";
            $pi_insurance_policy_file_name      = "";
            $cyber_liability_file_name          = "";
            
            // upload id proof
            if($request->hasFile('id_proof_file'))
            {
                $id_proof_file   =   $request->file('id_proof_file');

                if(isset($id_proof_file) && sizeof($id_proof_file)>0)
                {
                    $extention  =   strtolower($id_proof_file->getClientOriginalExtension());
                    $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                    if(!in_array($extention, $valid_ext))
                    {
                        Session::flash('id_proof_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                        return response()->json($arr_response);
                    }
                    else if($id_proof_file->getClientSize() > 5000000)
                    {
                        Session::flash('id_proof_error','Please upload image/document with small size. Max size allowed is 5mb');
                        return response()->json($arr_response);
                    }
                    else
                    {
                        @unlink($this->doc_id_proof.$request->input('old_id_proof_file'));
                        $id_proof_file_name      = $request->file('id_proof_file');
                        $id_proof_file_extension = strtolower($request->file('id_proof_file')->getClientOriginalExtension()); 
                        $id_proof_file_name      = sha1(uniqid().$id_proof_file_name.uniqid()).'.'.$id_proof_file_extension;
                        $id_proof_upload_result  = $request->file('id_proof_file')->move($this->doc_id_proof_public, $id_proof_file_name);
                    }
                }
                else
                {
                    Session::flash('id_proof_error','Please upload valid image/document.');
                    return response()->json($arr_response);
                }
            }

            // upload medical registration certificate
            if($request->hasFile('medical_registration_certificate_file'))
            {
                $medical_registration_certificate_file   =   $request->file('medical_registration_certificate_file');

                if(isset($medical_registration_certificate_file) && sizeof($medical_registration_certificate_file)>0)
                {
                    $extention  =   strtolower($medical_registration_certificate_file->getClientOriginalExtension());
                    $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                    if(!in_array($extention, $valid_ext))
                    {
                        Session::flash('medical_registration_certificate_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                        return response()->json($arr_response);
                    }
                    else if($medical_registration_certificate_file->getClientSize() > 5000000)
                    {
                        Session::flash('medical_registration_certificate_error','Please upload image/document with small size. Max size allowed is 5mb');
                        return response()->json($arr_response);
                    }
                    else
                    {
                        @unlink($this->doc_med_reg.$request->input('old_medical_registration_certificate_file'));
                        $medical_registration_file_name     = $request->file('medical_registration_certificate_file');
                        $med_reg_file_extension             = strtolower($request->file('medical_registration_certificate_file')->getClientOriginalExtension()); 
                        $medical_registration_file_name     = sha1(uniqid().$medical_registration_file_name.uniqid()).'.'.$med_reg_file_extension;
                        $med_reg_upload_result              = $request->file('medical_registration_certificate_file')->move($this->doc_med_reg_public, $medical_registration_file_name);
                    }
                }
                else
                {
                    Session::flash('medical_registration_certificate_error','Please upload valid image/document.');
                    return response()->json($arr_response);
                }
            }

            // upload insurance policy
            if($request->hasFile('pi_insurance_policy_file'))
            {
                $pi_insurance_policy_file   =   $request->file('pi_insurance_policy_file');

                if(isset($pi_insurance_policy_file) && sizeof($pi_insurance_policy_file)>0)
                {
                    $extention  =   strtolower($pi_insurance_policy_file->getClientOriginalExtension());
                    $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                    if(!in_array($extention, $valid_ext))
                    {
                        Session::flash('pi_insurance_policy_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                        return response()->json($arr_response);
                    }
                    else if($pi_insurance_policy_file->getClientSize() > 5000000)
                    {
                        Session::flash('pi_insurance_policy_error','Please upload image/document with small size. Max size allowed is 5mb');
                        return response()->json($arr_response);
                    }
                    else
                    {
                        @unlink($this->doc_ins_pol.$request->input('old_pi_insurance_policy_file'));
                        $pi_insurance_policy_file_name      = $request->file('pi_insurance_policy_file');
                        $insurance_policy_file_extension    = strtolower($request->file('pi_insurance_policy_file')->getClientOriginalExtension()); 
                        $pi_insurance_policy_file_name      = sha1(uniqid().$pi_insurance_policy_file_name.uniqid()).'.'.$insurance_policy_file_extension;
                        $insurance_policy_upload_result     = $request->file('pi_insurance_policy_file')->move($this->doc_ins_pol_public, $pi_insurance_policy_file_name);
                    }
                }
                else
                {
                    Session::flash('pi_insurance_policy_error','Please upload valid image/document.');
                    return response()->json($arr_response);
                }
            }

            // upload cyber liability
            if($request->hasFile('cyber_liability_file'))
            {
                $cyber_liability_file   =   $request->file('cyber_liability_file');

                if(isset($cyber_liability_file) && sizeof($cyber_liability_file) > 0)
                {
                    $extention  =   strtolower($cyber_liability_file->getClientOriginalExtension());
                    $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                    if(!in_array($extention, $valid_ext))
                    {
                        Session::flash('cyber_liability_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                        return response()->json($arr_response);
                    }
                    else if($cyber_liability_file->getClientSize() > 5000000)
                    {
                        Session::flash('cyber_liability_error','Please upload image/document with small size. Max size allowed is 5mb');
                        return response()->json($arr_response);
                    }
                    else
                    {
                        @unlink($this->doc_cyb_liabl.$request->input('old_cyber_liability_file'));
                        $cyber_liability_file_name      = $request->file('cyber_liability_file');
                        $cyber_liability_file_extension = strtolower($request->file('cyber_liability_file')->getClientOriginalExtension()); 
                        $cyber_liability_file_name      = sha1(uniqid().$cyber_liability_file_name.uniqid()).'.'.$cyber_liability_file_extension;
                        $cyber_liability_upload_result  = $request->file('cyber_liability_file')->move($this->doc_cyb_liabl_public, $cyber_liability_file_name);
                    }
                }
                else
                {
                    Session::flash('cyber_liability_error','Please upload valid image/document.');
                    return response()->json($arr_response);
                }
            }

            if(empty(Session::get('doctor_signup.step1')) && Session::get('doctor_signup.step1') == null)
            {
                return response()->json($arr_response);
            }

            if(Session::has('doctor_signup.step4'))
            {
                Session::forget('doctor_signup.step4');
            }

            $step4 = array(
                         'id_proof_file'                        => $id_proof_file_name,
                         'medical_registration_no'              => $request->input('enc_medical_registration_no'),
                         'medical_registration_certificate'     => $medical_registration_file_name,
                         'medicare_provider_no'                 => $request->input('enc_medicare_provider_no'),
                         'prescriber_no'                        => $request->input('enc_prescriber_no'),
                         'ahpra_registration_no'                => $request->input('enc_ahpra_registration_no'),
                         'pi_insurance_policy'                  => $pi_insurance_policy_file_name,
                         'cyber_liability_insurance_policy'     => $cyber_liability_file_name,
                          );

            Session::put('doctor_signup', array_add($doctor_signup = Session::get('doctor_signup'), 'step4', $step4));

            $arr_response['status']   = 'success';
            $arr_response['redirect'] = url('').'/doctor/signup/step5/'.$enc_id;
            return response()->json($arr_response);
        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return response()->json($arr_response);
        }
        

    } // end store_step4

    /*
    | Function  : Doctor signup step5
    | Author    : Deepak Arvind Salunke
    | Date      : 05/08/2017
    | Output    : show the signup step5 page
    */

    public function signup_step5(Request $request, $enc_id)
    {
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {


            $prev_url = URL::previous();                
            if(isset($prev_url) && !empty($prev_url))
            {
                $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

                if($pageWasRefreshed )
                {

                }
                else {
                   
                    $url = explode("/",$prev_url);
                    $page = isset($url[count($url)-2]) ? $url[count($url)-2] : '';
                
                    if( $page == 'step1' || $page == 'step2'|| $page == 'step3' || $page == 'step4')
                    {

                    }
                    else
                    {
                        Session::forget('doctor_signup');        
                    }
                }
                    
            }

            $get_doctor_data = $this->DoctorModel->where('user_id',$doctor_id)->with('userinfo')->first();
            if($get_doctor_data)
            {
                $this->arr_view_data['exists_doctor_data'] = $get_doctor_data->toArray();
            }
            
            if(empty(Session::get('doctor_signup.step1')) && Session::get('doctor_signup.step1') == null)
            {
                return redirect(url('').'/doctor/signup/step1/'.$enc_id);
            }
            if(empty(Session::get('doctor_signup.step2')) && Session::get('doctor_signup.step2') == null)
            {         
                return redirect(url('').'/doctor/signup/step2/'.$enc_id);
            }
            if(empty(Session::get('doctor_signup.step3')) && Session::get('doctor_signup.step3') == null)
            {         
                return redirect(url('').'/doctor/signup/step3/'.$enc_id);
            }

            $this->arr_view_data['page_title']                = str_singular($this->module_title);
            $this->arr_view_data['enc_id']                    = $enc_id;
            $this->arr_view_data['module_url_path']           = $this->module_url_path;

            return view($this->module_view_folder.'.signup_step5',$this->arr_view_data);
        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }

    } // end signup_step5

    /*
    | Function  : Store step5 data in session
    | Author    : Deepak Arvind Salunke
    | Date      : 05/08/2017
    | Output    : get all the data from session and store it. Send verification email to register email id.
    */

    public function store_step5(Request $request, $enc_id)
    {   
        $doctor_id = base64_decode($enc_id);
        $doctor    = Sentinel::findById($doctor_id);
        if($doctor)
        {

                $arr_rules['about_me']          =   "required";
                $arr_rules['profile_pic_file']  =   "required";

                $arr_rules['enc_about_me']  =   "required";
                

                $validator  =   Validator::make($request->all(),$arr_rules);
                
                if($validator->fails())
                {
                    return back()->withInput($request->all())->withErrors($validator);
                }

                $num    =   $this->UserModel->where('email',Session::get('doctor_signup.email'))->count();
                if($num > 0)
                {
                    Session::flash('msg','Email id already exist.');
                    return redirect(url('').'/doctor/signup/step1/'.$enc_id);
                }

                if(empty(Session::get('doctor_signup')) && Session::get('doctor_signup') == null)
                {
                    return redirect(url('').'/doctor/signup/step1/'.$enc_id);
                }
                if(empty(Session::get('doctor_signup.step2')) && Session::get('doctor_signup.step2') == null)
                {         
                    return redirect(url('').'/doctor/signup/step2/'.$enc_id);
                }
                if(empty(Session::get('doctor_signup.step3')) && Session::get('doctor_signup.step3') == null)
                {         
                    return redirect(url('').'/doctor/signup/step3/'.$enc_id);
                }

                $profile_file_name  = "";
                $video_file_name    = "";

                if($request->hasFile('profile_pic_file'))
                {
                    $profile_pic_file   =   $request->file('profile_pic_file');

                    if(isset($profile_pic_file) && sizeof($profile_pic_file)>0)
                    {
                        $extention  =   strtolower($profile_pic_file->getClientOriginalExtension());
                        $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

                        $arr_profile_pic = getimagesize($profile_pic_file);

                        if(!in_array($extention, $valid_ext))
                        {
                            Session::flash('image_type_error','Please upload valid image with valid extension i.e jpg, png, jpeg, bmp.');
                            return redirect()->back()->withInput($request->all());
                        }
                        else if($profile_pic_file->getClientSize() > 5000000)
                        {
                            Session::flash('image_type_error','Please upload image with small size. Max size allowed is 5mb');
                            return redirect()->back()->withInput($request->all());
                        }
                        else if($arr_profile_pic[0] < 200 || $arr_profile_pic[1] < 190)
                        {
                            Session::flash('image_type_error','Please upload image of size greater than 200 X 190 for better resolution.');
                            return redirect()->back()->withInput($request->all());
                        }
                        else
                        {
                            /*$image_thumb = Image::make($profile_pic_file)->resize(96,96);
                            $image_thumb->fit(96, 96, function ($constraint) { $constraint->upsize(); });
                            $image_thumb = $image_thumb->stream();*/

                            @unlink($this->doc_profile_pic.$request->input('old_profile_pic_file'));
                            $profile_file_name      = $request->file('profile_pic_file');
                            $file_extension         = strtolower($request->file('profile_pic_file')->getClientOriginalExtension()); 
                            $profile_file_name      = sha1(uniqid().$profile_file_name.uniqid()).'.'.$file_extension;
                            $upload_result          = $request->file('profile_pic_file')->move($this->doc_profile_public, $profile_file_name);
                        }
                    }
                    else
                    {
                        Session::flash('image_type_error','Please upload valid image.');
                        return redirect()->back()->withInput($request->all());
                    }
                }

                 if($request->hasFile('intro_video_file'))
                {
                    $intro_video_file   =   $request->file('intro_video_file');

                    if(isset($intro_video_file) && sizeof($intro_video_file)>0)
                    {
                        $extention  =   strtolower($intro_video_file->getClientOriginalExtension());
                        $valid_ext  =   ['mp4','ogg','webm'];

                        if(!in_array($extention, $valid_ext))
                        {
                            Session::flash('video_type_error','Please upload valid video with valid extension i.e mp4, ogg, webm');
                            return redirect()->back()->withInput($request->all());
                        }
                        else if($intro_video_file->getClientSize() > 5000000)
                        {
                            Session::flash('video_type_error','Please upload video with small size. Max size allowed is 5mb');
                            return redirect()->back()->withInput($request->all());
                        }
                        else
                        {
                            @unlink($this->doc_video.$request->input('old_intro_video_file'));
                            $video_file_name      = $request->file('intro_video_file');
                            $file_extension       = strtolower($request->file('intro_video_file')->getClientOriginalExtension()); 
                            $video_file_name      = sha1(uniqid().$video_file_name.uniqid()).'.'.$file_extension;
                            $upload_result        = $request->file('intro_video_file')->move($this->doc_video_public, $video_file_name);
                        }
                    }
                    else
                    {
                        Session::flash('video_type_error','Please upload valid video.');
                        return redirect()->back()->withInput($request->all());
                    }
                }

                $email = "";
                $get_doctor_data = $this->DoctorModel->where('user_id',$doctor_id)->with('userinfo')->first();
                if($get_doctor_data)
                {
                    $data = $get_doctor_data->toArray();
                    if(isset($data['userinfo']['email']))
                    {
                        $email = $data['userinfo']['email'];
                        $user_id = $data['user_id'];
                        $user_mobile = $data['mobile_no'];
                        $user_mobile_code = $data['mobile_code'];
                    }
                }

                $arr_data['first_name']                                 =   Session::get('doctor_signup.step1.first_name');
                $arr_data['last_name']                                  =   Session::get('doctor_signup.step1.last_name');
                //$arr_data['email']                                      =   $email;
                $arr_data['password']                                   =   Session::get('doctor_signup.step1.password');
                $arr_data['profile_image']                              =   $profile_file_name;
                $arr_data['title']                                      =   Session::get('doctor_signup.step1.title');
                $arr_data['user_status']                                =   'Active';


                $user = "";
                if(isset($user_id) && !empty($user_id))
                {
                    $user = Sentinel::findById($user_id);    
                }
                

                $user   =   Sentinel::update($user,$arr_data);
                if($user)
                {
                    $doctor_data['user_id']                             = $user->id;
                    //$doctor_data['title']                               = Session::get('doctor_signup.title');
                    $doctor_data['gender']                              = Session::get('doctor_signup.step1.gender');
                    $doctor_data['dob']                                 = Session::get('doctor_signup.step1.datebirth_submit');
                    $doctor_data['citizenship']                         = Session::get('doctor_signup.step1.citizenship');
                    $doctor_data['contact_no']                          = Session::get('doctor_signup.step1.contact_no');
                    //$doctor_data['mobile_code']                         = Session::get('doctor_signup.step1.mobile_no_code');
                    //$doctor_data['mobile_no']                           = Session::get('doctor_signup.step1.mobile_no');
                    $doctor_data['address']                             = Session::get('doctor_signup.step1.address');
                    $doctor_data['timezone']                            = Session::get('doctor_signup.step1.timezone');

                    $doctor_data['clinic_name']                         = Session::get('doctor_signup.step2.clinic_name');
                    $doctor_data['clinic_address']                      = Session::get('doctor_signup.step2.clinic_address');
                    $doctor_data['clinic_email']                        = Session::get('doctor_signup.step2.clinic_email');
                    $doctor_data['clinic_contact_no']                   = Session::get('doctor_signup.step2.clinic_contact_no');
                    $doctor_data['clinic_mobile_no_code']               = Session::get('doctor_signup.step2.clinic_mobile_no_code');
                    $doctor_data['clinic_mobile_no']                    = Session::get('doctor_signup.step2.clinic_mobile_no');
                    $doctor_data['experience']                          = Session::get('doctor_signup.step2.experience');
                    $doctor_data['language']                            = Session::get('doctor_signup.step2.language');

                    $doctor_data['medical_qualification']               = Session::get('doctor_signup.step3.medical_qualification');
                    $doctor_data['medical_school']                      = Session::get('doctor_signup.step3.medical_school');
                    $doctor_data['year_obtained']                       = Session::get('doctor_signup.step3.year_obtained');
                    $doctor_data['country_obtained']                    = Session::get('doctor_signup.step3.country_obtained');
                    $doctor_data['other_qualifications']                = Session::get('doctor_signup.step3.other_qualifications');
                    $doctor_data['bank_account_name']                   = Session::get('doctor_signup.step3.bank_account_name');
                    $doctor_data['bsb']                                 = Session::get('doctor_signup.step3.bsb');
                    $doctor_data['account_number']                      = Session::get('doctor_signup.step3.account_number');

                    if(!empty(Session::get('doctor_signup.step4')) && Session::get('doctor_signup.step4') != null)
                    {
                    $doctor_data['id_proof_file']                       = Session::get('doctor_signup.step4.id_proof_file');
                    $doctor_data['medical_registration_no']             = Session::get('doctor_signup.step4.medical_registration_no');
                    $doctor_data['medical_registration_certificate']    = Session::get('doctor_signup.step4.medical_registration_certificate');
                    $doctor_data['medicare_provider_no']                = Session::get('doctor_signup.step4.medicare_provider_no');
                    $doctor_data['prescriber_no']                       = Session::get('doctor_signup.step4.prescriber_no');
                    $doctor_data['ahpra_registration_no']               = Session::get('doctor_signup.step4.ahpra_registration_no');
                    $doctor_data['abn']                                 = Session::get('doctor_signup.step1.abn');
                    $doctor_data['pi_insurance_policy']                 = Session::get('doctor_signup.step4.pi_insurance_policy');
                    $doctor_data['cyber_liability_insurance_policy']    = Session::get('doctor_signup.step4.cyber_liability_insurance_policy');
                    }

                    if(Session::has('doctor_signup.step5'))
                    {
                        Session::forget('doctor_signup.step5');
                    }


                      $step5 = array(
                                    'about_me'                          => $request->input('enc_about_me')
                              );

                   Session::put('doctor_signup', array_add($doctor_signup = Session::get('doctor_signup'), 'step5', $step5));

                    $doctor_data['about_me']                            = $request->input('enc_about_me');
                    //$doctor_data['profile_image']                       = $profile_file_name;
                    $doctor_data['profile_video']                       = $video_file_name;

                    /*$user  =  Sentinel::findById($user->id);
                    $role  =  Sentinel::findRoleBySlug('doctor');
                    $user->roles()->attach($role);*/

                    // create user for twilio chat
                    /*$create_user = $this->create_user($user->first_name.''.$user->last_name.''.$user->id);

                    $activation         =   Activation::create($user);
                    $activation_code    =   $activation->code;*/


                    $doctor_data['profile_complete']                           =   'yes';
                    $res_doctor = $this->DoctorModel->where('user_id', $user_id)->update($doctor_data);
                    if($res_doctor)
                    {

                        /*$activation_link    ='<a class="btn_emailer_cls" href="'.url('/doctor/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
                        $arr_built_content = [ 
                                                'FIRST_NAME'=>$arr_data['first_name'] , 
                                                'APP_NAME'  =>config('app.project.name'),
                                                'ACTIVATION_LINK'=>$activation_link,
                                             ];

                        $arr_mail_data                      = [];
                        $arr_mail_data['email_template_id'] = '38';
                        $arr_mail_data['arr_built_content'] = $arr_built_content;
                        $arr_mail_data['user']              = $arr_data;
                        $email_status  = $this->EmailService->send_mail($arr_mail_data);*/


                        $user_details['id'] = $user->id;
                        $user_details['email'] = $email;
                        $user_details['doctor_details']['mobile_code'] = $user_mobile_code;
                        $user_details['doctor_details']['mobile_no']   = $user_mobile;
                        


                        //$otp = rand(100000, 999999);
                        $otp = '123456';
                        $otp_id = $this->send_otp($otp,$user_details);

                        $reg_otp_id   =  $otp_id;
                        $password =  base64_encode(Session::get('doctor_signup.step1.password'));
                        $email    =  $email;

                        Session::set('reg_otp_id', $reg_otp_id);
                        Session::set('reg_password', $password);
                        Session::set('reg_email', $email);

                        Session::forget('doctor_signup');
                        Session::set('status' , 'success');

                        Session::forget('other_languages_session');
                        Session::forget('other_lan');

                        return redirect(url('/')."/doctor/thankyou");
                    }
                    else
                    {
                        Flash::error('Error! Error while creating your account. Please try again later');
                        return redirect(url('/')."/error");
                    }
                }
                else
                {
                    
                    Flash::error('Error! Some error occured. Please try again later');
                    return redirect(url('/')."/error");
                }

        }
        else
        {
            Flash::error('Error! Something went wrong. Please try again later');
            return redirect(url('/')."/doctor");
        }


    } // end store_step5

    public function store_signup(Request $request)
    {
        $cardId = '';

        $arr_rules['doc_email']     =   "required|email";
        $arr_rules['first_name']    =   "required";
        $arr_rules['last_name']     =   "required";
        $arr_rules['mobile_code']   =   "required";
        $arr_rules['phone_number']  =   "required";

        /*$arr_rules['speciality']    =   "required";
        $arr_rules['gender']        =   "required";

        $arr_rules['language']      =   "required";
        $arr_rules['suburb']        =   "required";
        $arr_rules['medical_qualification']    =   "required";

        $arr_rules['practitioning_experience'] =   "required";
        $arr_rules['provider_number']          =   "required";
        $arr_rules['AHPRA']                    =   "required";

        $arr_rules['ABN_invited']               =   "required";
        $arr_rules['register_ahpra']            =   "required";
        $arr_rules['legally_telemedicine']      =   "required";*/



        $form_data  =   $request->all();
        
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Flash::error('Please enter all mandatory & valid data.');
            return redirect(url('/')."/doctor");
        }

        $num    =   $this->UserModel->where('email',$request->input('doc_email'))->count();
        if($num > 0)
        {
            Flash::error('Email id already exist, Please try again with other email id.');
            return redirect(url('/')."/patient/error");
        }

        $count = $this->PatientModel->where('mobile_no' ,$form_data['phone_number'])
                                    ->count();
        if($count > 0)
        {
            Flash::error('An account with this mobile number already exists. Please try another.');
            return redirect(url('/')."/patient/error");
        }

        /* Encryption Card Id */
        $cardId     = Session::get('cardId');
        if($cardId=='')
        {
            Flash::error('Something went wrong. Please try again.');
            return redirect(url('/')."/patient/error");
        }

        // create Virgil api
        $virgilApi = $this->VirgilService->clientToken();
        $userCards = $virgilApi->Cards->get($cardId);

        $arr_data['first_name']     =   $form_data['first_name'];
        $arr_data['last_name']      =   $form_data['last_name'];
        $arr_data['email']          =   $form_data['doc_email'];
        $arr_data['dump_id']        =   $cardId;
        $arr_data['dump_session']   =   $form_data['txt_userkey'];
        $arr_data['password']       =   uniqid();
        $user   =   Sentinel::register($arr_data);
        if($user)
        {
            Session::put('cardId', null);
            
            $languages = "";
            $other_languages = "";
            if(isset($form_data['language']) && !empty($form_data['language']))
            {
                $languages  = implode(',', $form_data['language']);
            }

            if(isset($form_data['other_languages']) && !empty($form_data['other_languages']))
            {
                $other_languages  = explode(',', $form_data['other_languages']);
            }

            $doctor_data['speciality']                      = $form_data['speciality'];
            $doctor_data['mobile_code']                     = $form_data['mobile_code'];
            //$doctor_data['mobile_no']                       = $this->VirgilService->encryptData($userCards, $form_data['phone_number']);
            $doctor_data['mobile_no']                       = encrypt_value($form_data['phone_number']);
            $doctor_data['gender']                          = $form_data['gender'];
            $doctor_data['language']                        = str_replace("Other,","",$languages);
            $doctor_data['address']                  		= $this->VirgilService->encryptData($userCards, $form_data['suburb']);
            $doctor_data['medical_qualification']           = $this->VirgilService->encryptData($userCards, $form_data['medical_qualification']);
            $doctor_data['experience']                      = $form_data['practitioning_experience'];
            $doctor_data['provider_no']                     = $form_data['provider_number'];
            $doctor_data['ahpra_registration_no']           = $this->VirgilService->encryptData($userCards, $form_data['AHPRA']);
            $doctor_data['ABN_invited']                     = $request->input('ABN_invited',0);
            $doctor_data['register_ahpra']                  = $request->input('register_ahpra',0);
            $doctor_data['legally_telemedicine']            = $request->input('legally_telemedicine',0);
            $doctor_data['user_id']                         = $user->id; 
            

            if(in_array('ABN_invited', $form_data))
            {
                $doctor_data['ABN_invited'] = 1;
            }

            if(in_array('register_ahpra', $form_data))
            {
                $doctor_data['register_ahpra'] = 1;
            }

            if(in_array('legally_telemedicine', $form_data))
            {
                $doctor_data['legally_telemedicine'] = 1;
            }

            $user  =  Sentinel::findById($user->id);
            $role  =   Sentinel::findRoleBySlug('doctor');
            $user->roles()->attach($role);

            // create user for twilio chat
            $create_user = $this->create_user($form_data['first_name'].''.$form_data['last_name'].''.$user->id);

            /*$activation         =   Activation::create($user);
            $activation_code    =   $activation->code;*/

            $res_doctor = $this->DoctorModel->insertGetId($doctor_data);

            if($res_doctor)
            {

                $admin_notif['message'] = "Doctor - New Registration - ".$form_data['first_name'].' '.$form_data['last_name'];
                $this->AdminNotificationModel->create($admin_notif);


                if(in_array("Other", $form_data['language'])){
                    $data=[];
                    $other_language_id = [];
                    foreach($other_languages as $other_lan){
                         if($other_lan != ""){
                             $data['user_id']         = $user->id;
                             $data['language']        = ucfirst($other_lan);
                             $data['language_status'] = '1';
                             $other_language_id[] = \DB::table('dod_language')->insertGetId($data);
                         }
                    }
                    $lang_string = implode(",", array_merge($form_data['language'], $other_language_id)); 
                    $update_lang['language'] = str_replace("Other,","",$lang_string);
                    \DB::table('dod_doctor')->where('user_id',$res_doctor)->update($update_lang);
                }

                /*$activation_link    ='<a class="btn_emailer_cls" href="'.url('/doctor/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
                $arr_built_content = [ 
                                        'FIRST_NAME'=>$arr_data['first_name'] , 
                                        'APP_NAME'  =>config('app.project.name'),
                                        'ACTIVATION_LINK'=>$activation_link,
                                     ];

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '38';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $arr_data;
                $email_status  = $this->EmailService->send_mail($arr_mail_data);*/

                /* -- send mail to client -- */
                    /* content variables in view */
                    $content['first_name']          = $form_data['first_name'];
                    $content['last_name']           = $form_data['last_name'];
                    $content['email']               = $form_data['doc_email'];
                    /* end content variables in view */


                    /* built content variables in view */
                    $content             =  view('front.email.doctor_signup',compact('content'))->render();
                    $content             =  html_entity_decode($content);
                    /* end built content variables in view */
                   
                    $to_email_id         = $form_data['doc_email'];
                    $project_name        = config('app.project.name');
                    $mail_subject        = config('app.project.name').' - Thankyou for your interest';


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

                return redirect(url('/')."/doctor/thankyou");
            }
            else
            {
                Flash::error('Error! Error while creating your account. Please try again later');
                return redirect(url('/')."/doctor");
            }
        }
        else
        {
            Flash::error('Error! Some error occured. Please try again later');
            return redirect(url('/')."/doctor");
        }
    }

    public function thankyou()
    {
        return view($this->module_view_folder.'.thankyou',$this->arr_view_data);
    }

    /*========================Seema()=========================*/

    public function error($message)
    {
        $this->arr_view_data['message'] = $message;
        return view($this->module_view_folder.'.error',$this->arr_view_data);
    }
    public function success($message)
    {
        $this->arr_view_data['message'] = $message;
        return view($this->module_view_folder.'.success',$this->arr_view_data);
    }

    /*
    | Function  : Verify register email id and activate user
    | Author    : Deepak Arvind Salunke
    | Date      : 08/08/2017
    | Output    : If success then redirect to dashboard or if not then to error page along with the message
    */

    public function verify($enc_id=FALSE,$token=FALSE)
    {
        $enc_id             = base64_decode($enc_id);
        $activation_code    = base64_decode($token);

        $user           = Sentinel::findById($enc_id);
        $activation     = Activation::exists($user);
        if($activation)
        {
            if (Activation::complete($user, $activation_code))
            {
                $tmp_user = $this->UserModel->where('id',$enc_id)->first();
                if($tmp_user)
                {
                    $tmp_user->verification_status = 1;
                    $tmp_user->user_status = 'Active';
                    $tmp_user->save();    
                }
                //$login_status = Sentinel::login($user);

                $this->arr_view_data['status'] = 'VERIFIED';
                $this->arr_view_data['message'] = 'Your account verified successfully. Please wait until we\'ve been able to process your application, or contact us on customercare@doctoroo.com.au.';
                 
                return view($this->module_view_folder.'.verification_status')->with($this->arr_view_data);
            }
            else
            {
                $message = 'Error while activating account. Please try again later';
                Flash::error('Error while activating account. Please try again later');
                return redirect($this->module_url_path.'/error/'.$message);
            }
        }
        else
        {   $message ="Your account is already verified.";
            Flash::error('Your account is already verified.');
            return redirect($this->module_url_path.'/error/'.$message);
        }
    } 

   /* public function verify($enc_id=FALSE,$token=FALSE)
    {

    	if($enc_id!="" && $token!="")
    	{

    		$user_id = base64_decode($enc_id);
    		$token   = base64_decode($token);

    		$user_info = $this->UserModel->where('id',$user_id)->count();

    		if($user_info>0)
    		{
    			$update_arr = array('verification_status'=> '1',
    								'user_status'        => 'Active',
    								'token'              => '');

    			if($this->UserModel->where('id',$user_id)->update($update_arr))
    			{
                    Flash::success('Your verification completed successfully.');
            		return redirect($this->module_url_path."/setpassword/".base64_encode($user_id));
    			}
    			else
    			{
                    $message = 'Problem Occured, While verification.';
            		return redirect($this->module_url_path.'/error/'.$message);
    			}
    		}
    		else
    		{
                $message = 'Your verification link has been expried.Please contact to admin.';
            	return redirect($this->module_url_path.'/error/'.$message);
    		}
    	}
    }	*/
    /*========================End=============================*/

    public function login(Request $request)
    {
        $form_data   = $arr_rules =  $arr_credential = [];
        

        //$form_data          = $request->all();
        
        $arr_credential = [
                'email'      => $request->doctor_email,
                'password'   => $request->doctor_password
        ];
        
        return $this->init_login($arr_credential);
    }

    public function init_login($arr_credential)
    {
        $user = Sentinel::findByCredentials($arr_credential);
        if($user)
        {  
                if($user->inRole('admin'))
                {
                   $arr_json['status'] =  "error";
                   $arr_json['msg']    =  'User is not allowed to login.';
                   return response()->json($arr_json);
                }
                else if($user->inRole('doctor'))
                {
                        try 
                        {
                            $check_authentication = Sentinel::authenticate($arr_credential);
                            
                            if($check_authentication)
                            {            
                                if($check_authentication['user_status'] == 'Active')
                                {

                                  $login_status = Sentinel::login($user);
                                  if($login_status)
                                  {
                                      $arr_json['status'] =  "success";
                                      $arr_json['msg']    =  '';

                                      Sentinel::logout();
                                      Session::flush();

                                      $email = $arr_credential['email'];
                                      $password = $arr_credential['password'];
                                        
                                      $user_arr =$this->UserModel->where('email' ,$email)
                                                                 ->with('doctor_details')           
                                                                 ->first();
                                      if($user_arr)
                                      {
                                           $user_details = $user_arr->toArray();
                                           $mobile_no =  $user_details['doctor_details']['mobile_no'];

                                           if(empty($mobile_no) || $mobile_no == null)
                                            {
                                             
                                                $arr_json['status'] = 'error';
                                                $arr_json['msg'] = 'Your mobile number is not registered';

                                                return response()->json($arr_json);
                                            }
                                      }

                                      //$otp= rand(100000, 999999);
                                      $otp = '123456';
                                      $otp_id = $this->send_otp($otp,$user_details);

                                      $arr_json['otp_id']   =  $otp_id;
                                      $arr_json['password'] =  base64_encode($password);
                                      $arr_json['email']    =  $email;

                                      return response()->json($arr_json);
                                  } 
                                  else
                                  {
                                       $arr_json['status'] =  "error";
                                       $arr_json['msg']    =  'Invalid credentials, Please try again.';
                                       return response()->json($arr_json);
                                  }                 
                                }
                                else
                                {
                                    Sentinel::logout();
                                    Session::flush();

                                    $arr_json['status'] =  "error";
                                    $arr_json['msg']    =  'It looks like your account has been blocked by Admin.';
                                    return response()->json($arr_json);
                                }
                            }
                            else
                            {
                                $arr_json['status'] =  "error";
                                $arr_json['msg']    =  'Invalid credentials, Please try again.';
                                return response()->json($arr_json);
                            }
                        } 
                        catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) 
                        {
                             $arr_json['status'] =  "error";
                             $arr_json['msg']    =  'Account has not been verified yet. Please check your mailbox and verify your account.';
                             return response()->json($arr_json);

                        }

                }
                else
                {
                    $arr_json['status'] =  "error";
                    $arr_json['msg']    =  'User is not present with this role.';
                    return response()->json($arr_json);
                }
                
          }
          else
          {
               $arr_json['status'] =  "error";
               $arr_json['msg']    =  'User does not exist.';
               return response()->json($arr_json);
          }
           
    }

    public function resend_verification_mail($enc_id)
    {
        $user_id = base64_decode($enc_id);
        $user    = Sentinel::findById($user_id);
        if($user)
        {
                $activation_code            =   $user->token;
                $arr_data['first_name']     =   $user->first_name;
                $arr_data['last_name']      =   $user->last_name;
                $arr_data['email']          =   $user->email;

                $url  = url($this->module_url_path.'/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code));
                $activation_link  =   '<a class="btn_emailer_cls" href="'.$url.'"> Verify Now </a>';

                $arr_built_content = [ 
                                        'FIRST_NAME'=>$arr_data['first_name'] , 
                                        'APP_NAME'  =>config('app.project.name'),
                                        'ACTIVATION_LINK'=>$activation_link,
                                     ];

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '38';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $arr_data;
               
                $email_status  = $this->EmailService->send_mail($arr_mail_data);
                if($email_status)
                {
                    $message = "Verification email has been sent successfully to your registered email id, please check your email inbox & verify your account.";
                    return redirect($this->module_url_path.'/success/'.$message);
                   

                }
                else
                {
                     $message = "Error occure while sending a mail to user email id.";
                     return redirect($this->module_url_path.'/error/'.$message);
        
                }               
           
        }
        else
        {
             $message = "No such a user available.";
             return redirect($this->module_url_path.'/error/'.$message);
        }
    }

    public function setpassword($user_id)
    {
        if($user_id)
        {
              
            $this->arr_view_data['enc_user_id']     =   $user_id;
            return view($this->module_view_folder.'.setpassword',$this->arr_view_data);
        }
        else
        {
             $message = "Invalid verification Link.";
             return redirect($this->module_url_path.'/error/'.$message);
        }
    }

    public function verify_setpassword(Request $request)
    {   
        $form_data = $arr_credentials =[];
        $form_data = $request->all();
        $user_id   = base64_decode($form_data['enc_user_id']);

        $user      = Sentinel::findById($user_id);
        if($user)
        {
            if($user->email==$form_data['email'])
            {
                $arr_credentials['password'] =  $form_data['password'];
                $user = Sentinel::update($user,$arr_credentials);
                if($user)
                {
                    Flash::success('Password is set successfully, now you can login to your account.');

                }
            }
            else
            {
                Flash::error('Invalid email id.Please enter valid email id to reset password.');

            }
        }
        return redirect()->back();

    }
    /*To delete user account load view*/
    public function delete_account()
    {
        $this->arr_view_data['module_url_path']    =  $this->module_url_path.'/profile';
        $this->arr_view_data['page_title']         = 'Delete Account';
        return view($this->module_view_folder.'.delete_account',$this->arr_view_data);
    }

    public function send_otp($otp,$user_details)
    {
        $otp_id = "";

        if($user_details)
        {
            $mobile_code = $user_details['doctor_details']['mobile_code'];

            $get_mob_data = $this->MobileCountryCodeModel->where('id', $mobile_code)->first();
            if($get_mob_data)
            {
                $mob_data = $get_mob_data->toArray();
                $mob_code = $mob_data['phonecode'];
            }
            $mobile_num =  decrypt_value($user_details['doctor_details']['mobile_no']);
            $mobile_no  = '+'.$mob_code.''.$mobile_num;

            $user_id    =  $user_details['id'];
            $email      =  $user_details['email'];

            $created_on = date("Y-m-d H:i:s");
            $expired_on = date("Y-m-d H:i:s",strtotime("+10 minutes",strtotime($created_on)));
            
            $data_arr['user_id']    = $user_id;
            $data_arr['otp']        = $otp;
            $data_arr['mobile_no']  = $mobile_no;
            $data_arr['email']      = $email;
            $data_arr['created_on'] = $created_on;
            $data_arr['expired_on'] = $expired_on;

            if(isset($user_id) && !empty($user_id))
            {
                $this->OtpModel->where('user_id',$user_id)
                               ->delete();    
            }

            if(!empty($mobile_no) || $mobile_no != null)
            {
                $otp_id = $this->OtpModel->insertGetId($data_arr);
            }

            Session::put('otp_user_id',$user_id);
            Session::put('otp_mobile_no',$mobile_no);
        }
        

        if(isset($otp) && !empty($otp))
        {
            $to = $mobile_no;
            $message = $otp." - your doctoroo security login code ";

            $sid        = env('TWILIO_SMS_SID');
            $token      = env('TWILIO_SMS_TOKEN');
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
                return '0';
            }
        }
        return $otp_id;
    }
    public function resend_otp(Request $request)
    {
        $otp_id    = "";
        $user_id   = "";
        $mobile_no = "";

        if(Session::has('otp_user_id'))
        {
            $user_id = Session::get('otp_user_id');
        }
        if(Session::has('otp_mobile_no'))
        {
            $mobile_no = Session::get('otp_mobile_no');
        }
        
        if(isset($user_id) && !empty($user_id))
        {
          $this->OtpModel->where('user_id', $user_id)
                         ->delete();
        }

        //$otp = rand(100000, 999999);
        $otp = '123456';

        if(empty($mobile_no))
        {
            $arr_json['status'] ='error';
            $arr_json['msg'] = 'Your Mobile number is not registered.';
            $arr_json['otp_id'] = '';
            return response()->json($arr_json);
        }

        $created_on = date("Y-m-d H:i:s");
        $expired_on = date("Y-m-d H:i:s",strtotime("+10 minutes",strtotime($created_on)));

        $data_arr['user_id']    = $user_id;
        $data_arr['otp']        = $otp;
        $data_arr['mobile_no']  = $mobile_no;
        $data_arr['email']      = $request->email;
        $data_arr['created_on'] = $created_on;
        $data_arr['expired_on'] = $expired_on;

        $otp_id = $this->OtpModel->insertGetId($data_arr);
            
        if(isset($otp) && !empty($otp) && isset($otp_id))
        {
            $to = $mobile_no;
            $message = $otp." - your doctoroo security login code ";

            $sid        = env('TWILIO_SMS_SID');
            $token      = env('TWILIO_SMS_TOKEN');
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
                $arr_json['status'] ='error';
                $arr_json['msg'] = 'Invalid registered mobile number and country code.';
                $arr_json['otp_id'] = '0';  
                return response()->json($arr_json);
            }

            if(isset($otp_id) && !empty($otp_id))
            {
                
                $arr_json['status'] ='success';
                $arr_json['msg'] = 'OTP Resent successfully. Please check your registered mobile number.';
                $arr_json['otp_id'] = $otp_id;
                return response()->json($arr_json);
            }
            else
            {
                $arr_json['status'] ='error';
                $arr_json['msg'] = 'Something went to wrong.';
                $arr_json['otp_id'] = '';
                return response()->json($arr_json);
            }
        }
        return response()->json($arr_json);
    }

    public function verify_otp(Request $request)
    {
        $current_datetime   = date("Y-m-d H:i:s");

        $otp_expired = $this->OtpModel->where('id', $request->otp_id)
                                	  ->where('expired_on' ,'>', $current_datetime)
                                	  ->count();                             
        if($otp_expired > 0)
        {
            $count = $this->OtpModel->where('id', $request->otp_id)
                                	->where('otp' , $request->otp)
                                	->count();                                              
            if($count > 0)
            {
                $arr_credential['email']    = $request->email;
                $arr_credential['password'] = base64_decode($request->password);
                $check_authentication = Sentinel::authenticate($arr_credential);

                $user = Sentinel::findByCredentials($arr_credential);
                if($check_authentication)
                {            
                  $login_status = Sentinel::login($user);
                  if($login_status)
                  {
                    $arr_json['status'] =  "success";
                    $arr_json['msg']    =  '';

                    $session_id = Session::getId();

                    $upd_arr['session_id'] = $session_id; 
                    $this->UserModel->where('id' ,$user->id)
                                    ->update($upd_arr);
                    
                    $this->OtpModel->where('id', $request->otp_id)
                                   ->where('otp' , $request->otp)
                                   ->delete();
                    $this->OtpModel->where('user_id', $user->id)
                                   ->delete();
                  } 
                  else
                  {
                    $arr_json['status'] =  "error";
                    $arr_json['msg']    =  'Invalid credentials, Please try again.';
                    return response()->json($arr_json);
                  }

                  $current_datetime = date('Y-m-d H:i:s');

                  $membership_count = $this->MembershipPaymentModel->where('doctor_id' , $user->id)
                                               					   ->where('end_date' , '>' , $current_datetime)
                                               					   ->count();
                  
                  if($membership_count == 0)
                  {
                    $arr_json['status'] =  "no_membership";
                    $arr_json['msg']    =  ''; 
                  }
                  else
                  {
                        $update_data['login_time'] = date('Y-m-d H:i:s');
                        $update_data['logout_time'] = date('Y-m-d H:i:s', strtotime('+ 30 minutes'));
                      
                        $user_update = $this->UserModel->where('id' ,$user->id)
                                                       ->update($update_data);

                        $arr_json['status'] =  "success";
                        $arr_json['msg']    =  '';
                  }                                              
                  
                  
                  return response()->json($arr_json);
                }
                else
                {
                  $arr_json['status'] =  "error";
                  $arr_json['msg']    =  'Invalid credentials, Please try again.';
                  return response()->json($arr_json);
                }

                $arr_json['status'] = 'error';
                $arr_json['msg'] = 'Invalid OTP. Please try again';
            } 
            else
            {
                $arr_json['status'] = 'error';
                $arr_json['msg'] = 'Invalid OTP. Please try again';
            }
        }
        else
        {
            $arr_json['status'] = 'error';
            $arr_json['msg'] = 'Your OTP is expired ! Please Resend otp';
        }                                

        return response()->json($arr_json);                      
    }


    /*
    | Function  : Create user for twilio chat
    | Author    : Deepak Arvind Salunke
    | Date      : 09/09/2017
    | Output    : Success or Error
    */

    public function create_user($username)
    {
        // Create the user
        $user = $this->client->chat
                     ->services($this->service_id)
                     ->users
                     ->create($username);

        return $user->identity;
        
    } // end create_user


    public function profile_about(Request $request, $enc_id)
    {
      $doctor_id  = base64_decode($enc_id);
      $get_date   = '';

      $doctor_data = $this->DoctorModel->where('user_id', $doctor_id)
                                       ->with('userinfo')
                                       ->first();
      if($doctor_data)
      {
        $this->arr_view_data['doctor_arr'] = $doctor_data->toArray();
        if(isset($this->arr_view_data['doctor_arr']['language']) && !empty($this->arr_view_data['doctor_arr']['language']))
        {
          $language_id_arr = explode(',', $this->arr_view_data['doctor_arr']['language']);

            $languages = $this->LanguageModel->whereIn('id', $language_id_arr)
                                             ->get();
            if(isset($languages) && !empty($languages))
            {
              $this->arr_view_data['languages_arr'] = $languages->toArray();
            }                                             
        }
      }
     

      $fees_arr = $this->DoctorPremiumRateModel->where('doctor_id',$doctor_id)->first();
      if($fees_arr)
      {
        $this->arr_view_data['fees_arr'] = $fees_arr->toArray();
      }      

      $admin_fees_arr = $this->DoctroFeesModel->where('id','1')->first();      
      
      if($admin_fees_arr)
      {
        $this->arr_view_data['admin_fees_arr'] = $admin_fees_arr->toArray();
      }
      
      $this->arr_view_data['get_selected_date']         = $get_date;
      $this->arr_view_data['doctor_video_url']          = $this->doc_video;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.profile_about',$this->arr_view_data);
    } // end profile_about


    /* Chnage Mobile Nuimber TA */
    public function store_change_mobile_no(Request $request)
    {
          
            if(!empty($request->input('cpnfirst_name'))){  $cpnfirst_name           =   $request->input('cpnfirst_name');     } else {  $cpnfirst_name       = ''; }
            if(!empty($request->input('cpnlast_name'))){  $cpnlast_name             =   $request->input('cpnlast_name');      } else {  $cpnlast_name        = ''; }
            if(!empty($request->input('old_ph_no'))){  $old_ph_no                   =   $request->input('old_ph_no');         } else {  $old_ph_no           = ''; }
            if(!empty($request->input('new_ph_no'))){  $new_ph_no                   =   $request->input('new_ph_no');         } else {  $new_ph_no           = ''; }
            if(!empty($request->input('cpndob'))){  $cpndob                         =   $request->input('cpndob');   $date1  = strtr($cpndob, '/', '-');   $cpndob = date('Y-m-d', strtotime($date1));  } else {  $cpndob              = ''; }
            if(!empty($request->input('cpnstate'))){  $cpnstate                     =   $request->input('cpnstate');          } else {  $cpnstate            = ''; }
            if(!empty($request->input('last_consultation'))){  $last_consultation   =   $request->input('last_consultation'); $last_consultation_date  = strtr($last_consultation, '/', '-');   $last_consultation = date('Y-m-d', strtotime($last_consultation_date));   } else {  $last_consultation   = ''; }
            if(!empty($request->input('additinal_notes'))){  $additinal_notes       =   $request->input('additinal_notes');   } else {  $additinal_notes     = ''; }


            $user_details = $this->UserModel
                        ->select('users.email','users.id','dod_doctor.mobile_code')
                        ->join('dod_doctor','dod_doctor.user_id', '=' , 'users.id')
                        ->where('users.email',$old_ph_no);


                        if($last_consultation != ''){
                            $user_details->join('dod_patient_consultation_booking','dod_patient_consultation_booking.doctor_user_id', '=' , 'users.id');
                            $user_details->orderBy('dod_patient_consultation_booking.id','desc');
                            $user_details->limit(1);
                            $user_details->where('dod_patient_consultation_booking.consultation_date',$last_consultation);
                        }

                        if($cpndob !=''){
                            $user_details->where('dod_doctor.dob',$cpndob);
                        }
                        if($cpnstate !=''){
                            //$user_details->where('dod_doctor.address',$cpnstate);
                        }
                        if($cpnfirst_name !=''){
                            $user_details->where('users.first_name',$cpnfirst_name);
                        }
                        if($cpnlast_name !=''){
                            $user_details->where('users.last_name',$cpnlast_name);
                        }
                        $user_details = $user_details->first();


            if(count($user_details)>0)
            {
                if(empty($request->input('cpnmob_code'))){
                    $get_mob_data = $this->MobileCountryCodeModel->where('id', $user_details->mobile_code)->first();
                    if($get_mob_data)
                    {
                        $mob_data = $get_mob_data->toArray();
                        $mob_code = $mob_data['phonecode'];
                    }
                }
                else{
                    $get_mob_data = $this->MobileCountryCodeModel->where('id', $request->input('cpnmob_code'))->first();
                    if($get_mob_data)
                    {
                        $mob_data = $get_mob_data->toArray();
                        $mob_code = $mob_data['phonecode'];
                    }
                }

                //$otp= rand(100000, 999999);
                $otp = '123456';
                $mobile_num  =  $new_ph_no;
                $mobile_no   = '+'.$mob_code.''.$mobile_num;

                $user_id     = $user_details->id;
                $email       = $user_details->email;

                $created_on = date("Y-m-d H:i:s");
                $expired_on = date("Y-m-d H:i:s",strtotime("+10 minutes",strtotime($created_on)));

                $data_arr['user_id']    = $user_id;
                $data_arr['otp']        = $otp;
                $data_arr['mobile_no']  = $mobile_no;
                $data_arr['email']      = $email;
                $data_arr['created_on'] = $created_on;
                $data_arr['expired_on'] = $expired_on;

                if(isset($otp) && !empty($otp))
                {

                    if(isset($user_id) && !empty($user_id))
                    {
                        $this->OtpModel->where('user_id',$user_id)
                                       ->delete();    
                    }
                    // $to = "+918149905936";
                    $to = $mobile_no;
                    $message = $otp." - your doctoroo change mobile number otp";

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
                        $arr_json['status'] = 'error';
                        $arr_json['msg'] = 'Your new mobile number is not valid'; 
                        return response()->json($arr_json);    
                    }

                    $otp_id = $this->OtpModel->insertGetId($data_arr);
                    $arr_json['otp_id'] = $otp_id;
                    $arr_json['cpnuser_id'] = $user_id;
                    $arr_json['cpnnew_mobile_no'] = $new_ph_no;

                    
                }
                $arr_json['status'] = 'success';
                $arr_json['msg'] = 'Your account found';
                return response()->json($arr_json);   
            }
            else
            {
                $arr_json['status'] = 'error';
                $arr_json['msg'] = 'Sorry,your details does not match';
                return response()->json($arr_json);   
            }
    }
    public function verify_cpnotp(Request $request)
    {



        if(!empty($request->input('cpnfirst_name'))){  $cpnfirst_name           =   $request->input('cpnfirst_name');        } else {  $cpnfirst_name       = ''; }
        if(!empty($request->input('cpnlast_name'))){  $cpnlast_name             =   $request->input('cpnlast_name');         } else {  $cpnlast_name        = ''; }
        if(!empty($request->input('old_ph_no'))){  $old_ph_no                   =   $request->input('old_ph_no');            } else {  $old_ph_no           = ''; }
        if(!empty($request->input('new_ph_no'))){  $new_ph_no                   =   $request->input('new_ph_no');            } else {  $new_ph_no           = ''; }
        if(!empty($request->input('cpndob'))){  $cpndob                         =   $request->input('cpndob');   $date1  = strtr($cpndob, '/', '-');   $cpndob = date('Y-m-d', strtotime($date1));  } else {  $cpndob              = ''; }
        if(!empty($request->input('cpnstate'))){  $cpnstate                     =   $request->input('cpnstate');             } else {  $cpnstate            = ''; }
        if(!empty($request->input('last_consultation'))){  $last_consultation   =   $request->input('last_consultation'); $last_consultation_date  = strtr($last_consultation, '/', '-');   $last_consultation = date('Y-m-d', strtotime($last_consultation_date));   } else {  $last_consultation   = ''; }
        if(!empty($request->input('additinal_notes'))){  $additinal_notes       =   $request->input('additinal_notes');      } else {  $additinal_notes     = ''; }
        if(!empty($request->input('cpnmob_code'))){  $cpnmob_code       =   $request->input('cpnmob_code');   } else {  $cpnmob_code     = ''; }



        $store_data=[]; 
        $store_data['patient_id']         =  '0';
        $store_data['doctor_id']          =  $request->cpnuser_id; 
        $store_data['first_name']         =  $cpnfirst_name;
        $store_data['last_name']          =  $cpnlast_name;
        $store_data['old_phone_no']       =  $old_ph_no;
        $store_data['new_phone_no']       =  $new_ph_no;
        $store_data['dob']                =  $cpndob;
        $store_data['address']            =  $cpnstate;
        $store_data['last_consult_date']  =  $last_consultation;
        $store_data['additional_notes']   =  $additinal_notes;
        $store_data['new_country_code']   =  $cpnmob_code;




        
        $current_datetime   = date("Y-m-d H:i:s");

        $otp_expired = $this->OtpModel->where('id', $request->cpnotp_id)
                                ->where('expired_on' ,'>', $current_datetime)
                                ->count();

        if($otp_expired > 0)
        {
            $count = $this->OtpModel->where('id', $request->cpnotp_id)
                                    ->where('otp' , $request->cpnotp)
                                    ->where('user_id' , $request->cpnuser_id)
                                    ->count(); 
            if($count > 0)
            {
                    //$this->DoctorModel->where('user_id' , $request->cpnuser_id)->update(['mobile_no'=>$request->cpnnew_mobile_no]);
                    $this->ChangeMobileNoModel->where('doctor_id', $request->cpnuser_id)->delete();
                    $this->ChangeMobileNoModel->insertGetId($store_data);



                    $this->OtpModel->where('id', $request->cpnotp_id)
                                   ->where('otp' , $request->cpnotp)
                                   ->delete();
                    $this->OtpModel->where('user_id', $request->cpnuser_id)
                                   ->delete();

                    $admin_notif['message'] = "Doctor - Change Mobile No - ".$cpnfirst_name.' '.$cpnlast_name;
                    $this->AdminNotificationModel->create($admin_notif);

                    /* send msg to admin */
                    $get_admin_mo = \DB::table('dod_admin_profile')->select('mobile_no')->first();
                    if(isset($get_admin_mo->mobile_no) && $get_admin_mo->mobile_no != ''){
                        $to = $get_admin_mo->mobile_no;
                        $message = 'You have recieved new mobile number change request from doctor';

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

                   
                    $arr_json['status'] =  "success";
                    //$arr_json['msg'] = 'Your mobile number has been successfully changed';
                    $arr_json['msg'] = 'Your change mobile number request has been successfully send to admin, After admin approval will change your mobile number';
                    return response()->json($arr_json);

            } 
            else
            {
                $arr_json['status'] = 'error';
                $arr_json['msg'] = 'Invalid OTP. Please try again';
            }    
        }
        else
        {
            $arr_json['status'] = 'error';
            $arr_json['msg'] = 'Your OTP is expired ! Please Resend otp';
        }   

        return response()->json($arr_json);                      
    }
    public function resend_cpnotp(Request $request)
    {
        $otp_id     = $request->cpnotp_id;
        $user_id    = $request->cpnuser_id;
        $mobile_num = $request->cpnnew_mobile_no;


        $user_details = $this->UserModel
                        ->select('users.email','users.id','dod_doctor.mobile_code')
                        ->join('dod_doctor','dod_doctor.user_id', '=' , 'users.id')
                        ->where('dod_doctor.user_id',$user_id)
                        ->where('users.id',$user_id)
                        ->first();


        
        if(isset($user_id) && !empty($user_id))
        {
          $this->OtpModel->where('user_id', $user_id)
                         ->delete();
        }


        if(empty($request->input('cpnnew_mobile_no_code'))){
            $get_mob_data = $this->MobileCountryCodeModel->where('id', $user_details->mobile_code)->first();
            if($get_mob_data)
            {
                $mob_data = $get_mob_data->toArray();
                $mob_code = $mob_data['phonecode'];
            }
        }
        else{
            $get_mob_data = $this->MobileCountryCodeModel->where('id', $request->input('cpnnew_mobile_no_code'))->first();
            if($get_mob_data)
            {
                $mob_data = $get_mob_data->toArray();
                $mob_code = $mob_data['phonecode'];
            }
        }
        

        //$otp= rand(100000, 999999);
        $otp = '123456';
        $mobile_num  =  $mobile_num;
        $mobile_no   = '+'.$mob_code.''.$mobile_num;


        //$otp = rand(100000, 999999);
        $otp = '123456';

        if(empty($mobile_no))
        {
            $arr_json['status'] = 'error';
            $arr_json['msg']    = 'Your Mobile number is not registered.';
            $arr_json['otp_id'] = '';
            return response()->json($arr_json);
        }

        $created_on   = date("Y-m-d H:i:s");
        $expired_on = date("Y-m-d H:i:s",strtotime("+10 minutes",strtotime($created_on)));

        $data_arr['user_id']    = $user_id;
        $data_arr['otp']        = $otp;
        $data_arr['mobile_no']  = $mobile_num;
        $data_arr['email']      = $user_details->email;
        $data_arr['created_on'] = $created_on;
        $data_arr['expired_on'] = $expired_on;

        $otp_id = $this->OtpModel->insertGetId($data_arr);
            
        if(isset($otp) && !empty($otp) && isset($otp_id))
        {
            $to = $mobile_no;
            $message = $otp." - your doctoroo change mobile number otp";

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
                $otp_id = '0';
                $arr_json['status'] = 'error';
                $arr_json['msg'] = 'Your new mobile number is not valid'; 
                return response()->json($arr_json); 
            }

            if(isset($otp_id) && !empty($otp_id) && $otp_id !='0')
            {
                
                $arr_json['status'] ='success';
                $arr_json['msg'] = 'OTP Resent successfully. Please check your registered mobile number.';
                $arr_json['otp_id']           = $otp_id;
                $arr_json['cpnuser_id']       = $user_id;
                $arr_json['cpnnew_mobile_no'] = $mobile_num;

            }
            else if($otp_id == '0')
            {
                $arr_json['status']           = 'error';
                $arr_json['msg']              = 'Invalid registered mobile number and country code.';
                $arr_json['otp_id']           = '';   
                $arr_json['cpnuser_id']       = $user_id;
                $arr_json['cpnnew_mobile_no'] = $mobile_num;
            }
            else
            {
                $arr_json['status']           = 'error';
                $arr_json['msg']              = 'Something went to wrong.';
                $arr_json['otp_id']           = '';
                $arr_json['cpnuser_id']       = $user_id;
                $arr_json['cpnnew_mobile_no'] = $mobile_num;
            }
        }
        return response()->json($arr_json);
    }

    /* End Chnage Mobile Nuimber TA */
    
}
