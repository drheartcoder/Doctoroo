<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests;
use Twilio\Rest\Client;
use App\Http\Controllers\Controller;

use App\Common\Services\EmailService;
use App\Common\Services\VirgilService;
use App\Models\UserModel;
use App\Models\DoctorModel;
use App\Models\PatientModel;
use App\Models\MobileCountryCodeModel;
use App\Models\OtpModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;
use Reminder;
use URL;
use Session;
use Exception;
use Stripe;

use Virgil\Sdk\Api\VirgilApi;
use Virgil\Sdk\Api\VirgilApiContext;
use Virgil\Sdk\Api\AppCredentials;
use Virgil\Sdk\Buffer;

class AuthController extends Controller
{
    public function __construct(EmailService               $EmailService,
                                VirgilService              $virgil_service,
                                UserModel                  $UserModel,
                                DoctorModel                $DoctorModel,
                                PatientModel               $PatientModel,
                                MobileCountryCodeModel     $mob_country_code,
                                OtpModel                   $OtpModel)
    {
        $this->module_view_folder      = "front";
        $this->EmailService            =  $EmailService;
        $this->VirgilService           =   $virgil_service;
        $this->UserModel               =  $UserModel;
        $this->DoctorModel             =   $DoctorModel;
        $this->PatientModel            =  $PatientModel;
        $this->MobileCountryCodeModel  =   $mob_country_code;
        $this->OtpModel                =   $OtpModel;

        $this->sid                     = config('services.twilio')['accountSid'];
        $this->token                   = config('services.twilio')['auth_token'];
        $this->service_id              = config('services.twilio')['service_id'];
        $this->client                  = new Client($this->sid,$this->token);

    }
    /*common logout function to all users*/
    public function logout($msg=false)
    { 
        $user = Sentinel::check();
        if($user != false)
        {
          $user_online['is_online'] = 0;
          $this->UserModel->where('id',$user->id)->update($user_online);
        }

        Sentinel::logout();
        Session::flush();
        if($msg!=false)
        {
          $message  = $msg;   
          return redirect(url('/thankyou/'.$message)); 
        }
        else
        {
          $message1 = 'Logged Out';
          $message  = 'You\'ve successfully Logged out. Hope to see you back soon!';
          return redirect(url('/thankyou/'.$message.'/'.$message1));    
        }
         
    }
    /*common function for thank you*/
    public function thankyou($message,$message1=false)
    {
        if($message1!=false)
        {
            $this->arr_view_data['message1'] = $message1;    
        }
    	  $this->arr_view_data['message']      = $message;
        return view($this->module_view_folder.'.thankyou',$this->arr_view_data);
    }
    
