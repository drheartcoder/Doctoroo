<?php //Seema

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\OtpModel;
use App\Models\AdminProfileModel;

use Twilio\Rest\Client;

use Validator;
use Flash;
use Sentinel;
use Mail;
use Hash;
use Session;
use Exception;

class AuthController extends Controller
{
  public $arr_view_data;
  public $admin_panel_slug;

  public function __construct(UserModel $user, OtpModel $OtpModel, AdminProfileModel $AdminProfileModel)
  {
      $this->UserModel            = $user;
      $this->OtpModel             = $OtpModel;
      $this->AdminProfileModel    = $AdminProfileModel;

      $this->arr_view_data        = [];
      $this->admin_panel_slug     = config('app.project.admin_panel_slug');
  }

  /*---Seema--*/
  public function login()
  {

      $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
      $this->arr_view_data['page_title']       = "Login";
      return view('admin.auth.login',$this->arr_view_data);
  }

  /*---Seema--*/
  public function process_login(Request $request)
  {    
    $admin_path = config('app.project.admin_panel_slug');
    
      $validator = Validator::make($request->all(),[
        'email'    => 'required|max:255',
        'password' => 'required'
      ]);
      if($validator->fails())
      {
        redirect(config('app.project.admin_panel_slug').'/login')
            ->withErrors($validator)
            ->withInput($request->all());
      }

      $login_details =[
              'email' => $request->input('email'),  
              'password' => $request->input('password'),
      ];
      
      $check_auth = Sentinel::authenticate($login_details);
      if($check_auth)
      {
          $user = Sentinel::check();
          if($user->inRole('admin'))
          {
            Sentinel::logout();
            Session::flush();

            $email = $login_details['email'];
            $password = $login_details['password'];
            $user_arr =$this->UserModel->where('email' ,$email)
                                       ->with('admin_details')           
                                       ->first();

            if($user_arr)
            {
               $user_details = $user_arr->toArray();
               $mobile_no =  $user_details['admin_details']['mobile_no'];

               if(empty($mobile_no) || $mobile_no == null)
                {
                    Flash::error('Your mobile number is not registered');
                    return redirect()->back();
                }
            }

            //$otp = rand(100000, 999999);
            $otp = '123456';

            $otp_id = $this->send_otp($otp,$user_details);

            if($otp_id == '0')
            {
              Flash::error('Invalid registered mobile number and country code.');
              return redirect()->back(); 
            }

            $arr_ret['otp_id']   =  $otp_id;
            $arr_ret['password'] =  $password;
            $arr_ret['email']    =  $email;

            Session::set('admin_credentials', $arr_ret);

            return redirect(config('app.project.admin_panel_slug').'/otp_verification');
          }
          else
          {
            Flash::error('Not Sufficient Privileges');
            return redirect()->back();
          }
      }
      else
      {
        Flash::error('Invalid Login Credential');
        return redirect()->back();
      }      
 
    }

    public function otp_verification()
    {
      $arr_ret['otp_id'] = Session::get('admin_credentials.otp_id') ? Session::get('admin_credentials.otp_id') : '';
      $arr_ret['password'] = Session::get('admin_credentials.password') ? Session::get('admin_credentials.password') : '';
      $arr_ret['email'] = Session::get('admin_credentials.email') ? Session::get('admin_credentials.email') : '';
            
      
       return view('admin.auth.verify_otp')->with($arr_ret);
    }

    /*---Seema--*/
    public function change_password()
    {
      
      $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
      $this->arr_view_data['page_title']       = "Change Password";
      return view('admin.auth.change_password',$this->arr_view_data);
    }

