<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\OtpModel;
use App\Models\AdminProfileModel;
use App\Models\MobileCountryCodeModel;
use App\Models\ChangeMobileNoModel;
use App\Models\AdminNotificationModel;

use App\Common\Services\EmailService;
use App\Common\Services\VirgilService;
use Twilio\Rest\Client;

use Validator;
use Flash;
use Sentinel;
use Activation;
use Reminder;
use URL;
use Response;
use Session;
use Mail;
use Exception;

class AuthController extends Controller
{

    public function __construct(UserModel $UserModel,PatientModel $PatientModel,EmailService $EmailService,OtpModel $OtpModel,AdminProfileModel $AdminProfileModel, MobileCountryCodeModel $mob_country_code, ChangeMobileNoModel $ChangeMobileNoModel,VirgilService $VirgilService,AdminNotificationModel $AdminNotificationModel)
    { 
        $this->arr_view_data[]         =  [];
        $this->UserModel               =  $UserModel;
        $this->PatientModel            =  $PatientModel;
        $this->OtpModel                =  $OtpModel;
        $this->EmailService            =  $EmailService;
        $this->AdminProfileModel       =  $AdminProfileModel;
        $this->ChangeMobileNoModel     =  $ChangeMobileNoModel; 
        $this->MobileCountryCodeModel  =  $mob_country_code;
        $this->VirgilService           =  $VirgilService;
        $this->AdminNotificationModel  =  $AdminNotificationModel;

        $this->module_title            = "Delete";
        $this->module_view_folder      = 'front.patient';

        $this->sid                     = config('services.twilio')['accountSid'];
        $this->token                   = config('services.twilio')['auth_token'];
        $this->service_id              = config('services.twilio')['service_id'];
        $this->client                  = new Client($this->sid,$this->token);

    } 

    public function index()
    {
        
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
        $count = $this->UserModel->where('mobile_no',$request->mobile_no)->withTrashed()->count();
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

    public function store_signup(Request $request)
    { 
        $arr_rules['pemail']         =   "required|email";
        $arr_rules['pfirst_name']    =   "required";
        $arr_rules['plast_name']     =   "required";
        $arr_rules['ppass_word']     =   "required";
        
        $form_data  =   $request->all();
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Flash::error('Please check your browser javascript setting to allow our website form access. Currently it is denied.');
            return redirect(url('/')."/patient/error");
        }

        $arr_data['first_name']     =   $form_data['pfirst_name'];
        $arr_data['last_name']      =   $form_data['plast_name'];
        $arr_data['email']          =   $form_data['pemail'];
        $arr_data['password']       =   $form_data['ppass_word'];
        $arr_data['user_status']    =   'Active';

        $user                       =   Sentinel::register($arr_data);
        if($user)
        {
            $patient_data['user_id'] = $request->cpnuser_id; 

            $user  =  Sentinel::findById($user->id);
            $role  =  Sentinel::findRoleBySlug('patient');
            $user->roles()->attach($role);

            $activation =   Activation::create($user);
            $activation_code    =   $activation->code;

            $res_patient = $this->PatientModel->create($patient_data);
            if($res_patient)
            {
                $activation_link    ='<a class="btn_emailer_cls" href="'.url('/patient/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
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
                $login_status = Sentinel::login($user);
                
                Flash::success('Thanks for signing up and welcome to the future of healthcare.');
                //return redirect(url('/')."/patient/profile");
                return redirect(url('/')."/search/doctor/who-is-patient");
            }
            else
            {
                Flash::error('Error! Error while creating your account. Please try again later');
                return redirect(url('/')."/patient/error");
            }
        }
        else
        {
            Flash::error('Error! Some error occured. Please try again later');
            return redirect(url('/')."/patient/error");
        }
    }

    public function thankyou()
    {
        return view($this->module_view_folder.'.thankyou',$this->arr_view_data);
    }
    public function thankyoumail()
    {
        return view($this->module_view_folder.'.thankyouforget',$this->arr_view_data);
    }
    public function error()
    {
        return view($this->module_view_folder.'.error',$this->arr_view_data);
    }

    public function verify($enc_id,$activation_code)
    {
        $enc_id             = base64_decode($enc_id);
        $activation_code    = base64_decode($activation_code);

        $user = Sentinel::findById($enc_id);
        $activation = Activation::exists($user); // check if activation aleady done ...
        if($activation) // if activation is done
        {
            if (Activation::complete($user, $activation_code)) // complete an activation process
            {
                $tmp_user = $this->UserModel->where('id',$enc_id)->first();
                if($tmp_user)
                {
                    $tmp_user->verification_status = 1;
                    $tmp_user->user_status = 'Active';
                    $tmp_user->save();    
                }
                //$login_status = Sentinel::login($user);

                Flash::success('Thank you for signing up, we\'ve created an account for you.Below is your Homepage where you can access different links quickly.For all features, browse your menu below. In the meantime, you can complete your profile.We look forward to offering the best care');  

                 $this->arr_view_data['status'] = 'VERIFIED';
                 $this->arr_view_data['message'] = 'Your account verified successfully, you are ready to login your account';
                 
                 return view($this->module_view_folder.'.verification_status')->with($this->arr_view_data);
            }
            else
            {
                Flash::error('Error while activating account. Please try again later');
                return redirect(url('/patient/error'));
            }
        }
        else
        {
            Flash::error('Your account is already verified.');
            return redirect(url('/patient/error'));
        }
    } 

    public function signin_check(Request $request)
    {

        $arr_json                    = $form_data = $arr_credentials = [];
        $arr_rules['email_login']    =   "required|email";
        $arr_rules['password_login'] =   "required|min:6";
        
        $form_data  =   $request->all();
        ;
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
          $arr_json['status'] = "error";
          $arr_json['msg']    = "Please enter a valid email id & password.";  
        }
        $form_data       = $request->all();

        $arr_credentials = [
                'email'      => $form_data['email'],
                'password'   => $form_data['password'],
        ];

        return $this->init_login($arr_credentials);
    }