    /*  
        27 march 2017
        rohini j
        common function to delete user account
    */
    public function close_account(Request $request)
    {

        $arr_rules                             = [];
        $arr_rules['password']                 = "required";
        $arr_credentials                       = [];
        
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            
        $user      = Sentinel::check();
        if($user)
        {

                $arr_credentials['password']  = $request->input('password');
                $arr_credentials['email']     = $user->email;

                if(isset($arr_credentials['email']) && isset($arr_credentials['password']))
                {
                    try {
                                $obj_user = Sentinel::authenticate($arr_credentials);
                                if ($obj_user) 
                                {
                                    $delete_user = Sentinel::findById($obj_user->id);
                                    $delete_user->delete();

                                    if($delete_user)
                                    {
                                            $message   = 'Your account deleted successfully';
                                            return redirect(url('/thankyou/'.$message));  
                                    }
                                    else
                                    {
                                            Flash::error('Error occure while deleting a account.');
                                            return redirect()->back();
                                     }
                                    
                                   
                                } 
                                else 
                                {
                                    Flash::error('Please enter a valid password.');
                                    return redirect()->back();
                                }
                        } 
                        catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) 
                        {

                             Flash::error('Your account is not activated by Admin.');
                            return redirect()->back();
                         
                        }
                }

        }
        else
        {
            return redirect(url('/'));
        }

        
    }
    public function forgotpassword(Request $request)
    { 
      $arr_rules = $arr_json = [];
      $form_data = array();
      $arr_rules['mobile_no'] = "required";
     
      $validator = Validator::make($request->all(),$arr_rules);
      if($validator->fails())
      {
          $arr_json['status'] = "error";
          $arr_json['msg']    = "Enter valid email id";
      }
      
      $form_data = $request->all();

      $email  = $form_data['mobile_no'];
      $user_type  = $form_data['user_type'];

      if(empty($user_type) && $user_type == null)
      {
        $user_type = 'patient';
      }

      if(isset($user_type) && $user_type !='' && $user_type == 'doctor')
      {
          $mobile_code = $mobile_no = $user_id = '';
          $count = $this->UserModel->where('email',$email)->count();
          if($count > 0)
          {
              $user_arr = $this->UserModel->where('email',$email)->with('doctor_details')->whereHas('doctor_details', function($q){
                      $q->where('user_status','Active');
                    })->first();
              if(isset($user_arr) && !empty($user_arr) && $user_arr != null)
              {
                $user = $user_arr->toArray();
                
                $mobile_code = isset($user['doctor_details']['mobile_code']) ? $user['doctor_details']['mobile_code'] : ''; 
                $mobile_no = isset($user['doctor_details']['mobile_no']) ? $user['doctor_details']['mobile_no'] : ''; 
                $user_id = isset($user['id']) ? $user['id'] : ''; 

                if(!empty($user_id))
                {
                  $email_obj = $this->UserModel->where('id' ,$user_id)->select('email')->first();
                  if($email_obj)
                  {
                    $email_arr = $email_obj->toArray();
                    $email = isset($email_arr['email']) ? $email_arr['email'] : ''; 
                  }
                }

              }
              else
              {
                $arr_json['status']  = 'error';   
                $arr_json['msg']  = 'This is not a registered email id.'; 
                return response()->json($arr_json); 
              }
              
              $user_details['doctor_details']['mobile_code'] = $mobile_code;
              $user_details['doctor_details']['mobile_no']   = $mobile_no;
              $user_details['id'] = $user_id;
              $user_details['email'] = $email;

              Session::set('forget_password_user_id', $user_id);

              //$otp= rand(100000, 999999);
              $otp = '123456';
              $otp_id = $this->send_otp($otp,$user_details);
              
              if($otp_id !='0')
              {
                $arr_json['status']  = 'success';
                $arr_json['msg']  = '';
                $arr_json['otp_id']   =  $otp_id;
                $arr_json['email']    =  $email;
              }
              else
              {
                $arr_json['status']  = 'error';   
                $arr_json['msg']  = 'Invalid mobile number.';
              }

             return response()->json($arr_json); 
          }
          else
          {

            $arr_json['status']  = 'error';   
            $arr_json['msg']  = 'This is not a registered email id.'; 
            return response()->json($arr_json); 
          }
          
      }
      else if(isset($user_type) && $user_type !='' && $user_type == 'patient')
      {
          $mobile_code = $mobile_no = $user_id = '';
          $count = $this->UserModel->where('email',$email)->count();
          if($count > 0)
          {
              $user_arr = $this->UserModel->where('email',$email)->with('patientinfo')->whereHas('patientinfo', function($q){
                      $q->where('user_status','Active');
                    })->first();

              if(isset($user_arr) && !empty($user_arr) && $user_arr != null)
              {
                $user = $user_arr->toArray();
                $mobile_code = isset($user['patientinfo']['mobile_code']) ? $user['patientinfo']['mobile_code'] : ''; 
                $mobile_no = isset($user['patientinfo']['mobile_no']) ? $user['patientinfo']['mobile_no'] : ''; 
                $user_id = isset($user['id']) ? $user['id'] : ''; 

                if(!empty($user_id))
                {
                  $email_obj = $this->UserModel->where('id' ,$user_id)->select('email')->first();
                  if($email_obj)
                  {
                    $email_arr = $email_obj->toArray();
                    $email = isset($email_arr['email']) ? $email_arr['email'] : ''; 
                  }
                }

              }
              else
              {
                $arr_json['status']  = 'error';   
                $arr_json['msg']  = 'This is not a registered email id.'; 
                return response()->json($arr_json); 
              }
              
              $user_details['doctor_details']['mobile_code'] = $mobile_code;
              $user_details['doctor_details']['mobile_no']   = $mobile_no;
              $user_details['id'] = $user_id;
              $user_details['email'] = $email;

              Session::set('forget_password_user_id', $user_id);

              //$otp= rand(100000, 999999);
              $otp = '123456';
              $otp_id = $this->send_otp($otp,$user_details);
              
              if($otp_id !='0')
              {
                $arr_json['status']  = 'success';
                $arr_json['msg']  = '';
                $arr_json['otp_id']   =  $otp_id;
                $arr_json['email']    =  $email;
              }
              else
              {
                $arr_json['status']  = 'error';   
                $arr_json['msg']  = 'Invalid mobile number.';
              }

             return response()->json($arr_json); 
          }
          else
          {
            $arr_json['status']  = 'error';   
            $arr_json['msg']  = 'This is not a registered email id.'; 
            return response()->json($arr_json); 
          }

      }


      /*if(isset($user_type) && $user_type !='' && $user_type == 'doctor')
      {

          $mobile_code = $user_id = $email = '';
          $count = $this->DoctorModel->where('mobile_no',$mobile_no)->count();
          if($count > 0)
          {

              $user_arr = $this->DoctorModel->where('mobile_no',$mobile_no)->first();
              if(isset($user_arr) && !empty($user_arr))
              {
                $user = $user_arr->toArray();
                
                $mobile_code = isset($user['mobile_code']) ? $user['mobile_code'] : ''; 
                $user_id = isset($user['user_id']) ? $user['user_id'] : ''; 

                if(!empty($user_id))
                {
                  $email_obj = $this->UserModel->where('id' ,$user_id)->select('email')->first();
                  if($email_obj)
                  {
                    $email_arr = $email_obj->toArray();
                    $email = isset($email_arr['email']) ? $email_arr['email'] : ''; 
                  }
                }

              }
              
              $user_details['doctor_details']['mobile_code'] = $mobile_code;
              $user_details['doctor_details']['mobile_no']   = $form_data['mobile_no'];
              $user_details['id'] = $user_id;
              $user_details['email'] = $email;

              Session::set('forget_password_user_id', $user_id);

              $otp= rand(100000, 999999);
              $otp_id = $this->send_otp($otp,$user_details);
              
              if($otp_id !='0')
              {
                $arr_json['status']  = 'success';
                $arr_json['msg']  = '';
                $arr_json['otp_id']   =  $otp_id;
                $arr_json['email']    =  $email;
              }
              else
              {
                $arr_json['status']  = 'error';   
                $arr_json['msg']  = 'Invalid mobile number.';
              }

             return response()->json($arr_json); 
          }
          else
          {

            $arr_json['status']  = 'error';   
            $arr_json['msg']  = 'This is not a registered mobile number.'; 
            return response()->json($arr_json); 
          }
          
      }
      else if(isset($user_type) && $user_type !='' && $user_type == 'patient')
      {
          $mobile_code = $user_id = $email = '';
          $count = $this->PatientModel->where('mobile_no',$mobile_no)->count();
          if($count > 0)
          {

              $user_arr = $this->PatientModel->where('mobile_no',$mobile_no)->first();
              if(isset($user_arr) && !empty($user_arr))
              {
                $user = $user_arr->toArray();
                $mobile_code = isset($user['mobile_code']) ? $user['mobile_code'] : ''; 
                $user_id = isset($user['user_id']) ? $user['user_id'] : ''; 

                if(!empty($user_id))
                {
                  $email_obj = $this->UserModel->where('id' ,$user_id)->select('email')->first();
                  if($email_obj)
                  {
                    $email_arr = $email_obj->toArray();
                    $email = isset($email_arr['email']) ? $email_arr['email'] : ''; 
                  }
                }

              }
              
              $user_details['doctor_details']['mobile_code'] = $mobile_code;
              $user_details['doctor_details']['mobile_no']   = $form_data['mobile_no'];
              $user_details['id'] = $user_id;
              $user_details['email'] = $email;

              Session::set('forget_password_user_id', $user_id);

              $otp= rand(100000, 999999);
              $otp_id = $this->send_otp($otp,$user_details);
              
              if($otp_id !='0')
              {
                $arr_json['status']  = 'success';
                $arr_json['msg']  = '';
                $arr_json['otp_id']   =  $otp_id;
                $arr_json['email']    =  $email;
              }
              else
              {
                $arr_json['status']  = 'error';   
                $arr_json['msg']  = 'Invalid mobile number.';
              }

             return response()->json($arr_json); 
          }
          else
          {

            $arr_json['status']  = 'error';   
            $arr_json['msg']  = 'This is not a registered mobile number.'; 
            return response()->json($arr_json); 
          }

      }*/
    }

    public function built_mail_data_forgot_password($email,$reminder_code)
    {
      $user = $this->get_user_details($email);
      if($user)
      {
          $arr_user = $user->toArray();
          $reminder_url = '<a target="_blank" style="background:#fa8612; color:#fff; text-align:center;border-radius: 4px; padding: 15px 18px; text-decoration: none;" href=" '.URL::to('resetpassword/'.base64_encode($arr_user['id']).'/'.base64_encode($reminder_code) ).'">Reset Password</a>.<br/>' ;

          $arr_built_content = ['FIRST_NAME'     => $arr_user['first_name'],
                                'EMAIL'          => $arr_user['email'],
                                'REMINDER_URL'   => $reminder_url,
                                'SITE_URL'       => config('app.project.name')];

          $arr_mail_data                      = [];
          $arr_mail_data['email_template_id'] = '7';
          $arr_mail_data['arr_built_content'] = $arr_built_content;
          $arr_mail_data['user']              = $arr_user;

          return $arr_mail_data;
      }
      return FALSE;
    }

    public function get_user_details($email)
    {
        $credentials = ['email' => $email];
        $user = Sentinel::findByCredentials($credentials); // check if user exists

        if($user)
        {
          return $user;
        }
        return FALSE;
    }

    public function resetpassword($enc_id)
    { 
        $user_id            = base64_decode($enc_id);

        $user = Sentinel::findById($user_id);
        if(!$user)
        {
            Flash::error('Invalid User Request');
            return redirect('/');
        }
        else if($user)
        {
            $this->arr_view_data['enc_id']                 = $user_id;
            return view($this->module_view_folder.'.resetpassword',$this->arr_view_data);
        }
        else
        {
            Flash::error('Reset Password Link Expired');
            return redirect(url('/')."/patient/error");
        }

    }

    public function store_resetpassword(Request $request,$enc_id)
    {
        $path          = '';
        $user_id       = base64_decode($enc_id);
        

        $form_data     = array();
        $form_data     = $request->all();

        $user = Sentinel::findById($user_id); 
        if($user)
        {
          $res = $this->UserModel->where('id',$user_id)
                                 ->update(['password'=>bcrypt($form_data['password'])]);

          if($res)
          {
              $this->arr_view_data['status'] = 'Password Reset';
              $this->arr_view_data['message'] = 'Your Password reset successfully';  
              return view($this->module_view_folder.'.status')->with($this->arr_view_data);
          }  
          else
          {
            return redirect()->back()->with('message', 'Error while reset the password.'); 
          }                                  
        } 
        else
        {
            return redirect()->back()->with('message', 'Error while reset the password.');
        }   
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
            $message = $otp." - your doctoroo security password reset code ";

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

    public function verify_otp_forget_password(Request $request)
    {
      if(Session::has('forget_password_user_id') && !empty(Session::get('forget_password_user_id')))
      {
        $user_id = Session::get('forget_password_user_id');

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
                $arr_json['status'] =  "success";
                $arr_json['msg']    =  '';
                $arr_json['id']     = base64_encode($user_id);
                    
                $this->OtpModel->where('id', $request->otp_id)
                               ->where('otp' , $request->otp)
                               ->delete();

                $this->OtpModel->where('user_id', $user_id)
                               ->delete();
                  
                $current_datetime = date('Y-m-d H:i:s');                                                                                  
                  
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
      }
      else
      {
          $arr_json['status'] = 'error';
          $arr_json['msg'] = 'Something went to wrong ! Please try again later.';
      } 
      
                                       

        return response()->json($arr_json);                      
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
            $message = $otp." - your doctoroo security password reset code  ";

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
            }
            else
            {
                $arr_json['status'] ='error';
                $arr_json['msg'] = 'Something went to wrong.';
                $arr_json['otp_id'] = '';
            }

            return response()->json($arr_json);
        }
    }

    /* Fetching card from virgil */
    public function transmitToServer(Request $request)
    {
        $cardAsString = $request->input('exportedCard');
        //$userKey      = $request->input('userKey');

        /*$vapi = $this->VirgilService->clientToken();
        $vapi->Keys->save($username, $password);  */

        $virgilApi = $this->VirgilService->serverToken();

        // import a Virgil Card from string
        $importedCard  = $virgilApi->Cards->import($cardAsString);
        $publishedCard = $virgilApi->Cards->publish($importedCard);

        $cardId = $importedCard->getCard()->getId();

        Session::put('cardId', $cardId);

        if($cardId != '')
        {
            $status = 'success';
        }
        else
        {
            $status = 'error';
        }
        $data = array('status' => $status);
        return response()->json($data);
    }    

}
?>