    /*---Seema--*/
    public function update_password(Request $request)
    {  
        $form_data = [];
        $validator = Validator::make($request->all(),[
            'current_password' => 'required',
            'new_password'     => 'required|confirmed'
        ]);
        if($validator->fails())
        {
            redirect(config('app.project.admin_panel_slug').'/change_password')->withErrors($validator)->withInput($request->all());
        }


        $user = Sentinel::check();
        $form_data = $request->all();
        $credentials = [];

        $credentials['password'] = $request->input('current_password');
      
        if($form_data['current_password']==$form_data['new_password'])
        {
          Flash::error('Current password & new password should not be same.');
          return redirect()->back();
        }
        else
        {
              if(Sentinel::validateCredentials($user,$credentials)) 
              { 
                  $new_credentials = [];
                  $new_credentials['password'] = $request->input('new_password');                                           
                  if(Sentinel::update($user,$new_credentials))
                  {
                    Flash::success('Password Change Successfully');
                  }
                  else
                  {
                    Flash::error('Problem Occured, While Changing Password');
                  }
              }
              else
              {
                 Flash::error('Invalid Current Password');
              }

        }

        return redirect()->back(); 

    }

    public function forgot_password(Request $request)
    {
        $arr_rules          = array();
        $arr_rules['mobile_no'] = 'required';
        $validator          = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $mobile_code = $user_id = $email = '';
        $admin_obj = $this->AdminProfileModel->get();
        
        if($admin_obj)
        {
           $admin_arr = $admin_obj->toArray();
           $count = '0';
           if(isset($admin_arr) && !empty($admin_arr))
           {
              foreach ($admin_arr as $val)
              {
                  $mobile_code = substr($val['mobile_no'], 0, 3);
                  $no = substr($val['mobile_no'], 3);
                  if($no == $request->mobile_no)
                  {
                    $user_id =  $val['user_id'];
                    $count++; 
                  }
              }
           }
        }

        if($count > 0)
        {
            $user_arr = $this->AdminProfileModel->where('user_id',$user_id)->first();
            if(isset($user_arr) && !empty($user_arr))
            {
              $user = $user_arr->toArray();

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
            
            $user_details['admin_details']['mobile_code'] = $mobile_code;
            $user_details['admin_details']['mobile_no']   = $mobile_code.$request->mobile_no;
            $user_details['id'] = $user_id;
            $user_details['email'] = $email;

            //Session::set('forget_password_user_id', $user_id);

            //$otp= rand(100000, 999999);
            $otp = '123456';
            $otp_id = $this->forget_password_send_otp($otp,$user_details);
            
            if($otp_id !='0')
            { 
              $data['otp_id']   = $otp_id ;
              $data['email']    = $email;
              $data['user_id']  = $user_id;

              Session::set('admin_details',$data);
              return redirect(config('app.project.admin_panel_slug').'/forget_password/verify_otp');
            }
            else
            {
              Flash::error('Invalid mobile number');
              Session::set('mobile_no_err','invalid_no');
              return redirect()->back();   
            }
        }
        else
        {
          Session::set('mobile_no_err','not_registered');
          Flash::error('This mobile number is not registered');
          return redirect()->back();   
        }
    }

    /*--Seema---*/
    public function reset_password($enc_user_id=null)
    {
        $arr_view_data               = array();
        $arr_view_data['page_title'] = 'Reset Password';

        if($enc_user_id)
        {
          $user_details = $this->UserModel->where('id',base64_decode($enc_user_id))->first();

          if($user_details!=FALSE)
          {
              $arr_view_data['user_details'] = $user_details->toArray();
              return view('admin.auth.reset_password',$arr_view_data);
          }
          else
          {
            Flash::error('You don\'t have sufficient privileges.');
          }

        }
        else
        {
          Flash::error('Invalid Request.');
        }
    }


    /*--Seema--*/
    public function update_reset_password($enc_id=null,Request $request)
    {
        if($enc_id)
        {
          $arr_rules = array();

          $arr_rules['password']         = 'required';
          $arr_rules['confirm_password'] = 'required';

          $validator = Validator::make($request->all(),$arr_rules);
          if($validator->fails())
          {
              return redirect()->back()->withErrors($validator)->withInput($request->all());
          }

          $user_id   = base64_decode($enc_id);
          $user_data = $this->UserModel->where('id',$user_id)->first(); 

          if(isset($user_data) && sizeof($user_data)>0)
          {
              $credentials = array();
              $new_credentials['password'] = $request->input('password'); 

              $user = Sentinel::findById($user_id);

              if($user)
              {
                  if(Sentinel::update($user,$new_credentials))
                  { 
                      Flash::success('Password reset successfully.');
                  }
                  else
                  {
                      Flash::error('Problem occured, while reseting password.'); 
                  }
              }
              else
              {
                  Flash::error('Invalid Request.'); 
              }
          }
          else
          {
              Flash::error('Invalid User.'); 
          }
        }
        else
        {
          Flash::error('Invalid Request.'); 
        }

        return redirect(config('app.project.admin_panel_slug').'/login');
        
    }


    /*---Seema--*/
    public function logout()
    {
     Sentinel::logout();
     return redirect(url($this->admin_panel_slug));
    }

    /*--------------------------------------------------------------------------
                                    SEND OTP
    -----------------------------------------------------------------------------*/

    public function send_otp($otp,$user_details)
    {
        $otp_id = "";

        if($user_details)
        {
            $user_id      =  $user_details['id'];
            $email        =  $user_details['email'];
            $mobile_no    =  $user_details['admin_details']['mobile_no'];

            $created_on   = date("Y-m-d H:i:s");
            
            $expired_on   = date("Y-m-d H:i:s",strtotime("+10 minutes",strtotime($created_on)));

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

            $otp_id = $this->OtpModel->insertGetId($data_arr);
            
        }

        if(isset($otp) && !empty($otp) && isset($otp_id))
        {
            $to = $mobile_no;
            $message = $otp." - your doctoroo security login code ";

            $sid          = env('TWILIO_SMS_SID');
            $token        = env('TWILIO_SMS_TOKEN');
            $twilioNumber = env('TWILIO_NUMBER');

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

    public function send_otp_by_ajax(Request $request)
    {
       
        $otp  = rand(100000, 999999);
        $user = Sentinel::check();


        if($user != null)
        {
            $user_id      =  $user->id;
            $email        =  $user->email;
   
            $getadmin = \DB::table('dod_admin_profile')->where('user_id', $user_id)->first();


            if(!isset($getadmin->mobile_no) || $getadmin->mobile_no == ""){
               Flash::error('Your not having mobile number , please update your mobile no.'); 
               redirect()->back();
            }

            $mobile_no    =  $getadmin->mobile_no;

            $created_on   = date("Y-m-d H:i:s");
            
            $expired_on   = date("Y-m-d H:i:s",strtotime("+10 minutes",strtotime($created_on)));

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

            $otp_id = $this->OtpModel->insertGetId($data_arr);
            
        }
        else  {
             Flash::error('Something went wrong, Please try again later.'); 
             redirect()->back();
          }

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
                return '0';
            }

        }
        if($otp_id){
          echo "success";
        }else{
          echo "error";
        }
        //return $otp_id;
    }

    /*--------------------------------------------------------------------------
                                    RESEND OTP
    -----------------------------------------------------------------------------*/

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

        $otp = rand(100000, 999999);

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

            $status = $client->messages->create(
                $to,
                [
                    "body" => $message,
                    "from" => $twilioNumber
                ]
            );

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
        }
        return response()->json($arr_json);
    }

    /*--------------------------------------------------------------------------
                            FORGET PASSWORD - RESEND OTP
    -----------------------------------------------------------------------------*/

    public function forget_password_resend_otp(Request $request)
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

        $otp = rand(100000, 999999);

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

            $status = $client->messages->create(
                $to,
                [
                    "body" => $message,
                    "from" => $twilioNumber
                ]
            );

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
        }
        return response()->json($arr_json);
    }

    /*--------------------------------------------------------------------------
                                    FORGET PASSWORD - SEND OTP
    -----------------------------------------------------------------------------*/

    public function forget_password_send_otp($otp,$user_details)
    {
        $otp_id = "";

        if($user_details)
        {
            $user_id =  $user_details['id'];
            $email   =    $user_details['email'];
            $mobile_no =  $user_details['admin_details']['mobile_no'];

            $created_on   = date("Y-m-d H:i:s");
            
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

            $otp_id = $this->OtpModel->insertGetId($data_arr);
            
        }

        if(isset($otp) && !empty($otp) && isset($otp_id))
        {
            $to = $mobile_no;
            $message = $otp." - your doctoroo security reset password code ";

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

    /*--------------------------------------------------------------------------
                                    OTP VERIFICATION
    -----------------------------------------------------------------------------*/

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
                $arr_credential['password'] = $request->password;
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

                $arr_json['status'] = 'success';
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

     public function verify_otp_by_ajax(Request $request)
    {
        $current_datetime   = date("Y-m-d H:i:s");

        $otp_expired = $this->OtpModel->where('email', $request->email)
                                ->where('expired_on' ,'>', $current_datetime)
                                ->count();


        if($otp_expired > 0)
        {
            $count = $this->OtpModel->where('otp' , $request->otp)->count(); 
            if($count > 0)
            {
                    $this->OtpModel->where('otp' , $request->otp)->delete();
                
                    $arr_json['status'] =  "success";
                    $arr_json['msg']    =  '';
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

    /*--------------------------------------------------------------------------
                      FORGET PASSWORD - OTP VERIFICATION FORM
    -----------------------------------------------------------------------------*/

    public function forget_password_verify_otp()
    {
      if(Session::has('admin_details') && !empty(Session::get('admin_details')))
      {
       $admin_details = Session::get('admin_details'); 

       $this->arr_view_data['otp_id'] = $admin_details['otp_id'];
       $this->arr_view_data['email'] = $admin_details['email'];
       $this->arr_view_data['user_id'] = $admin_details['user_id'];
       return view('admin.auth.forget_password_verify_otp')->with($this->arr_view_data);
      }
    }

    /*--------------------------------------------------------------------------
                            FORGET PASSWORD - OTP VERIFICATION
    -----------------------------------------------------------------------------*/

    public function forget_password_otp_verification(Request $request)
    {
        $form_data = $request->all();

        $otp_id = $form_data['otp_id'];
        $otp = $form_data['verify_forget_password_otp'];
        $user_id = $form_data['user_id'];

        $current_datetime   = date("Y-m-d H:i:s");

        $otp_expired = $this->OtpModel->where('id', $otp_id)
                                ->where('expired_on' ,'>', $current_datetime)
                                ->count();                             
        if($otp_expired > 0)
        {
            $count = $this->OtpModel->where('id', $otp_id)
                                    ->where('otp' , $otp)
                                    ->count();                                              
            if($count > 0)
            {
                $arr_json['status'] =  "success";
                $arr_json['msg']    =  '';
                $arr_json['id']     = base64_encode($user_id);
                    
                $this->OtpModel->where('id', $otp_id)
                               ->where('otp' , $otp)
                               ->delete();

                $this->OtpModel->where('user_id', $user_id)
                               ->delete();
                  
                $current_datetime = date('Y-m-d H:i:s');                                                                                  
                return redirect(config('app.project.admin_panel_slug').'/reset_password/'.base64_encode($user_id));  
                return response()->json($arr_json);
            } 
            else
            {
                 Flash::error('Invalid OTP. Please try again');
                 return redirect()->back();
            }
        }
        else
        {
          Flash::error('Your OTP is expired ! Please Resend otp');
          return redirect()->back();
            
        }
      /*}
      else
      {
          $arr_json['status'] = 'error';
          $arr_json['msg'] = 'Something went to wrong ! Please try again later.';
      } */

    }

}
