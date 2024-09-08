<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\DoctorModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\AvailabilityModel;
use App\Models\IPAddressModel;
use App\Models\AdminProfileModel;

use App\Common\Services\EmailService;
use Twilio\Rest\Client;

use Flash;
use Paginate;
use Sentinel;
use Activation;
Use Validator;
use Mail;
use DateTime;
use DateTimeZone;
use DateInterval;

class DashboardController extends Controller
{
    public function __construct(UserModel                       $user_model,
                                DoctorModel                     $doctor_model,
                                PatientConsultationBookingModel $patient_booking,
                                AvailabilityModel               $availability_model,
                                IPAddressModel                  $IPAddressModel,
                                EmailService                    $EmailService,
                                AdminProfileModel               $AdminProfileModel
                                )
    {

        $this->arr_view_data      = [];

        $this->UserModel                           = $user_model;
        $this->DoctorModel                         = $doctor_model;
        $this->PatientConsultationBookingModel     = $patient_booking;
        $this->AvailabilityModel                   = $availability_model;
        $this->IPAddressModel                      = $IPAddressModel;
        $this->EmailService                        = $EmailService;
        $this->AdminProfileModel                   = $AdminProfileModel;


      	$this->module_view_folder                   = 'front.doctor';
        $this->module_doctor_folder                 = 'front.doctor';
        $this->module_url_path                      = url('/').'/doctor/profile';

        $this->sid                                  = config('services.twilio')['accountSid'];
        $this->token                                = config('services.twilio')['auth_token'];
        $this->service_id                           = config('services.twilio')['service_id'];
        $this->client                               = new Client($this->sid,$this->token);

        $user                                       = Sentinel::check();
        $this->user_id                              = '';

        if($user!=false)
        {
           $this->user_id                           = $user->id;
           $this->user_first_name                   = $user->first_name;
           $this->user_last_name                    = $user->last_name;
        }
        else
        {
           $this->user_id                           = null;
           $this->user_first_name                   = null;
           $this->user_last_name                    = null;
        }


    }



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 05/04/2017
    | Output    : 
    */