    public function init_login($arr_credential)
    {   
      $arr_json = [];
      $user = Sentinel::findByCredentials($arr_credential);

      if($user)
        {  
            if($user->inRole('admin'))
            {
               $arr_json['status'] =  "error";
               $arr_json['msg']    =  'User is not allowed to login.';
               return response()->json($arr_json);
            }
            else if($user->inRole('patient'))
            {
                $after_seven_days_date  = date('y-m-d',strtotime('+6 day',strtotime($user->created_at)));
                    
                $current_date           = date('y-m-d');
                
                if($user->user_status=='Block')
                { 
                     $arr_json['status'] =  "error";
                     $arr_json['msg']    =  'Your account is blocked by admin,please contact to admin.';
                     return response()->json($arr_json); 
                   
                }
                elseif($user->verification_status=='0')
                {
                    /*if($current_date<$after_seven_days_date)
                    {
                            
                        return $this->login($arr_credential,$user);
                      
                    }
                    else
                    {
                        $url = url('/patient/resend-verification-email/'.$user->id);
                  
                        $arr_json['status'] =  "error";
                        $arr_json['msg']    =  'Please click the link we’ve given here'." ".'<a href='.$url.'>Resend Verification Mail</a>';
                        return response()->json($arr_json);
                    }
                   */
                    /*$url = url('/patient/resend-verification-email/'.$user->id);
                  
                    $arr_json['status'] =  "error";
                    $arr_json['msg']    =  'Please click the link we’ve given here'." ".'<a href='.$url.'>Resend Verification Mail</a>';
                    return response()->json($arr_json);*/

                    return $this->login($arr_credential,$user);

                }   
                else
                {
                    return $this->login($arr_credential,$user);
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
        return response()->json($arr_json);
    }

    public function login($arr_credential,$user)
    {
            $check_authentication = Sentinel::authenticate($arr_credential);
            if($check_authentication)
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
                                           ->with('patientinfo')           
                                           ->first();
                
                if($user_arr)
                {
                   $user_details =  $user_arr->toArray();
                   $mobile_no    =  decrypt_value($user_details['patientinfo']['mobile_no']);

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

              $arr_json['status'] =  "success";
              $arr_json['msg']    =  '';
              return response()->json($arr_json);
            }
            else
            {
              $arr_json['status'] =  "error";
              $arr_json['msg']    =  'Invalid credentials, Please try again.';
              return response()->json($arr_json);
            }
    }


    public function back(Request $request)
    { 
        return redirect('/');
    }

   

    public function resend_verification_email($enc_id)
    {
        $user = Sentinel::findById($enc_id);
        if($user)
        {
          
            $activation = Activation::exists($user);
            if($activation)
            {
                $activation_code            =   $activation->code;
                $arr_data['first_name']     =   $user->first_name;
                $arr_data['last_name']      =   $user->last_name;
                $arr_data['email']          =   $user->email;
                $activation_link            =   '<a class="btn_emailer_cls" href="'.url('/patient/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';

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

                $after_seven_days_date = date('y-m-d',strtotime('+6 day',strtotime($user->created_at)));
                
                /*if($after_seven_days_date>date('y-m-d'))
                {*/
                    //$login_status = Sentinel::login($user);
                    Flash::success('Verification email has been send successfully to your registered email id.');
                     $this->arr_view_data['status'] = 'E mail Sent Successfully';
                    $this->arr_view_data['message'] = 'Account verification mail has been sent on your email';
                      return view($this->module_view_folder.'.verification_status')->with($this->arr_view_data);
                    //return redirect(url('/')."/patient/error");
                /*}*/
                /*else
                {
                    $user   = Sentinel::check();
                    if($user)
                    {
                        $res = $user->inRole('patient');
                        if($res)
                        {
                            Flash::success('Verification email has been send successfully to your registered email id.');
                            return redirect(url('/')."/patient/dashboard");
                        }
                        else
                        {
                            Flash::error('Invalid user role.');
                            return redirect(url('/')."/patient/error");   
                        }
                    }
                    else
                    {
                        Flash::error('Invalid user');
                        return redirect(url('/')."/patient/error");
                    }                    
                }*/
            }
            else
            {
                Flash::error('No such a activation available. Please <a href="'.url('/contact-us').'">Contact</a> to Doctoroo admin');
                return redirect(url('/')."/patient/error");
            }
        }
        else
        {
            Flash::error('No such a user available.');
             return redirect(url('/')."/patient/error");
        }
    }
    
    /*To delete user account load view*/
    public function delete_account()
    {   
        $this->arr_view_data['page_title']  = 'Delete Account';
        return view($this->module_view_folder.'.delete_account', $this->arr_view_data);
    }

    public function store_signup_voucher(Request $request)
    {
        $return_arr                  =   array();
        $arr_rules['vemail']         =   "required|email";
        $arr_rules['vfirst_name']    =   "required";
        $arr_rules['vlast_name']     =   "required";
        $arr_rules['vpass_word']     =   "required";
        $arr_rules['vstate']         =   "required";
        $arr_rules['vmob_code']      =   "required";
        $arr_rules['vmobile']        =   "required";
        $arr_rules['vdob']           =   "required";

        $form_data  =   $request->all();

        $date1 = strtr($form_data['vdob'], '/', '-');
        $selected_date=date('Y-m-d', strtotime($date1)); 

        
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Flash::error('Please check your browser javascript setting to allow our website form access. Currently it is denied.');
            return redirect(url('/')."/patient/error");
        }

        $count = $this->PatientModel->where('mobile_no' ,$form_data['vmobile'])
                                  ->count();
        if($count > 0)
        {
            $return_arr['response'] = 'exist';
            $return_arr['message']  = 'An account with this mobile number already exists. Please try another.';
            return Response::json($return_arr);
        }                               

        $num = $this->UserModel->where('email',$form_data['vemail'])->withTrashed()->count();
        if($num > 0)
        {
            $return_arr['response'] = 'exist';
            $return_arr['message']  = 'An account with this email already exists. Please try again with other email.';
            return Response::json($return_arr);
        }

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }


        /* Virgil security */
        // create Virgil api
        $virgilApi = $this->VirgilService->clientToken();
        $userCards = $virgilApi->Cards->get(\Session::get('cardId'));
        
        $arr_data['first_name']     =   $form_data['vfirst_name'];
        $arr_data['last_name']      =   $form_data['vlast_name'];
        $arr_data['email']          =   $form_data['vemail'];
        $arr_data['password']       =   $form_data['vpass_word'];
        $arr_data['dump_id']        =   \Session::get('cardId');
        $arr_data['dump_session']   =   $form_data['virgil_private_key'];
        $arr_data['user_status']    =   'Active';
        $arr_data['is_invited']     =   $randomString;

        // get user id who have refer user
        $referred_by['user_id'] = '';
        $friends_code   = $form_data['friends_code'];
        if( isset($friends_code) && !empty($friends_code) )
        {
            $friend_id = $this->PatientModel->where('my_referral_code', $friends_code )->select('user_id')->first();
            if( isset($friend_id) && count($friend_id) > 0)
            {
                $referred_by = $friend_id->toArray();
            } // end if
            $update_data['referred_point'] = '10';
            $this->PatientModel->where('user_id', $referred_by['user_id'])->update($update_data);
        } // end if

        $user_details['id'] = '0';
        $user_details['email'] = $form_data['vemail'];
        $user_details['patientinfo']['mobile_code'] = $form_data['vmob_code'];
        $user_details['patientinfo']['mobile_no']   = encrypt_value($form_data['vmobile']);

        //$otp= rand(100000, 999999);
        $otp = '123456';
        $otp_id = $this->send_otp($otp,$user_details);

        if($otp_id !='0')
        {
            $user =  Sentinel::register($arr_data);
            if($user)
            {
                $date1 = strtr($form_data['vdob'], '/', '-');
                $selected_date = date('Y-m-d', strtotime($date1)); 

                $patient_data['user_id']                = $user->id;
                $patient_data['suburb']                 = $this->VirgilService->encryptData($userCards,$form_data['vstate']);
                $patient_data['mobile_code']            = $form_data['vmob_code'];
                $patient_data['mobile_no']              = encrypt_value($form_data['vmobile']);
                //$patient_data['mobile_no']              = $form_data['vmobile'];
                $patient_data['referred_by']            = $referred_by['user_id'];
                $patient_data['my_referral_code']       = $randomString;
                $patient_data['friend_referral_code']   = $form_data['friends_code'];
                $patient_data['date_of_birth']          = $selected_date;
                $patient_data['type']                   = 'doctoroo';
                $patient_data['original_profile_type']  = 'doctoroo';

                $user  =  Sentinel::findById($user->id);
                $role  =  Sentinel::findRoleBySlug('patient');
                $user->roles()->attach($role);

                $upd_otp_info['user_id'] = $user->id;

                $this->OtpModel->where('id', $otp_id)
                               ->update($upd_otp_info);

                // create user for twilio chat
                $create_user = $this->create_user($form_data['vfirst_name'].''.$form_data['vlast_name'].''.$user->id);

                $admin_notif['message'] = "Patient - New Registration - ".$form_data['vfirst_name'].' '.$form_data['vlast_name'];
                $this->AdminNotificationModel->create($admin_notif);

                /*$activation =   Activation::create($user);
                $activation_code    =   $activation->code;*/

                $res_patient = $this->PatientModel->create($patient_data);
                if($res_patient)
                {
                    /*$activation_link    ='<a class="btn_emailer_cls" href="'.url('/patient/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
                    $arr_built_content = [ 
                                        'FIRST_NAME'=>$arr_data['first_name'] , 
                                        'APP_NAME'  =>config('app.project.name'),
                                        'ACTIVATION_LINK'=>$activation_link,
                                         ];*/

                    /*$arr_mail_data                      = [];
                    $arr_mail_data['email_template_id'] = '38';
                    $arr_mail_data['arr_built_content'] = $arr_built_content;
                    $arr_mail_data['user']              = $arr_data;
                    $email_status = $this->EmailService->send_mail($arr_mail_data);*/

                    /* -- send mail to client -- */
                    /* content variables in view */

                    $content['first_name']          = $form_data['vfirst_name'];
                    $content['last_name']           = $form_data['vlast_name'];
                    $content['email']               = $form_data['vemail'];
                    //$content['activation_code']   = $activation_code;
                    $content['user_id']             = $user->id;
                    /* end content variables in view */


                    /* built content variables in view */
                    $content             =  view('front.email.coming_soon',compact('content'))->render();
                    $content             =  html_entity_decode($content);
                    /* end built content variables in view */
                   
                    $to_email_id         = $form_data['vemail'];
                    $project_name        = config('app.project.name');
                    $mail_subject        = 'Welcome to '.config('app.project.name');


                    /* get admin email */
                        /*$get_admin_role_id = \DB::table('roles')->where('status','0')->where('is_active','0')->where('slug','=','admin')->orderBy('id','DESC')->get();*/
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

                    $return_arr['otp_id']   =  $otp_id;
                    $return_arr['password'] =  base64_encode($form_data['vpass_word']);
                    $return_arr['email']    =  $form_data['vemail'];

                    //return response()->json($arr_json);

                    //$login_status = Sentinel::login($user);
                    $return_arr['response']         = 'success';
                    $return_arr['message']          = 'Registration has been done successfully.';
                    $return_arr['randomString']     = $randomString;
                    $return_arr['referral_url']     = url('/').'/ICareForYou/'.$randomString;
                    $return_arr['moblie']           = $form_data['vmobile'];
                }
                else
                {
                    $return_arr['otp_id']   =  '';
                    $return_arr['response'] = 'error';
                    $return_arr['message'] = 'Error! Error while creating your account. Please try again later';
                }
            }
            else
            {
                $return_arr['response'] = 'error';
                $return_arr['message'] = 'Error! Some error occured. Please try again later';
            }    
        }
        else
        {
            $return_arr['otp_id']   =  '0';
            $return_arr['response'] = 'mob_error';
            $return_arr['message'] = 'Invalid registered mobile number and country code';
        }

        echo json_encode($return_arr);
    }


    /*public function store_signup_voucher(Request $request)
    { 
        $return_arr                  =   array();
        $arr_rules['vemail']         =   "required|email";
        $arr_rules['vfirst_name']    =   "required";
        $arr_rules['vlast_name']     =   "required";
        $arr_rules['vpass_word']     =   "required";
        $arr_rules['vstate']         =   "required";
        $arr_rules['vmob_code']      =   "required";
        $arr_rules['vmobile']        =   "required";
        $arr_rules['vdob']           =   "required";

        $form_data  =   $request->all();
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Flash::error('Please check your browser javascript setting to allow our website form access. Currently it is denied.');
            return redirect(url('/')."/patient/error");
        }

        $num = $this->UserModel->where('email',$form_data['vemail'])->withTrashed()->count();
        if($num > 0)
        {
            $return_arr['response'] = 'exist';
            $return_arr['message']  = 'An account with this email already exists. Please try again with other email.';
            return Response::json($return_arr);
        }

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $arr_data['first_name']     =   $form_data['vfirst_name'];
        $arr_data['last_name']      =   $form_data['vlast_name'];
        $arr_data['email']          =   $form_data['vemail'];
        $arr_data['password']       =   $form_data['vpass_word'];
        $arr_data['user_status']    =   'Active';
        $arr_data['is_invited']     =   $randomString;

        // get user id who have refer user
        $referred_by['user_id'] = '';
        $friends_code   = $form_data['friends_code'];
        if( isset($friends_code) && !empty($friends_code) )
        {
            $friend_id = $this->PatientModel->where('my_referral_code', $friends_code )->select('user_id')->first();
            if( isset($friend_id) && count($friend_id) > 0)
            {
                $referred_by = $friend_id->toArray();
            } // end if
            $update_data['referred_point'] = '10';
            $this->PatientModel->where('user_id', $referred_by['user_id'])->update($update_data);
        } // end if

        $user                       =   Sentinel::register($arr_data);
        if($user)
        {
            $selected_date = date("Y-d-m",strtotime($form_data['vdob']));

            $patient_data['user_id']                = $user->id;
            //$patient_data['country']                = "Australia";
            $patient_data['suburb']                 = $form_data['vstate'];
            $patient_data['mobile_code']            = $form_data['vmob_code'];
            $patient_data['mobile_no']              = $form_data['vmobile'];
            $patient_data['referred_by']            = $referred_by['user_id'];
            $patient_data['my_referral_code']       = $randomString;
            $patient_data['friend_referral_code']   = $form_data['friends_code'];
            $patient_data['date_of_birth']          = $selected_date;
            $patient_data['type']                   = 'doctoroo';

            $user  =  Sentinel::findById($user->id);
            $role  =  Sentinel::findRoleBySlug('patient');
            $user->roles()->attach($role);

            // create user for twilio chat
            $create_user = $this->create_user($user->first_name.''.$user->last_name.''.$user->id);

            $activation =   Activation::create($user);
            $activation_code    =   $activation->code;

            $res_patient = $this->PatientModel->create($patient_data);
            if($res_patient)
            {
                $activation_link    ='<a class="btn_emailer_cls" href="'.url('/patient/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
                $arr_built_content = [ 
                                    'FIRST_NAME'=>$arr_data['first_name'] , 
                                    'APP_NAME'  =>config('app.project.name'),
                                    'ACTIVATION_LINK'=>$activation_link,
                                     ];

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '38';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $arr_data;
                $email_status = $this->EmailService->send_mail($arr_mail_data);    

                if(!empty($mail_form))
                {
                    $mail_form           = $mail_form;
                }
                else{
                    $mail_form           = config('app.project.admin_email');
                }
                $mail_form               = $mail_form;

                //$login_status = Sentinel::login($user);
                $return_arr['response']         = 'success';
                $return_arr['message']          = 'Registration has been done successfully.';
                $return_arr['randomString']     = $randomString;
                $return_arr['referral_url']     = url('/').'/ICareForYou/'.$randomString;
                $return_arr['moblie']           = $form_data['vmobile'];
            }
            else
            {
                $return_arr['response'] = 'error';
                $return_arr['message'] = 'Error! Error while creating your account. Please try again later';
            }
        }
        else
        {
            $return_arr['response'] = 'error';
            $return_arr['message'] = 'Error! Some error occured. Please try again later';
        }
        echo json_encode($return_arr);
    }*/

    public function check_code(Request $request)
    {
        $friends_code = $request->input('friends_code');
        if($friends_code)
        {
            $get_user_details = $this->PatientModel->with('userinfo')->where('my_referral_code', $friends_code)->first();

            if(count($get_user_details)>0)
            {
                $user_details = $get_user_details->toArray();
                
                $arr_json['status']     =  "success";
                $arr_json['username']   =  $user_details['userinfo']['first_name'];
                return Response::json($arr_json);
            }
            else
            {
                $arr_json['status']     =  "error";
                return Response::json($arr_json);
            }
        }
    }

    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 08/09/2017
    | Output    : Success or Error
    */

    public function sendSms()
    {
        $to = "+918149905936";
        $message = "Doctoroo SMS for OTP, Testing";

        $sid        = env('TWILIO_SMS_SID');
        $token      = env('TWILIO_SMS_TOKEN');
        $twilioNumber   = env('TWILIO_NUMBER');

        $client = new Client($sid, $token);

        $client->messages->create(
            $to,
            [
                "body" => $message,
                "from" => $twilioNumber
            ]
        );
    } // end sendSms

    public function send_otp($otp,$user_details)
    {
        $otp_id = $mob_code = "";

        if($user_details)
        {
            $mobile_code =  $user_details['patientinfo']['mobile_code'];

            $get_mob_data = $this->MobileCountryCodeModel->where('id', $mobile_code)->first();
            if($get_mob_data)
            {
                $mob_data = $get_mob_data->toArray();
                $mob_code = $mob_data['phonecode'];
            }
            $mobile_num =  decrypt_value($user_details['patientinfo']['mobile_no']);
            $mobile_no = '+'.$mob_code.''.$mobile_num;
            $user_id = $user_details['id'];
            $email = $user_details['email'];

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

            Session::put('otp_user_id',$user_id);
            Session::put('otp_mobile_no',$mobile_no);
            
        }

        if(isset($otp) && !empty($otp))
        {
            //$to = "+918149905936";
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

            $otp_id = $this->OtpModel->insertGetId($data_arr);

            return $otp_id;   
        }        
    }
    public function resend_otp(Request $request)
    {
        $otp_id    = "";
        $user_id   = "";
        $mobile_no = "";

        if(Session::has('otp_user_id'))
        {
            $user_id = Session::get('otp_user_id',$user_id);
        }
        if(Session::has('otp_mobile_no'))
        {
            $mobile_no = Session::get('otp_mobile_no',$mobile_no);
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

        $created_on   = date("Y-m-d H:i:s");
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
                //return '0';
                $otp_id = '0';
            }

            if(isset($otp_id) && !empty($otp_id) && $otp_id !='0')
            {
                
                $arr_json['status'] ='success';
                $arr_json['msg'] = 'OTP Resent successfully. Please check your registered mobile number.';
                $arr_json['otp_id'] = $otp_id;
            }
            else if($otp_id == '0')
            {
                $arr_json['status'] ='error';
                $arr_json['msg'] = 'Invalid registered mobile number and country code.';
                $arr_json['otp_id'] = '';   
            }
            else
            {
                $arr_json['status'] ='error';
                $arr_json['msg'] = 'Something went to wrong.';
                $arr_json['otp_id'] = '';
            }
        }
        return response()->json($arr_json);
    }

    public function verify_otp(Request $request)
    {
        $current_datetime   = date("Y-m-d H:i:s");
        $otp_expired = $this->OtpModel->where('id', $request->otp_id)->where('expired_on' ,'>', $current_datetime)->count();

        if($otp_expired > 0)
        {
            $count = $this->OtpModel->where('id', $request->otp_id)
                                    ->where('otp' , $request->otp)
                                    ->count(); 
            if($count > 0)
            {
                $arr_credential['email']    = $request->email;
                $arr_credential['password'] = base64_decode($request->password);
                $check_authentication       = Sentinel::authenticate($arr_credential);
                
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

                    $update_data['login_time'] = date('Y-m-d H:i:s');
                    $update_data['logout_time'] = date('Y-m-d H:i:s', strtotime('+ 30 minutes'));
                  
                    $user_update = $this->UserModel->where('id' ,$user->id)
                                                   ->update($update_data);

                    $arr_json['status'] =  "success";
                    $arr_json['msg']    =  '';
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




    /* Chnage Mobile Nuimber TA */

    public function store_change_mobile_no(Request $request)
    {
            if(!empty($request->input('cpnfirst_name'))){  $cpnfirst_name       =   $request->input('cpnfirst_name');   } else {  $cpnfirst_name       = ''; }
            if(!empty($request->input('cpnlast_name'))){  $cpnlast_name        =   $request->input('cpnlast_name');   } else {  $cpnlast_name        = ''; }
            if(!empty($request->input('old_ph_no'))){  $old_ph_no           =   $request->input('old_ph_no');   } else {  $old_ph_no           = ''; }
            if(!empty($request->input('new_ph_no'))){  $new_ph_no           =   $request->input('new_ph_no');   } else {  $new_ph_no           = ''; }
            if(!empty($request->input('cpndob'))){  $cpndob              =   $request->input('cpndob');   $date1  = strtr($cpndob, '/', '-');   $cpndob = date('Y-m-d', strtotime($date1));  } else {  $cpndob              = ''; }
            if(!empty($request->input('cpnstate'))){  $cpnstate            =   $request->input('cpnstate');   } else {  $cpnstate            = ''; }
            if(!empty($request->input('last_consultation'))){  $last_consultation   =   $request->input('last_consultation'); $last_consultation_date  = strtr($last_consultation, '/', '-');   $last_consultation = date('Y-m-d', strtotime($last_consultation_date));   } else {  $last_consultation   = ''; }
            if(!empty($request->input('additinal_notes'))){  $additinal_notes     =   $request->input('additinal_notes');   } else {  $additinal_notes     = ''; }

            $user_details = $this->UserModel
                        ->select('users.email','users.id','dod_patient.mobile_code')
                        ->join('dod_patient','dod_patient.user_id', '=' , 'users.id')
                        ->where('users.email',$old_ph_no);

                        if($last_consultation != ''){
                            $user_details->join('dod_patient_consultation_booking','dod_patient_consultation_booking.patient_user_id', '=' , 'users.id');
                            $user_details->orderBy('dod_patient_consultation_booking.id','desc');
                            $user_details->limit(1);
                            $user_details->where('dod_patient_consultation_booking.consultation_date',$last_consultation);
                        }

                        if($cpndob != ''){
                            $user_details->where('dod_patient.date_of_birth',$cpndob);
                        }

                        if($cpnstate != ''){
                            //$user_details->where('dod_patient.suburb',$cpnstate);
                        }
                        if($cpnfirst_name != ''){
                            $user_details->where('users.first_name',$cpnfirst_name);
                        }
                        if($cpnlast_name != ''){
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
        $current_datetime   = date("Y-m-d H:i:s");

        if(!empty($request->input('cpnfirst_name'))){  $cpnfirst_name           =   $request->input('cpnfirst_name');     } else {  $cpnfirst_name       = ''; }
        if(!empty($request->input('cpnlast_name'))){  $cpnlast_name             =   $request->input('cpnlast_name');      } else {  $cpnlast_name        = ''; }
        if(!empty($request->input('old_ph_no'))){  $old_ph_no                   =   $request->input('old_ph_no');         } else {  $old_ph_no           = ''; }
        if(!empty($request->input('new_ph_no'))){  $new_ph_no                   =   $request->input('new_ph_no');         } else {  $new_ph_no           = ''; }
        if(!empty($request->input('cpndob'))){  $cpndob                         =   $request->input('cpndob');   $date1  = strtr($cpndob, '/', '-');   $cpndob = date('Y-m-d', strtotime($date1));  } else {  $cpndob              = ''; }
        if(!empty($request->input('cpnstate'))){  $cpnstate                     =   $request->input('cpnstate');          } else {  $cpnstate            = ''; }
        if(!empty($request->input('last_consultation'))){  $last_consultation   =   $request->input('last_consultation'); $last_consultation_date  = strtr($last_consultation, '/', '-');   $last_consultation = date('Y-m-d', strtotime($last_consultation_date));   } else {  $last_consultation   = ''; }
        if(!empty($request->input('additinal_notes'))){  $additinal_notes       =   $request->input('additinal_notes');   } else {  $additinal_notes     = ''; }
        if(!empty($request->input('cpnmob_code'))){  $cpnmob_code       =   $request->input('cpnmob_code');   } else {  $cpnmob_code     = ''; }

       
        $store_data=[]; 

        $store_data['patient_id']         =  $request->cpnuser_id;
        $store_data['doctor_id']          =  '0'; 
        $store_data['first_name']         =  $cpnfirst_name;
        $store_data['last_name']          =  $cpnlast_name;
        $store_data['old_phone_no']       =  $old_ph_no;
        $store_data['new_phone_no']       =  $new_ph_no;
        $store_data['dob']                =  $cpndob;
        $store_data['address']            =  $cpnstate;
        $store_data['last_consult_date']  =  $last_consultation;
        $store_data['additional_notes']   =  $additinal_notes;
        $store_data['new_country_code']   =  $cpnmob_code;



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
                    //$this->PatientModel->where('user_id' , $request->cpnuser_id)->update(['mobile_no'=>$request->cpnnew_mobile_no]);
                    $this->ChangeMobileNoModel->where('patient_id', $request->cpnuser_id)->delete();
                    $this->ChangeMobileNoModel->insertGetId($store_data);

                    $this->OtpModel->where('id', $request->cpnotp_id)
                                   ->where('otp' , $request->cpnotp)
                                   ->delete();
                    $this->OtpModel->where('user_id', $request->cpnuser_id)
                                   ->delete();

                    $admin_notif['message'] = "Patient - Change Mobile No - ".$cpnfirst_name.' '.$cpnlast_name;
                    $this->AdminNotificationModel->create($admin_notif);
                    
                    /* send msg to admin */
                    $get_admin_mo = \DB::table('dod_admin_profile')->select('mobile_no')->first();
                    if(isset($get_admin_mo->mobile_no) && $get_admin_mo->mobile_no != ''){
                        $to = $get_admin_mo->mobile_no;
                        $message = 'You have recieved new mobile number change request from patient';

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
                        ->select('users.email','users.id','dod_patient.mobile_code')
                        ->join('dod_patient','dod_patient.user_id', '=' , 'users.id')
                        ->where('dod_patient.user_id',$user_id)
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

        $created_on = date("Y-m-d H:i:s");
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