    public function continue_session()
    {
        $logintime = date('Y-m-d H:i:s');
        $logouttime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($logintime)));

        $update_data['login_time'] = $logintime;
        $update_data['logout_time'] = $logouttime;
      
        $user_update = $this->UserModel->where('id' ,$this->user_id)->update($update_data);

        if($user_update)
        {
          $arr_response['status'] = 'success'; 
          $arr_response['login_time'] = $logintime;
          $arr_response['logout_time'] = $logouttime;
        }
        else
        {
          $arr_response['status'] = 'error'; 
        }

        return response()->json($arr_response);

    } // end continue_session
   
    public function index()
    {
          $arr_doctor_data    = $arr_booking_data = [];
          $arr_doctor_data    = get_doctor_profile_data();

          /* get patient consultation booking details */
          $arr_booking_data   = $this->get_booking_details();

          $username = $this->user_first_name.''.$this->user_last_name.''.$this->user_id;

          // check if user already exists in twilio
          $check_user_exists = $this->check_user_exists($username);        
          if($check_user_exists != 1)
          {
            // create user for twilio chat
            $create_user = $this->create_user($username);
          }

          $this->arr_view_data['arr_booking_data'] = $arr_booking_data;
          $this->arr_view_data['module_url_path']  = $this->module_url_path;
          $this->arr_view_data['arr_doctor_data']  = $arr_doctor_data;
          $this->arr_view_data['page_title']       = 'Doctor Dashboard';

          return view($this->module_view_folder.'.dashboard',$this->arr_view_data);
    }

    public function get_booking_details()
    {
          $arr_booking_data      = [];
          $obj_patient_booking   = $this->PatientConsultationBookingModel->where('doctor_user_id',$this->user_id)
                                                                         ->where('booking_status','Pending')
                                                                         ->with(['patient_user_details'=>function($q){

                                                                              $q->select('id','first_name','last_name');

                                                                         }])
                                                                         ->orderBy('id','desc')
                                                                         ->take(5)
                                                                         ->get();
          if($obj_patient_booking)
          {
              $arr_booking_data  = $obj_patient_booking->toArray();
          }
          return $arr_booking_data;

    }




    public function new_device_used(Request $request)
    {
          $form_data = $request->all();

          $current_datetime   = date("D M d Y H:i:s").' UTC';
          $current_date       = date("Y-m-d");
          $current_time       = date("H:i:s");
          $user_ip            = $_SERVER['REMOTE_ADDR'];
          $user_agent         = $_SERVER['HTTP_USER_AGENT'];
          $data['ip_address'] = $user_ip;
          $data['browser_os'] = $user_agent;

          $get_data = $this->IPAddressModel->where('user_id', $this->user_id)->first();
          if(count($get_data) > 0)
          {
              if($user_ip != $get_data['ip_address'])
              {
                  $update_data = $this->IPAddressModel->where('user_id', $this->user_id)->update($data);

                  /*
                  $arr_built_content = [ 
                                      'FIRST_NAME'       => $this->user_first_name,
                                      'APP_NAME'         => config('app.project.name'),
                                      'BROWSER_OS'       => $data['browser_os'],
                                      'CURRENT_DATETIME' => $current_datetime,
                                       ];

                  $arr_mail_data                      = [];
                  $arr_mail_data['email_template_id'] = '43';
                  $arr_mail_data['arr_built_content'] = $arr_built_content;
                  $arr_mail_data['user']              = $arr_data;
                  $email_status = $this->EmailService->send_mail($arr_mail_data);*/


                    /* -- send mail to client -- */
                    /* content variables in view */
                    $user = Sentinel::findById($this->user_id);
                    $content['first_name']          = $user->first_name;
                    $content['last_name']           = $user->last_name;
                    $content['email']               = $user->email;
                    $content['user_id']             = $user->id;
                    $content['browser_os']          = $data['browser_os'];
                    $content['datetime']            = $current_datetime;
                    $content['city']                = $form_data['locality'];
                    /* end content variables in view */


                    /* built content variables in view */
                    $content             =  view('front.email.new_device',compact('content'))->render();
                    $content             =  html_entity_decode($content);
                    /* end built content variables in view */
                   
                    $to_email_id         = $user->email;
                    $project_name        = config('app.project.name');
                    $mail_subject        = 'Your '.config('app.project.name').' Account login from new Device';


                    /* get admin email */
                    $get_admin           = $this->AdminProfileModel->first();
                    $get_admin           = $get_admin->toArray();
                    $mail_form           = $get_admin['contact_email'];
                    /* end get admin email */    

                    if(!empty($mail_form))
                    {
                        $mail_form       = $mail_form;
                    }
                    else{
                        $mail_form       = config('app.project.admin_email');
                    }
                    $mail_form           = $mail_form;

                    $send_mail = Mail::send(array(), array(), function ($message) use ($to_email_id, $mail_form, $project_name, $mail_subject, $content) {
                          $message->from($mail_form, $project_name);
                          $message->to($to_email_id)
                                  ->subject($mail_subject)
                                  ->setBody($content, 'text/html');
                    });
                    /* -- end  mail to client-- */


              }
          }
          else
          {
              $data['user_id'] = $this->user_id;
              $store_ip = $this->IPAddressModel->create($data);
          }

    } // new new_device
    
    
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


    /*
    | Function  : Check if user already exists or not
    | Author    : Deepak Arvind Salunke
    | Date      : 16/12/2017
    | Output    : Success or Error
    */

    public function check_user_exists($username)
    {
        
        try
        {
            // Create the user
            $user = $this->client->chat
                         ->services($this->service_id)
                         ->users($username)
                         ->fetch();

            return 1;
        }
        catch(\Exception $e)
        {
          return 0;
        }
        
    } // end check_user_exists

}

?>