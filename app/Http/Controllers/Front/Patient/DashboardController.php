<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\PatientConsultationPaymentModel;
use App\Models\PatientConsultationImagesModel;
use App\Models\DoctorModel;
use App\Models\IPAddressModel;
use App\Models\LanguageModel;
use App\Models\NotificationModel;
use App\Models\MobileCountryCodeModel;
use App\Models\AdminProfileModel;

use Twilio\Rest\Client;
use App\Common\Services\EmailService;

use Validator;
use Flash;
use Sentinel;
use Activation;
use Reminder;
use URL;
use Session;
use DB;
use PDF;
use Mail;
use DateTime;
use DateTimeZone;
use DateInterval;

class DashboardController extends Controller
{

    public function __construct(UserModel                       $UserModel,
                                PatientModel                    $PatientModel,
                                EmailService                    $EmailService,
                                PatientConsultationBookingModel $consultation_model,
                                DoctorModel                     $doctor_model,
                                PatientConsultationImagesModel  $PatientConsultationImagesModel,
                                IPAddressModel                  $IPAddressModel,
                                LanguageModel                   $language_model,
                                NotificationModel               $NotificationModel,
                                MobileCountryCodeModel          $MobileCountryCodeModel,
                                PatientConsultationPaymentModel $PatientConsultationPaymentModel,
                                AdminProfileModel               $AdminProfileModel
                                )
    {   
        $this->arr_view_data[]                      = [];
        $this->UserModel                            = $UserModel;
        $this->PatientModel                         = $PatientModel;
        $this->PatientConsultationBookingModel      = $consultation_model;
        $this->PatientConsultationImagesModel       = $PatientConsultationImagesModel;
        $this->PatientConsultationPaymentModel      = $PatientConsultationPaymentModel;
        $this->DoctorModel                          = $doctor_model;
        $this->IPAddressModel                       = $IPAddressModel;
        $this->LanguageModel                        = $language_model;
        $this->EmailService                         = $EmailService;
        $this->NotificationModel                    = $NotificationModel;
        $this->MobileCountryCodeModel               = $MobileCountryCodeModel;
        $this->AdminProfileModel                    = $AdminProfileModel;

        $this->module_title                         = "Dashboard";
        $this->module_view_folder                   = 'front.patient';
        $this->module_url_path                      = url('/').'/patient/dashboard';
        
        $this->doctor_image_url                     = url('/public').config('app.project.img_path.doctor_image');
        $this->patient_uploads_url                  = public_path().config('app.project.img_path.patient_uploads');
        $this->patient_uploads_base_url             = url('/public').config('app.project.img_path.patient_uploads');
        $this->consultation_documents_base_url      = url('/public').config('app.project.img_path.consultation_documents');
        $this->consultation_documents_public_url    = public_path().config('app.project.img_path.consultation_documents');

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

        DB::connection()->enableQueryLog();
        //$queries = DB::getQueryLog();

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


    /*
    | Function  : Redirect to dashboard after signin
    | Author    : Deepak Arvind Salunke
    | Date      : 29/06/2017
    | Output    : View dashboard
    */

    public function dashboard()
    {
        $username = $this->user_first_name.''.$this->user_last_name.''.$this->user_id;

        // check if user already exists in twilio
        $check_user_exists = $this->check_user_exists($username);        
        if($check_user_exists != 1)
        {
          // create user for twilio chat
          $create_user = $this->create_user($username);
        }

        Session::forget('inserted_family_member_id');
        
        if($this->user_id != '')
        {
            $get_new_consult    = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                        ->where('booking_status', 'Pending')
                                                                        ->orderBy('id','DESC')
                                                                        ->with('doctor_user_details')
                                                                        ->get();
            if($get_new_consult)
            {
              $this->arr_view_data['new_consult_arr'] = $get_new_consult->toArray();
            }

            $this->arr_view_data['patient_id']          = $this->user_id;
            $this->arr_view_data['doctor_image_url']    = $this->doctor_image_url;
            $this->arr_view_data['page_title']          = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.dashboard',$this->arr_view_data);
        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }
    } // end dashboard


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
              }
          }
          else
          {
              $data['user_id'] = $this->user_id;
              $store_ip = $this->IPAddressModel->create($data);
          }

    } // new new_device


    public function consultation_request_with_ajax(Request $request){
            
        $status            = $request->input('status');
        $this->arr_view_data['new_consult_arr'] = "";
        if($status == "Pending"){
            $get_new_consult    = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                       /*->where('consultation_datetime', '>=', $current_datetime)*/
                                       ->where('booking_status', 'Pending')
                                       ->orderBy('id','DESC')
                                       ->with('doctor_user_details')
                                       ->get();
            if($get_new_consult)
            {
               $this->arr_view_data['new_consult_arr'] = $get_new_consult->toArray();
            }

            $consult_arr = $this->arr_view_data['new_consult_arr'];
            $html = "";
            if(isset($consult_arr) && !empty($consult_arr)){
                  $html .= '<ul class="collection brdrtopsd">';
                      foreach($consult_arr as $new_consult_data){
                          
                          $consult_datetime = convert_utc_to_userdatetime($this->user_id, "patient", $new_consult_data["consultation_datetime"]);

                          $html .='<li class="collection-item valign-wrapper">';
                              
                                  // check listisng image
                                  if ( isset($new_consult_data['doctor_user_details']['profile_image']) && !empty($new_consult_data['doctor_user_details']['profile_image']) )
                                  {
                                      $profile_images = $this->doctor_image_url.$new_consult_data['doctor_user_details']['profile_image'];
                                      // check if image exists or not
                                      if ( \File::exists($profile_images) )
                                      {
                                          $profile_images = $this->doctor_image_url."default-image.jpeg";
                                      }
                                  }
                                  else
                                  {
                                      $profile_images = $this->doctor_image_url."default-image.jpeg";
                                  }

                               $html .= '<div class="image-avtar left">';
                                  $html .= '<img src="'.$profile_images.'" alt="" class="circle" />';
                                  if($new_consult_data['doctor_user_details']['is_online'] == 1){
                                      $html .= '<span class="onlinenew"></span>';
                                  } else {
                                      $html .= '<span class="online"></span>';
                                  }
                               $html .= '</div>';

                               $html .= '<div class="left wid100"><small>'.date("l d F, Y",strtotime($consult_datetime)).' '.date("h:i a",strtotime($consult_datetime)).'</small>';

                               $html .= '<span class="title">'.$new_consult_data["doctor_user_details"]["title"].' '.$new_consult_data["doctor_user_details"]["first_name"].' '.$new_consult_data["doctor_user_details"]["last_name"].'</span>';
                               $html .= '</div>';
                               $html .= '<div class="right posrel">';
                               $html .= '<a href="#" data-activates="dropdown'.$new_consult_data["id"].'" class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>';
                               $html .= '<ul id="dropdown'.$new_consult_data["id"].'" class="dropdown-content doc-rop rightless">';
                                  $html .= '<li><a href="'.url('/').'/patient/booking/online_waiting_room/'.base64_encode($new_consult_data['id']).'" class="get_booking_id">Track Booking Status</a></li>';
                                  $html .= '<li><a href="'.url('/patient').'/new_consultations_request/details/'.base64_encode($new_consult_data["id"]).'">View Consultation Details</a></li>';
                                  $html .= '<li><a href="'.url('/patient').'/setting/disputes">Dispute</a></li>';
                                  $html .= '<li><a href="'.url('/patient').'/setting/feedback">Feedback &amp; Review</a></li>';
                              $html .= '</ul>';
                              $html .= '<div class="clearfix"></div>';
                          $html .= '</li>';
                        }
                  $html .= '</ul>';
              } else { 
                  $html .= '<div class="my-con-bx">';
                      $html .= '<div class="doc-img">';
                          $html .= '<img src="'.url('/').'/public/new/images/doc-icon.png" alt="doctor icon" />';
                          $html .= '<p>Seeking for Doctor. Book a New Consultation.</p>';
                      $html .= '</div>';
                  $html .= '</div>';
              }
        }
    echo $html;
    }


    /*
    | Function  : Get all the upcoming consultations for the user
    | Author    : Deepak Arvind Salunke
    | Date      : 17/07/2017
    | Output    : show all the data
    */

    public function upcoming_consultations()
    {
        if($this->user_id != '')
        {
            $current_datetime   = date("Y-m-d H:i:s");
            $current_date       = date("Y-m-d");
            $current_time       = date("H:i:s");

            $get_upcoming_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                          /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                                          ->where('booking_status', 'Confirmed')
                                                                          ->with('doctor_user_details')
                                                                          ->orderBy('id','DESC')
                                                                          ->get();
            if($get_upcoming_consult)
            {
              $this->arr_view_data['upcoming_consult_arr'] = $get_upcoming_consult->toArray();
            }

            $this->arr_view_data['patient_id']          = $this->user_id;
            $this->arr_view_data['current_datetime']    = $current_datetime;
            $this->arr_view_data['current_date']        = $current_date;
            $this->arr_view_data['current_time']        = $current_time;
            $this->arr_view_data['doctor_image_url']    = $this->doctor_image_url;
            $this->arr_view_data['page_title']          = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.upcoming_consultations',$this->arr_view_data);
        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }
    } // end upcoming_consultations

    /*--------------------------------------------------------------------------
                            UPCOMING CONSULTATION - SEARCH DOCTOR BY NAME
    ----------------------------------------------------------------------------*/

    public function search_doctor_upcoming_consultation(Request $request)
    {

      $current_datetime   = date("Y-m-d H:i:s");
      $current_date       = date("Y-m-d");
      $current_time       = date("H:i:s");

      $doc_keyword = $request->doc_keyword;

       $doc_name_arr = explode(' ', $doc_keyword);

      $doctor_name = $this->PatientConsultationBookingModel->orderBy('id','desc')
                                                           ->whereHas('doctor_user_details', function($user_details) use($doc_keyword, $doc_name_arr){
                                                                  if(!empty($doc_keyword))
                                                                    { 
                                                                        if(sizeof($doc_name_arr) == 3)
                                                                        {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');  
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');  
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');  
                                                                        }
                                                                        else if(sizeof($doc_name_arr) > 3)
                                                                        {
                                                                            unset($doctor_name);
                                                                        }
                                                                        else if(strstr($doc_keyword, ' '))
                                                                        {
                                                                            list($fname,$lname) =explode(' ', $doc_keyword);
                                                                            if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                                                                            {
                                                                              $user_details->where('title','like','%'.$fname.'%');  
                                                                              $user_details->Where('first_name','like','%'.$lname.'%');   
                                                                            }
                                                                            else
                                                                            {
                                                                                $user_details->where('first_name','like','%'.$fname.'%');
                                                                                $user_details->where('last_name','like','%'.$lname.'%');
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            $user_details->where('first_name','like','%'.$doc_keyword.'%');
                                                                            $user_details->orWhere('last_name','like','%'.$doc_keyword.'%');
                                                                            $user_details->orWhere('title','like','%'.$doc_keyword.'%');  
                                                                        }
                                                                        
                                                                     }
                                                            })->with('doctor_user_details')
                                                              ->where('patient_user_id', $this->user_id)
                                                              /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                              ->where('booking_status', 'Confirmed')
                                                              ->groupBy('doctor_user_id')
                                                              ->paginate(10);

      if(sizeof($doc_name_arr) <= 3 )
      {
        if($doctor_name)
        {
          $doctor_arr = $doctor_name->toArray();
          $doctor_arr =$doctor_arr['data'];
          $arr_json['status'] = 'success';
          $arr_json['data']   = $doctor_arr; 
        }
        else
        {
          $arr_json['status'] = 'error';        
        }  
      }                                                              
      else
      {
        $arr_json['status'] = 'error';        
      }

      return response()->json($arr_json);
      
    }

    /*--------------------------------------------------------------------------
                            UPCOMING CONSULTATION - SEARCH
    ----------------------------------------------------------------------------*/

    public function search_upcoming_consultation(Request $request)
    {   
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");                                                                      

        $obj_patient = "";
        $obj_upcoming = $this->PatientConsultationBookingModel->where('patient_user_id',$this->user_id)
                                                                 ->with(['doctor_info','doctor_user_details'])
                                                                 /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                                 ->where('booking_status', 'Confirmed');

        $doc_name_arr = explode(' ', $request->doctor_name);
                                                       
        if($request->doctor_name!="")
        {
              $this->arr_view_data['doctor_name']  = $request->doctor_name;
              $doctor_name = $request->doctor_name;
              

                if(sizeof($doc_name_arr) == 3)
                {
                  $obj_upcoming = $obj_upcoming->whereHas('doctor_user_details', function($user_details) use($doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');
                                                                      });

                }
                
              else if(strstr($doctor_name, ' '))
              {
                list($fname,$lname) = explode(' ', $doctor_name);

                if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                {
                   if(isset($fname) && isset($lname))
                    {
                       $obj_upcoming = $obj_upcoming->whereHas('doctor_user_details', function($user_details) use($fname,$lname,$doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$fname.'%');
                                                                          $user_details->where('first_name','like','%'.$lname.'%');
                                                                      });
                    } 
                }
                else
                {
                  $obj_upcoming = $obj_upcoming->whereHas('doctor_user_details', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                } 
                
                
              }
              else
              { 
                $this->arr_view_data['doctor_name']  = $request->doctor_name;
                $obj_upcoming = $obj_upcoming->whereHas('doctor_user_details', function($user_details) use($doctor_name) {
                                                                        if(!empty($doctor_name))
                                                                          { 
                                                                            $user_details->where('first_name',$doctor_name);
                                                                            $user_details->orWhere('last_name',$doctor_name);
                                                                           }
                                                                       });

              }        
        }
        if($request->selected_date!="")
        {
          $this->arr_view_data['selected_date']  = $request->selected_date;
          $date1 = strtr($request->selected_date, '/', '-');
          $date=date('Y-m-d', strtotime($date1)); 
                
          $obj_upcoming = $obj_upcoming->where('consultation_date',$date);
        }

        if($request->selected_time!="")
        {
          $this->arr_view_data['selected_time']  = $request->selected_time;
          
          $time = date("H:i:s", strtotime($request->selected_time));
                
          $obj_upcoming = $obj_upcoming->where('consultation_time',$time);
        }   

        $obj_upcoming = $obj_upcoming->paginate(10);

        $this->arr_view_data['current_datetime']    = $current_datetime;
        $this->arr_view_data['current_date']        = $current_date;
        $this->arr_view_data['current_time']        = $current_time;
        $this->arr_view_data['patient_id']          = $this->user_id;

        if($obj_upcoming)
        {
          $this->arr_view_data['paginate']         = clone $obj_upcoming;
          $this->arr_view_data['upcoming_consult_arr'] = $obj_upcoming->toArray();
        }     
        return view($this->module_view_folder.'.upcoming_search')->with($this->arr_view_data);                                                         
    }


    /*
    | Function  : Get all the past consultations for the user
    | Author    : Deepak Arvind Salunke
    | Date      : 17/07/2017
    | Output    : show all the data
    */

    public function past_consultations()
    {
        if($this->user_id != '')
        {
            $current_datetime   = date("Y-m-d H:i:s");
            $current_date       = date("Y-m-d");
            $current_time       = date("H:i:s");

            $get_past_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                      //->where('consultation_datetime', '<=', $current_datetime)
                                                                      ->where(function($query) use($current_datetime){
                                                                        $query->where('booking_status','Completed');
                                                                        /*$query->orWhere('booking_status','Confirmed');*/
                                                                      })
                                                                      ->with('doctor_user_details')
                                                                      ->orderBy('id','DESC')
                                                                      ->paginate(10);


            if($get_past_consult)
            {
                $this->arr_view_data['paginate']         = clone $get_past_consult;
                $this->arr_view_data['past_consult_arr'] = $get_past_consult->toArray();
            }
          
            $this->arr_view_data['patient_id']          = $this->user_id;
            $this->arr_view_data['doctor_image_url']    = $this->doctor_image_url;
            $this->arr_view_data['page_title']          = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.past_consultations',$this->arr_view_data);
        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }
    } // end past_consultations


    /*
    | Function  : Get all the past consultations doctors for the user
    | Author    : Deepak Arvind Salunke
    | Date      : 17/07/2017
    | Output    : show all the data
    */

    public function my_doctors()
    {
        if($this->user_id != '')
        {
            $current_date = date("Y-m-d");
            $current_time = date("H:i:s");

            $get_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                 //->orderBy('id', 'DESC')
                                                                 //->orderBy('consultation_date', 'DESC')
                                                                 ->orderBy('consultation_datetime', 'DESC')
                                                                 ->with('doctor_user_details')
                                                                 ->with(['doctor_availability' => function($doc_time) use($current_date,$current_time){
                                                                    $doc_time->where('date', '=',$current_date);
                                                                    $doc_time->orderBy('date', 'ASC');
                                                                    $doc_time->where('end_time', '>=',$current_time);
                                                                    $doc_time->orderBy('end_time', 'DESC');
                                                                 }])
                                                                 ->get();
            if($get_consult)
            {
                $consult_arr = $get_consult->toArray();
            }
            

            $new_carr   = [];
            $group_darr = [];
            foreach ($consult_arr as  $value) {
                if(in_array($value['doctor_user_id'], $group_darr)){
                }
                else{
                    $new_carr[]     = $value;
                    $group_darr[]   = $value['doctor_user_id'];
                }  
            }
            
            $language_arr = $this->LanguageModel->where('language_status','1')->orderBy('language','ASC')->get();
            if($language_arr)
            {
                $this->arr_view_data['language'] = $language_arr->toArray();
            }

            $this->arr_view_data['patient_id']          = $this->user_id;
            $this->arr_view_data['consult_arr']         = $new_carr;
            $this->arr_view_data['doctor_image_url']    = $this->doctor_image_url;
            $this->arr_view_data['page_title']          = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.my_doctors',$this->arr_view_data);
        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }
    } // end my_doctors

    public function my_doctors_search_name(Request $request)
    {
        $current_date = date("Y-m-d");
        $current_time = date("H:i:s");

        $doc_keyword = $request->doc_keyword;

        $doc_name_arr = explode(' ', $doc_keyword);

        $doctor_name = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                             ->orderBy('consultation_datetime', 'DESC')
                                                             ->with('doctor_user_details')
                                                             ->with(['doctor_availability' => function($doc_time) use($current_date,$current_time){
                                                                $doc_time->where('date', '=',$current_date);
                                                                $doc_time->orderBy('date', 'ASC');
                                                                $doc_time->where('end_time', '>=',$current_time);
                                                                $doc_time->orderBy('end_time', 'DESC');
                                                             }])
                                                             ->whereHas('doctor_user_details', function($user_details) use($doc_keyword, $doc_name_arr){
                                                                if(!empty($doc_keyword))
                                                                    { 
                                                                        if(sizeof($doc_name_arr) == 3)
                                                                        {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');  
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');  
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');  
                                                                        }
                                                                        else if(sizeof($doc_name_arr) > 3)
                                                                        {
                                                                            unset($doctor_name);
                                                                        }
                                                                        else if(strstr($doc_keyword, ' '))
                                                                        {
                                                                            list($fname,$lname) =explode(' ', $doc_keyword);
                                                                            if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                                                                            {
                                                                              $user_details->where('title','like','%'.$fname.'%');  
                                                                              $user_details->Where('first_name','like','%'.$lname.'%');   
                                                                            }
                                                                            else
                                                                            {
                                                                                $user_details->where('first_name','like','%'.$fname.'%');
                                                                                $user_details->where('last_name','like','%'.$lname.'%');
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            $user_details->where('first_name','like','%'.$doc_keyword.'%');
                                                                            $user_details->orWhere('last_name','like','%'.$doc_keyword.'%');  
                                                                            $user_details->orWhere('title','like','%'.$doc_keyword.'%');  
                                                                        }
                                                                        
                                                                     }

                                                             })
                                                             ->groupBy('doctor_user_id')
                                                             ->paginate();    
       if(sizeof($doc_name_arr) <= 3 )
       {
          if($doctor_name)
          {
            $doctor_arr = $doctor_name->toArray();
            $doctor_arr =$doctor_arr['data'];
            $arr_json['status'] = 'success';
            $arr_json['data']   = $doctor_arr; 
          }
          else
          {
            $arr_json['status'] = 'error';        
          }
       }
       else
        {
          $arr_json['status'] = 'error';        
        }                                                                                                 

        return response()->json($arr_json);
    }

    public function my_doctors_search(Request $request)
    {
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");

        $doc_name_arr = explode(' ', $request->doctor_name);                                                                      
        $obj_doctor = "";
        $obj_doctor = $this->PatientConsultationBookingModel->where('patient_user_id',$this->user_id)
                                                            ->with(['doctor_info','doctor_user_details'])
                                                            ->with(['doctor_availability' => function($doc_time) use($current_date,$current_time){
                                                                $doc_time->where('date', '=',$current_date);
                                                                $doc_time->orderBy('date', 'ASC');
                                                                $doc_time->where('end_time', '>=',$current_time);
                                                                $doc_time->orderBy('end_time', 'DESC');
                                                             }])
                                                             ->groupBy('doctor_user_id');

                                                                 
                                                                
        if($request->doctor_name!="")
        {
              $this->arr_view_data['doctor_name']  = $request->doctor_name;
              $doctor_name = $request->doctor_name;
              

                if(sizeof($doc_name_arr) == 3)
                {
                  $obj_doctor = $obj_doctor->whereHas('doctor_user_details', function($user_details) use($doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');
                                                                      });

                }
                
              else if(strstr($doctor_name, ' '))
              {
                list($fname,$lname) = explode(' ', $doctor_name);

                if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                {
                   if(isset($fname) && isset($lname))
                    {
                       $obj_doctor = $obj_doctor->whereHas('doctor_user_details', function($user_details) use($fname,$lname,$doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$fname.'%');
                                                                          $user_details->where('first_name','like','%'.$lname.'%');
                                                                      });
                    } 
                }
                else
                {
                  $obj_doctor = $obj_doctor->whereHas('doctor_user_details', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                } 
                
                
              }
              else
              { 
                $this->arr_view_data['doctor_name']  = $request->doctor_name;
                $obj_doctor = $obj_doctor->whereHas('doctor_user_details', function($user_details) use($doctor_name) {
                                                                        if(!empty($doctor_name))
                                                                          { 
                                                                            $user_details->where('first_name',$doctor_name);
                                                                            $user_details->orWhere('last_name',$doctor_name);
                                                                           }
                                                                       });

              }        
        }
        if($request->selected_date!="")
        {
          $this->arr_view_data['selected_date']  = $request->selected_date;
          $date1 = strtr($request->selected_date, '/', '-');
          $date=date('Y-m-d', strtotime($date1)); 
                
          $obj_doctor = $obj_doctor->where('consultation_date',$date);
        }

        if($request->selected_time!="")
        {
          $this->arr_view_data['selected_time']  = $request->selected_time;
          
          $time = date("H:i:s", strtotime($request->selected_time));
                
          $obj_doctor = $obj_doctor->where('consultation_time',$time);
        }
        if($request->language!="" || $request->language!= null )
        {
          $this->arr_view_data['selected_language']  = $request->language;
          $language = $request->language;
          $obj_doctor = $obj_doctor->whereHas('doctor_info', function($user) use($language){
              $user->whereRaw('find_in_set(?, language)',[$language]);
          });
        }
        if($request->gender!="" || $request->gender!= null )
        {
          $this->arr_view_data['gender']  = $request->gender;
          $gender = $request->gender;
          $obj_doctor = $obj_doctor->whereHas('doctor_info', function($user) use($gender){
              $user->where('gender',$gender);
          });
        }   

        $obj_doctor = $obj_doctor->paginate(10);

        if($obj_doctor)
        {
          $this->arr_view_data['paginate']         = clone $obj_doctor;
          $this->arr_view_data['doctors_arr'] = $obj_doctor->toArray();
        }


        
        $language_arr = $this->LanguageModel->where('language_status','1')->orderBy('language','ASC')->get();
        if($language_arr)
        {
            $this->arr_view_data['language'] = $language_arr->toArray();
        }     

        $this->arr_view_data['patient_id']       = $this->user_id;
        $this->arr_view_data['doctor_image_url'] = $this->doctor_image_url;
        return view($this->module_view_folder.'.doctor_search')->with($this->arr_view_data);
    }


    /*
    | Function  : Get all the upcoming consultation
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Show all upcoming consultation
    */

    public function upcoming_search()
    {
        if($this->user_id != '')
        {
            $current_datetime   = date("Y-m-d H:i:s");

            $get_upcoming_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                          ->where('consultation_datetime', '>=', $current_datetime)
                                                                          ->where('booking_status', 'Pending')
                                                                          ->with('doctor_user_details')
                                                                          ->get();
            if($get_upcoming_consult)
            {
                $this->arr_view_data['upcoming_consult_arr'] = $get_upcoming_consult->toArray();
            }
            
            $this->arr_view_data['patient_id']          = $this->user_id;
            $this->arr_view_data['doctor_image_url']    = $this->doctor_image_url;
            $this->arr_view_data['page_title']          = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.upcoming_search',$this->arr_view_data);
        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }

    } // end upcoming_search


    /*
    | Function  : Get all the upcoming consultation as per search key
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : all upcoming consultation as per search key
    */

    public function get_upcoming_search(Request $request)
    {
        $search_key         = $request->input('search_key');
        $current_datetime   = date("Y-m-d H:i:s");

        $get_search_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                    ->where('consultation_datetime', '>=', $current_datetime)
                                                                    ->where('booking_status', 'Pending')
                                                                    ->with(['doctor_user_details' => function($doc) use($search_key) {
                                                                        $doc->where('first_name', 'like', '%' . $search_key . '%');
                                                                        $doc->orWhere('last_name', 'like', '%' . $search_key . '%');
                                                                    }])
                                                                    ->get();
        if($get_search_consult)
        {
            $consult_arr     = $get_search_consult->toArray();
        }
        
        if($consult_arr > 0)
        {
            $consult_data = '';

            foreach ($consult_arr as $data) 
            {
                if(!empty($data['doctor_user_details']))
                {
                    $consult_datetime = convert_utc_to_userdatetime($this->user_id, "patient", $data["consultation_datetime"]);

                    $consult_data .= '<li class="collection-item valign-wrapper">
                                <div class="left wid100"><small>'.date("l d F, Y",strtotime($consult_datetime)).' '.date("h:i a",strtotime($consult_datetime)).'</small>
                                    <span class="title">'.$data["doctor_user_details"]["title"].' '.$data["doctor_user_details"]["first_name"].' '.$data["doctor_user_details"]["last_name"].'</span>
                                </div>
                                <div class="right posrel">
                                <a href="#" data-activates="dropdown'.$data["id"].'" class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                                <ul id="dropdown'.$data["id"].'" class="dropdown-content doc-rop rightless">
                                    <li><a href="'. url('/') .'/patient/booking/online_waiting_room/'. base64_encode($data["id"]) .'" class="get_booking_id">Track Booking Status</a></li>
                                    <li><a href="'. url('/') .'/patient/consultation_details">View Consultation Details</a></li>
                                    <li><a href="'. url('/') .'/patient/consultation_invoice">View Invoice</a></li>
                                    <li><a href="'. url('/') .'/patient/disputes">Dispute</a></li>
                                    <li><a href="'. url('/') .'/patient/feedback">Feedback &amp; Review</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </li>';
                }
            }
            

            if(!empty($consult_data) && isset($consult_data))
            {
                echo $consult_data;
            }
            else
            {
                echo    '<div class="my-con-bx">
                            <div class="doc-img">
                                <p>No Result found</p>
                            </div>
                        </div>';
            }
        }
        else
        {
            echo    '<div class="my-con-bx">
                        <div class="doc-img">
                            <p>No Result found</p>
                        </div>
                    </div>';
        }

    } // end get_upcoming_search


    /*
    | Function  : Get all the upcoming consultation
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Show all upcoming consultation
    */

    public function past_search()
    {
        if($this->user_id != '')
        {
            $current_datetime   = date("Y-m-d H:i:s");

            $get_upcoming_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                          ->where('consultation_datetime', '<=', $current_datetime)
                                                                          ->where('booking_status', 'Completed')
                                                                          ->with('doctor_user_details')
                                                                          ->get();
            if($get_upcoming_consult)
            {
                $this->arr_view_data['upcoming_consult_arr'] = $get_upcoming_consult->toArray();
            }
            

            $this->arr_view_data['patient_id']          = $this->user_id;
            $this->arr_view_data['doctor_image_url']    = $this->doctor_image_url;
            $this->arr_view_data['page_title']          = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.past_search',$this->arr_view_data);
        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }

    } // end past_search


    /*
    | Function  : Get all the upcoming consultation as per search key
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : all upcoming consultation as per search key
    */

    public function get_past_search(Request $request)
    {
        $search_key         = $request->input('search_key');
        $current_datetime   = date("Y-m-d H:i:s");

        $get_search_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                    ->where('consultation_datetime', '<=', $current_datetime)
                                                                    ->where('booking_status', 'Completed')
                                                                    ->with(['doctor_user_details' => function($doc) use($search_key) {
                                                                        $doc->where('first_name', 'like', '%' . $search_key . '%');
                                                                        $doc->orWhere('last_name', 'like', '%' . $search_key . '%');
                                                                    }])
                                                                    ->get();
        if($get_search_consult)
        {
            $consult_arr     = $get_search_consult->toArray();
        }
        
        if($consult_arr > 0)
        {
            $consult_data = '';

            foreach ($consult_arr as $data) 
            {
                if(!empty($data['doctor_user_details']))
                {
                    $consult_datetime = convert_utc_to_userdatetime($this->user_id, "patient", $data["consultation_datetime"]);

                    $consult_data .= '<li class="collection-item valign-wrapper">
                                <div class="left wid100"><small>'.date("l d F, Y",strtotime($consult_datetime)).' '.date("h:i a",strtotime($consult_datetime)).'</small>
                                    <span class="title">'.$data["doctor_user_details"]["title"].' '.$data["doctor_user_details"]["first_name"].' '.$data["doctor_user_details"]["last_name"].'</span>
                                </div>
                                <div class="right posrel">
                                <a href="#" data-activates="dropdown'.$data["id"].'" class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                                <ul id="dropdown'.$data["id"].'" class="dropdown-content doc-rop rightless">
                                    <li><a href="'. url('/') .'/patient/booking/online_waiting_room/'. base64_encode($data["id"]) .'" class="get_booking_id">Track Booking Status</a></li>
                                    <li><a href="'. url('/') .'/patient/consultation_details">View Consultation Details</a></li>
                                    <li><a href="'. url('/') .'/patient/consultation_invoice">View Invoice</a></li>
                                    <li><a href="'. url('/') .'/patient/disputes">Dispute</a></li>
                                    <li><a href="'. url('/') .'/patient/feedback">Feedback &amp; Review</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </li>';
                }
            }
            

            if(!empty($consult_data) && isset($consult_data))
            {
                echo $consult_data;
            }
            else
            {
                echo    '<div class="my-con-bx">
                            <div class="doc-img">
                                <p>No Result found</p>
                            </div>
                        </div>';
            }
        }
        else
        {
            echo    '<div class="my-con-bx">
                        <div class="doc-img">
                            <p>No Result found</p>
                        </div>
                    </div>';
        }

    } // end get_past_search


    /*
    | Function  : Get all the past consultation doctors
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Show all the past consultation doctors
    */

    public function doctor_search()
    {
        if($this->user_id != '')
        {
            $current_date = date("Y-m-d");
            $current_time = date("H:i:s");

            $get_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                 //->orderBy('id', 'DESC')
                                                                 //->orderBy('consultation_date', 'DESC')
                                                                 ->orderBy('consultation_datetime', 'DESC')
                                                                 ->with('doctor_user_details')
                                                                 ->with(['doctor_availability' => function($doc_time) use($current_date,$current_time){
                                                                    $doc_time->where('date', '>=',$current_date);
                                                                    $doc_time->orderBy('date', 'ASC');
                                                                    //$doc_time->where('end_time', '>=',$current_time);
                                                                    //$doc_time->orderBy('id', 'DESC');
                                                                 }])
                                                                 ->get();
            if($get_consult)
            {
                $consult_arr = $get_consult->toArray();
            }
            

            $new_carr   = [];
            $group_darr = [];
            foreach ($consult_arr as  $value) {
                if(in_array($value['doctor_user_id'], $group_darr)){
                }
                else{
                    $new_carr[]     = $value;
                    $group_darr[]   = $value['doctor_user_id'];
                }  
            }
            

            $this->arr_view_data['consult_arr']         = $new_carr;
            $this->arr_view_data['patient_id']          = $this->user_id;
            $this->arr_view_data['doctor_image_url']    = $this->doctor_image_url;
            $this->arr_view_data['page_title']          = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.doctor_search',$this->arr_view_data);
        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }

    } // end doctor_search


    /*
    | Function  : Get all the past consultation doctors as per search key
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : all past consultation doctors as per search key
    */

    public function get_doctor_search(Request $request)
    {
        $search_key         = $request->input('search_key');
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");
        $doctor_image_url   = $this->doctor_image_url;

        $get_search_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                    ->orderBy('consultation_datetime', 'DESC')
                                                                    ->with(['doctor_user_details' => function($doc) use($search_key) {
                                                                        $doc->where('first_name', 'like', '%' . $search_key . '%');
                                                                        $doc->orWhere('last_name', 'like', '%' . $search_key . '%');
                                                                    }])
                                                                    ->with(['doctor_availability' => function($doc_time) use($current_date,$current_time){
                                                                       $doc_time->where('date', '>=',$current_date);
                                                                       $doc_time->orderBy('date', 'ASC');
                                                                    }])
                                                                    ->get();
        if($get_search_consult)
        {
            $consult_arr     = $get_search_consult->toArray();
        }

        $new_carr   = [];
        $group_darr = [];
        foreach ($consult_arr as  $value) {
            if(in_array($value['doctor_user_id'], $group_darr)){
            }
            else{
                $new_carr[]     = $value;
                $group_darr[]   = $value['doctor_user_id'];
            }  
        }
        
        if($new_carr > 0)
        {
            $consult_data = '';

            foreach ($new_carr as $data) 
            {
                if(!empty($data['doctor_user_details']))
                {
                    $consult_date = '';
                    $doc_date     = '';

                    // check listisng image
                    if ( isset($data['doctor_user_details']['profile_image']) && !empty($data['doctor_user_details']['profile_image']) )
                    {
                        $profile_images = $doctor_image_url.$data['doctor_user_details']['profile_image'];
                        // check if image exists or not
                        if ( File::exists($profile_images) ) 
                        {
                            $profile_images = $doctor_image_url."default-image.jpeg";
                        } // end if
                    } // end if
                    else
                    {
                        $profile_images = $doctor_image_url."default-image.jpeg";
                    } // end else

                    $consult_date = isset($data['doctor_availability'][0]['date'])?$data['doctor_availability'][0]['date']:'';

                    if ( !empty($consult_date) )
                    {
                        $doc_date = '<a class="valign-wrapper" href="'. url('/') .'/patient/booking/available_doctor/'.base64_encode($data['doctor_user_details']['id']).'/'.base64_encode($consult_date).'">
                                    <div class="doc-action right"><span class="btn secondary-content border">Book now</span></div>
                                </a>';
                    }

                    $consult_data .= '<li class="collection-item avatar">
                                <div class="image-avtar left"> <img src="'.$profile_images.'" alt="" class="circle" />
                                <span class="onlinenew"></span> </div>
                                <div class="doc-detail  left"><span class="title">'.$data["doctor_user_details"]["title"].' '.$data["doctor_user_details"]["first_name"].' '.$data["doctor_user_details"]["last_name"].'</span>
                                    <p class="availability bluedoc-text"> <strong>Last Booking : </strong>'.date("l d F, Y",strtotime($data["consultation_date"])).' '.date("h:i a",strtotime($data["consultation_time"])).'</p>
                                </div>'.$doc_date.'
                                <div class="clearfix"></div>
                            </li>';
                }
            }
            

            if(!empty($consult_data) && isset($consult_data))
            {
                echo $consult_data;
            }
            else
            {
                echo    '<div class="my-con-bx">
                            <div class="doc-img">
                                <p>No Result found</p>
                            </div>
                        </div>';
            }
        }
        else
        {
            echo    '<div class="my-con-bx">
                        <div class="doc-img">
                            <p>No Result found</p>
                        </div>
                    </div>';
        }

    } // end get_doctor_search

    /*--------------------------------------------------------------------------
                            PAST CONSULTATION - SEARCH DOCTOR BY NAME
    ----------------------------------------------------------------------------*/

    public function search_doctor_name(Request $request)
    {

      $current_datetime   = date("Y-m-d H:i:s");
      $current_date       = date("Y-m-d");
      $current_time       = date("H:i:s");

      $doc_keyword = $request->doc_keyword;

      $doc_name_arr = explode(' ', $doc_keyword);

      $doctor_name = $this->PatientConsultationBookingModel->orderBy('id','desc')
                                                           ->whereHas('doctor_user_details', function($user_details) use($doc_keyword, $doc_name_arr){
                                                                  if(!empty($doc_keyword))
                                                                    { 
                                                                        if(sizeof($doc_name_arr) == 3)
                                                                        {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');  
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');  
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');  
                                                                        }
                                                                        else if(sizeof($doc_name_arr) > 3)
                                                                        {
                                                                            unset($doctor_name);
                                                                        }
                                                                        else if(strstr($doc_keyword, ' '))
                                                                        {
                                                                            list($fname,$lname) =explode(' ', $doc_keyword);
                                                                            if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                                                                            {
                                                                              $user_details->where('title','like','%'.$fname.'%');  
                                                                              $user_details->Where('first_name','like','%'.$lname.'%');   
                                                                            }
                                                                            else
                                                                            {
                                                                                $user_details->where('first_name','like','%'.$fname.'%');
                                                                                $user_details->where('last_name','like','%'.$lname.'%');
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            $user_details->where('first_name','like','%'.$doc_keyword.'%');
                                                                            $user_details->orWhere('last_name','like','%'.$doc_keyword.'%');  
                                                                            $user_details->orWhere('title','like','%'.$doc_keyword.'%');  
                                                                        }
                                                                        
                                                                     }
                                                            })->with('doctor_user_details')
                                                              ->where('patient_user_id', $this->user_id)
                                                              ->where('consultation_datetime', '<=', $current_datetime)
                                                                      ->where(function($query) use($current_datetime){
                                                                        $query->orWhere('booking_status','Completed');
                                                                        $query->orWhere('booking_status','Confirmed');
                                                                      })
                                                              ->groupBy('doctor_user_id')
                                                              ->paginate(10);
      if(sizeof($doc_name_arr) <= 3 )
      {
          if($doctor_name)
          {
            $doctor_arr = $doctor_name->toArray();
            $doctor_arr =$doctor_arr['data'];
            $arr_json['status'] = 'success';
            $arr_json['data']   = $doctor_arr; 
          }
          else
          {
            $arr_json['status'] = 'error';        
          }
      } 
      else
      {
          $arr_json['status'] = 'error';        
      }                                                            


      return response()->json($arr_json);
      
    }

    /*--------------------------------------------------------------------------
                                 PAST CONSULTATION - SEARCH 
    ----------------------------------------------------------------------------*/

    public function search_past_consultation(Request $request)
    {
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");                                                                      

        $obj_patient = "";
        $obj_past = $this->PatientConsultationBookingModel->where('patient_user_id',$this->user_id)
                                                                 ->with(['doctor_info','doctor_user_details'])
                                                                 ->where('consultation_datetime', '<=', $current_datetime)
                                                                      ->where(function($query) use($current_datetime){
                                                                        $query->orWhere('booking_status','Completed');
                                                                        $query->orWhere('booking_status','Confirmed');
                                                                      });
        $doc_name_arr = explode(' ', $request->doctor_name);                                                                         
                                                                 
        if($request->doctor_name!="")
        {
              $this->arr_view_data['doctor_name']  = $request->doctor_name;
              $doctor_name = $request->doctor_name;
              

                if(sizeof($doc_name_arr) == 3)
                {
                  $obj_past = $obj_past->whereHas('doctor_user_details', function($user_details) use($doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');
                                                                      });

                }
                
              else if(strstr($doctor_name, ' '))
              {
                list($fname,$lname) = explode(' ', $doctor_name);

                if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                {
                   if(isset($fname) && isset($lname))
                    {
                       $obj_past = $obj_past->whereHas('doctor_user_details', function($user_details) use($fname,$lname,$doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$fname.'%');
                                                                          $user_details->where('first_name','like','%'.$lname.'%');
                                                                      });
                    } 
                }
                else
                {
                  $obj_past = $obj_past->whereHas('doctor_user_details', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                } 
                
                
              }
              else
              { 
                $this->arr_view_data['doctor_name']  = $request->doctor_name;
                $obj_past = $obj_past->whereHas('doctor_user_details', function($user_details) use($doctor_name) {
                                                                        if(!empty($doctor_name))
                                                                          { 
                                                                            $user_details->where('first_name',$doctor_name);
                                                                            $user_details->orWhere('last_name',$doctor_name);
                                                                           }
                                                                       });

              }        
        }
        if($request->selected_date!="")
        {
          $this->arr_view_data['selected_date']  = $request->selected_date;
          $date1 = strtr($request->selected_date, '/', '-');
          $date=date('Y-m-d', strtotime($date1)); 
                
          $obj_past = $obj_past->where('consultation_date',$date);
        }

        if($request->selected_time!="")
        {
          $this->arr_view_data['selected_time']  = $request->selected_time;
          
          $time = date("H:i:s", strtotime($request->selected_time));
                
          $obj_past = $obj_past->where('consultation_time',$time);
        }   

        $obj_past = $obj_past->paginate(10);

        if($obj_past)
        {
          $this->arr_view_data['paginate']         = clone $obj_past;
          $this->arr_view_data['past_consult_arr'] = $obj_past->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        return view($this->module_view_folder.'.past_search')->with($this->arr_view_data);                                                         
    }

    /*--------------------------------------------------------------------------
                            NEW CONSULTATION - SEARCH DOCTOR BY NAME 
    ----------------------------------------------------------------------------*/

    public function search_doctor_new_consultation(Request $request)
    {

        $doc_keyword = $request->doc_keyword;

        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");

        $doc_name_arr = explode(' ', $doc_keyword);

        $doctor_name = $this->PatientConsultationBookingModel->orderBy('id','desc')
                                                             ->whereHas('doctor_user_details', function($user_details) use($doc_keyword,$doc_name_arr){
                                                                  if(!empty($doc_keyword))
                                                                    { 
                                                                        if(sizeof($doc_name_arr) == 3)
                                                                        {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');  
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');  
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');  
                                                                        }
                                                                        else if(sizeof($doc_name_arr) > 3)
                                                                        {
                                                                            unset($doctor_name);
                                                                        }
                                                                        else if(strstr($doc_keyword, ' '))
                                                                        {
                                                                            list($fname,$lname) =explode(' ', $doc_keyword);
                                                                            if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                                                                            {
                                                                              $user_details->where('title','like','%'.$fname.'%');  
                                                                              $user_details->Where('first_name','like','%'.$lname.'%');   
                                                                            }
                                                                            else
                                                                            {
                                                                                $user_details->where('first_name','like','%'.$fname.'%');
                                                                                $user_details->where('last_name','like','%'.$lname.'%');
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            $user_details->where('first_name','like','%'.$doc_keyword.'%');
                                                                            $user_details->orWhere('last_name','like','%'.$doc_keyword.'%');  
                                                                            $user_details->orWhere('title','like','%'.$doc_keyword.'%');  
                                                                        }
                                                                        
                                                                     }
                                                            })->with('doctor_user_details')
                                                              ->where('patient_user_id', $this->user_id)
                                                              /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                              ->where('booking_status', 'Pending')
                                                              ->groupBy('doctor_user_id')
                                                              ->paginate(10);
        if(sizeof($doc_name_arr) <= 3 )
        {
            if($doctor_name)
            {
              $doctor_arr = $doctor_name->toArray();
              $doctor_arr =$doctor_arr['data'];
              $arr_json['status'] = 'success';
              $arr_json['data']   = $doctor_arr; 
            }
            else
            {
              $arr_json['status'] = 'error';        
            }
        }
        else
        {
          $arr_json['status'] = 'error';        
        }                                                              

       return response()->json($arr_json);
      
    }

    /*--------------------------------------------------------------------------
                                 NEW CONSULTATION REQUEST - SEARCH 
    ----------------------------------------------------------------------------*/

    public function search_new_consultation(Request $request)
    {
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");                                                                      

        $obj_patient = "";
        $obj_new = $this->PatientConsultationBookingModel->where('patient_user_id',$this->user_id)
                                                                 ->with(['doctor_info','doctor_user_details'])
                                                                 ->where('patient_user_id', $this->user_id)
                                                                 /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                                 ->where('booking_status', 'Pending');
                                                                 
        
        $doc_name_arr = explode(' ', $request->doctor_name);                                                        
        if($request->doctor_name!="")
        {
              $this->arr_view_data['doctor_name']  = $request->doctor_name;
              $doctor_name = $request->doctor_name;
              

                if(sizeof($doc_name_arr) == 3)
                {
                  $obj_new = $obj_new->whereHas('doctor_user_details', function($user_details) use($doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');
                                                                      });

                }
                
              else if(strstr($doctor_name, ' '))
              {
                list($fname,$lname) = explode(' ', $doctor_name);

                if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                {
                   if(isset($fname) && isset($lname))
                    {
                       $obj_new = $obj_new->whereHas('doctor_user_details', function($user_details) use($fname,$lname,$doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$fname.'%');
                                                                          $user_details->where('first_name','like','%'.$lname.'%');
                                                                      });
                    } 
                }
                else
                {
                  $obj_new = $obj_new->whereHas('doctor_user_details', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                } 
                
                
              }
              else
              { 
                $this->arr_view_data['doctor_name']  = $request->doctor_name;
                $obj_new = $obj_new->whereHas('doctor_user_details', function($user_details) use($doctor_name) {
                                                                        if(!empty($doctor_name))
                                                                          { 
                                                                            $user_details->where('first_name',$doctor_name);
                                                                            $user_details->orWhere('last_name',$doctor_name);
                                                                           }
                                                                       });

              }        
        }
        if($request->selected_date!="")
        {
          $this->arr_view_data['selected_date']  = $request->selected_date;
          $date1 = strtr($request->selected_date, '/', '-');
          $date=date('Y-m-d', strtotime($date1)); 
                
          $obj_new = $obj_new->where('consultation_date',$date);
        }

        if($request->selected_time!="")
        {
          $this->arr_view_data['selected_time']  = $request->selected_time;
          
          $time = date("H:i:s", strtotime($request->selected_time));
                
          $obj_new = $obj_new->where('consultation_time',$time);
        }   

        $obj_new = $obj_new->paginate(10);

        if($obj_new)
        {
          $this->arr_view_data['paginate']         = clone $obj_new;
          $this->arr_view_data['new_consult_arr'] = $obj_new->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        return view($this->module_view_folder.'.new_consultation_search')->with($this->arr_view_data);                                                         
    }

    public function upcoming_consultation_details($enc_booking_id)
    {   
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");

        $get_upcoming_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                          /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                                          ->where('booking_status', 'Confirmed')
                                                                          ->where('id',base64_decode($enc_booking_id))
                                                                          ->with('doctor_user_details','patient_user_details','familiy_member_info')
                                                                          ->first();
        if($get_upcoming_consult)
        {
            $this->arr_view_data['upcoming_consult_arr'] = $get_upcoming_consult->toArray();
        }
        $health_images =$this->PatientConsultationImagesModel->where([
                                                                        ['user_id',$this->user_id],
                                                                        ['booking_id',base64_decode($enc_booking_id)]
                                                                    ])
                                                             ->get();
        if(isset($health_images))
        {
            $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        $this->arr_view_data['patient_uploads_url']      = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url'] = $this->patient_uploads_base_url;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;

       return view($this->module_view_folder.'.upcoming_consultation_details')->with($this->arr_view_data);     
    }

    public function upcoming_consultation_invoice($enc_booking_id)
    {
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");

        $consult_invoice = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                          /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                                          ->where('booking_status', 'Confirmed')
                                                                          ->where('id',base64_decode($enc_booking_id))
                                                                          ->with('doctor_user_details','patient_user_details','patient_info','familiy_member_info')
                                                                          ->first();
        if($consult_invoice)
        {
            $this->arr_view_data['consult_invoice'] = $consult_invoice->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        $this->arr_view_data['patient_uploads_url']      = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url'] = $this->patient_uploads_base_url;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;
        $this->arr_view_data['enc_booking_id']           = $enc_booking_id;

       return view($this->module_view_folder.'.upcoming_consultation_invoice')->with($this->arr_view_data);   
    }

    public function upcoming_consultation_invoice_download($enc_booking_id)
    {

        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");

        $consult_invoice = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                          /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                                          ->where('booking_status', 'Confirmed')
                                                                          ->where('id',base64_decode($enc_booking_id))
                                                                          ->with('doctor_user_details','patient_user_details','patient_info','familiy_member_info')
                                                                          ->first();
        if($consult_invoice)
        {
            $this->arr_view_data['consult_invoice'] = $consult_invoice->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        $this->arr_view_data['patient_uploads_url']      = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url'] = $this->patient_uploads_base_url;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;
        $this->arr_view_data['enc_booking_id']           = $enc_booking_id;
        
        Session::put("arr_upcoming_invoice_data",'');
        return response()->json($this->arr_view_data);
    }

    public function generate_upcoming_consultation_invoice_pdf(Request $request)
    {
      if($request->has('arr_data') && $request->input('arr_data')!='')
      {
        $arr_session_data = $request->input('arr_data');
        Session::put("arr_upcoming_invoice_data",$arr_session_data);
        return response()->json(['status'=>'success']);
      }
      
      $arr_data = Session::get("arr_upcoming_invoice_data");
      if(!empty($arr_data))
      {
        PDF::setHeaderCallback(function($pdf){
        $pdf->SetY(15);
        // Set font
        $pdf->SetFont('helvetica', 'B', 20);
        // Title
        //$pdf->Cell(0, 15, 'Doctoroo', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        // Image method signature:
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
        $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);

        $pdf->SetY(40);
        });

        // Custom Footer
        PDF::setFooterCallback(function($pdf) {

              // Position at 15 mm from bottom
              $pdf->SetY(-15);
              // Set font
              $pdf->SetFont('helvetica', 'I', 8);
              // Page number
              $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

        });
        
        $file_name="upcoming_consultation_invoice";
      
       PDF::SetTitle('Doctoroo | Upcoming Consultation Invoice');
       PDF::SetMargins(10, 30, 10, 10);
       PDF::SetFontSubsetting(false);
       PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
       PDF::AddPage();
       PDF::writeHTML(view($this->module_view_folder.'.pdf.upcoming_consultation_invoice', $arr_data)->render());
       PDF::Output($file_name.'.pdf');
      }
      return redirect()->back();
    }


    public function past_consultation_details($enc_booking_id)
    {   
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");

        $get_past_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                  //->where('consultation_datetime', '<=', $current_datetime)
                                                                  ->where('id',base64_decode($enc_booking_id))
                                                                  ->where(function($query) use($current_datetime){
                                                                        $query->where('booking_status','Completed');
                                                                   })
                                                                  ->with('doctor_user_details','patient_user_details','familiy_member_info','consultation_documents','consultation_notes')
                                                                  ->with(['disputes'  => function($query){
                                                                        $query->where('admin_comments' ,'<>', '');
                                                                        $query->where('status', 'opened');
                                                                        $query->orderBy('id', 'DESC');
                                                                    }])
                                                                  ->first();
        if($get_past_consult)
        {
            $this->arr_view_data['past_consult_arr'] = $get_past_consult->toArray();           
        }

        
        $get_invoice_data = $this->PatientConsultationPaymentModel->where('booking_id', base64_decode($enc_booking_id))
                                                                  ->where('payment_status', 'completed')
                                                                  ->with('user_data')
                                                                  ->with('patient_data')
                                                                  ->with('doctor_user_data')
                                                                  ->with('consultation_details')
                                                                  ->get();
        if($get_invoice_data)
        {
            $this->arr_view_data['invoice_data'] = $get_invoice_data->toArray();
        }

        $health_images = $this->PatientConsultationImagesModel->where([
                                                                        ['user_id',$this->user_id],
                                                                        ['booking_id',base64_decode($enc_booking_id)]
                                                                    ])
                                                             ->get();
        if(isset($health_images))
        {
            $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        $this->arr_view_data['consultation_documents_base_url']   = $this->consultation_documents_base_url;
        $this->arr_view_data['consultation_documents_public_url'] = $this->consultation_documents_public_url;
        $this->arr_view_data['patient_uploads_url']      = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url'] = $this->patient_uploads_base_url;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;

       return view($this->module_view_folder.'.past_consultation_details')->with($this->arr_view_data);     
    }

    public function declined_consultations()
    {
        if($this->user_id != '')
        {
            $current_datetime   = date("Y-m-d H:i:s");
            $current_date       = date("Y-m-d");
            $current_time       = date("H:i:s");

            $get_declined_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                          ->where(function($query)use($current_datetime){
                                                                              $query->where('booking_status', 'Declined');
                                                                              $query->orWhere('booking_status', 'Cancelled');
                                                                              $query->orWhere('booking_status', 'Rescheduled');
                                                                              /*$query->orWhere([
                                                                                        ['booking_status', 'Pending'],
                                                                                        ['consultation_datetime','<' , $current_datetime]
                                                                                    ]);*/
                                                                          })
                                                                          ->with('doctor_user_details')
                                                                          ->orderBy('id','DESC')
                                                                          ->paginate(10);

            if($get_declined_consult)
            {
                $this->arr_view_data['paginate']         = clone $get_declined_consult;
                $this->arr_view_data['declined_consult_arr'] = $get_declined_consult->toArray();
            }
            
            $this->arr_view_data['patient_id']          = $this->user_id;
            $this->arr_view_data['doctor_image_url']    = $this->doctor_image_url;
            $this->arr_view_data['page_title']          = str_singular($this->module_title);
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.declined_consultations',$this->arr_view_data);
        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }
    }

    public function declined_consultation_details($enc_booking_id)
    {   
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");

        $get_declined_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                      ->where('id',base64_decode($enc_booking_id))
                                                                      ->where(function($query) use($current_datetime){
                                                                        $query->orWhere('booking_status','Declined');
                                                                        $query->orWhere('booking_status','Cancelled');
                                                                        $query->orWhere('booking_status','Rescheduled');
                                                                        /*$query->orWhere([
                                                                           ['booking_status', 'Pending'],
                                                                           ['consultation_datetime','<' , $current_datetime]
                                                                        ]);*/
                                                                      })
                                                                      ->with('doctor_user_details','patient_user_details','familiy_member_info')
                                                                      ->first();
        if($get_declined_consult)
        {
            $this->arr_view_data['declined_consult_arr'] = $get_declined_consult->toArray();
        }

        $health_images = $this->PatientConsultationImagesModel->where([
                                                                        ['user_id',$this->user_id],
                                                                        ['booking_id',base64_decode($enc_booking_id)]
                                                                    ])
                                                             ->get();
        if(isset($health_images))
        {
            $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        $this->arr_view_data['patient_uploads_url']      = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url'] = $this->patient_uploads_base_url;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;

       return view($this->module_view_folder.'.declined_consultation_details')->with($this->arr_view_data);     
    }

     /*--------------------------------------------------------------------------
                    DECLINED CONSULTATION - SEARCH DOCTOR BY NAME 
    ----------------------------------------------------------------------------*/

     public function search_doctor_declined_consultation(Request $request)
    {
      $current_datetime   = date("Y-m-d H:i:s");
      $current_date       = date("Y-m-d");
      $current_time       = date("H:i:s");

      $doc_keyword = $request->doc_keyword;

      $doc_name_arr = explode(' ', $doc_keyword);
      
      $doctor_name = $this->PatientConsultationBookingModel->orderBy('id','desc')
                                                           ->with('doctor_user_details')
                                                           ->where(function($status)use($current_datetime){
                                                                  $status->where('booking_status', 'Declined');
                                                                  $status->orWhere('booking_status', 'Cancelled');    
                                                                  /*$status->orWhere([
                                                                                    ['booking_status', 'Pending'],
                                                                                    ['consultation_datetime','<' , $current_datetime]
                                                                            ]);*/
                                                                })               
                                                              ->groupBy('doctor_user_id')
                                                              ->whereHas('doctor_user_details', function($user_details) use($doc_keyword, $doc_name_arr){
                                                                  if(!empty($doc_keyword))
                                                                    { 
                                                                        if(sizeof($doc_name_arr) == 3)
                                                                        {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');  
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');  
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');  
                                                                        }
                                                                        else if(sizeof($doc_name_arr) > 3)
                                                                        {
                                                                            unset($doctor_name);
                                                                        }
                                                                        else if(strstr($doc_keyword, ' '))
                                                                        {
                                                                            list($fname,$lname) =explode(' ', $doc_keyword);
                                                                            if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                                                                            {
                                                                              $user_details->where('title','like','%'.$fname.'%');  
                                                                              $user_details->Where('first_name','like','%'.$lname.'%');   
                                                                            }
                                                                            else
                                                                            {
                                                                                $user_details->where('first_name','like','%'.$fname.'%');
                                                                                $user_details->where('last_name','like','%'.$lname.'%');
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            $user_details->where('first_name','like','%'.$doc_keyword.'%');
                                                                            $user_details->orWhere('last_name','like','%'.$doc_keyword.'%');  
                                                                            $user_details->orWhere('title','like','%'.$doc_keyword.'%');  
                                                                        }
                                                                        
                                                                     }
                                                            })
                                                              ->paginate(10);
      if(sizeof($doc_name_arr) <= 3 )
      {
          if($doctor_name)
          {
            $doctor_arr = $doctor_name->toArray();
            $doctor_arr =$doctor_arr['data'];
            $arr_json['status'] = 'success';
            $arr_json['data']   = $doctor_arr; 
          }
          else
          {
            $arr_json['status'] = 'error';        
          }
      }
      else
      {
        $arr_json['status'] = 'error';        
      }                                                        


      return response()->json($arr_json);
      
    }

    /*--------------------------------------------------------------------------
                                 DECLINED CONSULTATION - SEARCH 
    ----------------------------------------------------------------------------*/

    public function search_declined_consultation(Request $request)
    {   
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");                                                                      

        $obj_patient = "";
        $obj_declined = $this->PatientConsultationBookingModel->where('patient_user_id',$this->user_id)
                                                                 ->with(['doctor_info','doctor_user_details'])
                                                                 ->where(function($status)use($current_datetime){
                                                                      $status->where('booking_status', 'Declined');
                                                                      $status->orWhere('booking_status', 'Cancelled');    
                                                                      /*$status->orWhere([
                                                                                        ['booking_status', 'Pending'],
                                                                                        ['consultation_datetime','<' , $current_datetime]
                                                                                      ]);*/
                                                                })
                                                                ->orderBy('consultation_datetime','DESC');
                                                                 
        $doc_name_arr = explode(' ', $request->doctor_name); 

        if($request->doctor_name!="")
        {
              $this->arr_view_data['doctor_name']  = $request->doctor_name;
              $doctor_name = $request->doctor_name;
              

                if(sizeof($doc_name_arr) == 3)
                {
                  $obj_declined = $obj_declined->whereHas('doctor_user_details', function($user_details) use($doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$doc_name_arr[0].'%');
                                                                          $user_details->where('first_name','like','%'.$doc_name_arr[1].'%');
                                                                          $user_details->where('last_name','like','%'.$doc_name_arr[2].'%');
                                                                      });

                }
                
              else if(strstr($doctor_name, ' '))
              {
                list($fname,$lname) = explode(' ', $doctor_name);

                if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                {
                   if(isset($fname) && isset($lname))
                    {
                       $obj_declined = $obj_declined->whereHas('doctor_user_details', function($user_details) use($fname,$lname,$doc_name_arr) {
                                                                          $user_details->where('title','like','%'.$fname.'%');
                                                                          $user_details->where('first_name','like','%'.$lname.'%');
                                                                      });
                    } 
                }
                else
                {
                  $obj_declined = $obj_declined->whereHas('doctor_user_details', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                } 
                
                
              }
              else
              { 
                $this->arr_view_data['doctor_name']  = $request->doctor_name;
                $obj_declined = $obj_declined->whereHas('doctor_user_details', function($user_details) use($doctor_name) {
                                                                        if(!empty($doctor_name))
                                                                          { 
                                                                            $user_details->where('first_name',$doctor_name);
                                                                            $user_details->orWhere('last_name',$doctor_name);
                                                                           }
                                                                       });

              }        
        }
        if($request->selected_date!="")
        {
          $this->arr_view_data['selected_date']  = $request->selected_date;
          $date1 = strtr($request->selected_date, '/', '-');
          $date=date('Y-m-d', strtotime($date1)); 
                
          $obj_declined = $obj_declined->where('consultation_date',$date);
        }

        if($request->selected_time!="")
        {
          $this->arr_view_data['selected_time']  = $request->selected_time;
          
          $time = date("H:i:s", strtotime($request->selected_time));
                
          $obj_declined = $obj_declined->where('consultation_time',$time);
        }   

        $obj_declined = $obj_declined->paginate(10);

        if($obj_declined)
        {
          $this->arr_view_data['paginate']             = clone $obj_declined;
          $this->arr_view_data['declined_consult_arr'] = $obj_declined->toArray();
        }
        $this->arr_view_data['patient_id']               = $this->user_id;
        return view($this->module_view_folder.'.declined_search')->with($this->arr_view_data);                                                         
    }

    public function past_consultation_invoice($enc_booking_id)
    {
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");
        $booking_id         = base64_decode($enc_booking_id);

        $get_invoice_data = $this->PatientConsultationPaymentModel->where('booking_id', $booking_id)
                                                                  ->where('payment_status', 'completed')
                                                                  ->with('user_data')
                                                                  ->with('patient_data')
                                                                  ->with('doctor_user_data')
                                                                  ->with('consultation_details')
                                                                  ->get();
        if($get_invoice_data)
        {
            $this->arr_view_data['invoice_data'] = $get_invoice_data->toArray();
        }

        $get_admin_data = $this->AdminProfileModel->first();
        if($get_admin_data)
        {
            $this->arr_view_data['admin_data'] = $get_admin_data->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        $this->arr_view_data['patient_uploads_url']      = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url'] = $this->patient_uploads_base_url;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;
        $this->arr_view_data['enc_booking_id']           = $enc_booking_id;

       return view($this->module_view_folder.'.past_consultation_invoice')->with($this->arr_view_data);   
    }


    public function new_consultation_request_details($enc_booking_id)
    {   
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");

        $get_new_consult    = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                        /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                                        ->where('booking_status', 'Pending')
                                                                        ->where('id',base64_decode($enc_booking_id))
                                                                        ->with('doctor_user_details','patient_user_details','familiy_member_info')
                                                                        ->first();
         

        if($get_new_consult)
        {
            $this->arr_view_data['new_consult_arr'] = $get_new_consult->toArray();
        }
       
        $health_images =$this->PatientConsultationImagesModel->where([
                                                                        ['user_id',$this->user_id],
                                                                        ['booking_id',base64_decode($enc_booking_id)]
                                                                    ])
                                                             ->get();
        if(isset($health_images))
        {
            $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        $this->arr_view_data['patient_uploads_url']      = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url'] = $this->patient_uploads_base_url;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;

       return view($this->module_view_folder.'.new_consultation_request_details')->with($this->arr_view_data);     
    }

    /*--------------------------------------------------------------------------
                            PAST CONSULTATION - INVOICE PDF
    ----------------------------------------------------------------------------*/

    public function past_consultation_invoice_download($enc_booking_id)
    {
        $current_datetime   = date("Y-m-d H:i:s");
        $current_date       = date("Y-m-d");
        $current_time       = date("H:i:s");
        $booking_id         = base64_decode($enc_booking_id);

        /*$consult_invoice = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                 ->where('consultation_datetime', '<=', $current_datetime)
                                                                 ->where(function($query) use($current_datetime){
                                                                    $query->where('booking_status','Completed');
                                                                  })
                                                                 ->where('id',base64_decode($enc_booking_id))
                                                                 ->with('doctor_user_details','patient_user_details','patient_info','familiy_member_info')
                                                                 ->first();

                                                                          
        if($consult_invoice)
        {
            $this->arr_view_data['consult_invoice'] = $consult_invoice->toArray();
        }*/

        $get_invoice_data = $this->PatientConsultationPaymentModel->where('booking_id', $booking_id)
                                                                  ->where('payment_status', 'completed')
                                                                  ->with(['user_data', 'patient_data', 'doctor_user_data', 'consultation_details'])
                                                                  ->get();
        if($get_invoice_data)
        {
            $this->arr_view_data['invoice_data'] = $get_invoice_data->toArray();
        }
        //dd($this->arr_view_data['invoice_data']);

        $get_admin_data = $this->AdminProfileModel->first();
        if($get_admin_data)
        {
            $this->arr_view_data['admin_data'] = $get_admin_data->toArray();
        }

        $this->arr_view_data['patient_id']               = $this->user_id;
        $this->arr_view_data['patient_uploads_url']      = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url'] = $this->patient_uploads_base_url;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;
        $this->arr_view_data['enc_booking_id']           = $enc_booking_id;

        Session::put("arr_invoice_data",'');
        return response()->json($this->arr_view_data);
    }

    public function generate_invoice_pdf(Request $request)
    {
      if($request->has('arr_data') && $request->input('arr_data')!='')
      {
        $arr_session_data = $request->input('arr_data');
        Session::put("arr_invoice_data",$arr_session_data);
        return response()->json(['status'=>'success']);
      }
      
      $arr_data = Session::get("arr_invoice_data");
      if(!empty($arr_data))
      {
          PDF::setHeaderCallback(function($pdf){
              $pdf->SetY(15);
              
              $pdf->SetFont('helvetica', 'B', 20);
             
              $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);

              $pdf->SetY(40);
          });

          // Custom Footer
          PDF::setFooterCallback(function($pdf) {

              // Position at 15 mm from bottom
              $pdf->SetY(-15);
              // Set font
              $pdf->SetFont('helvetica', 'I', 8);
              // Page number
              $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

          });
          $file_name="past_consultation_invoice";
        
         PDF::SetTitle('Doctoroo | Past Consultation Invoice');
         PDF::SetMargins(10, 30, 10, 10);
         PDF::SetFontSubsetting(false);
         PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
         PDF::AddPage();
         PDF::writeHTML(view($this->module_view_folder.'.pdf.past_consultation_invoice', $arr_data)->render());
         PDF::Output($file_name.'.pdf');      
      }
      
      return redirect()->back();

    }    


    /*
    | Function  : update booking time using update time and booking id
    | Author    : Deepak Arvind Salunke
    | Date      : 04/11/2017
    | Output    : Update booking time and send notification, sms to patient
    */

    public function update_booking_call_status(Request $request)
    {
      $consultation_id  = $request->input('booking_id');
      $call_status      = $request->input('call_status');

      $get_booking_data = $this->PatientConsultationBookingModel->with('doctor_info')->where('id', $consultation_id)->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
      }
      $user = Sentinel::check();

      if($call_status == 'ready')      
      {
        $update['patient_is_ready'] = 1;
        $status_message = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' is ready for call. He/She will be calling you in few minutes. Please be online for consultation to start.';
      }
      else if($call_status == 'busy')
      {
        $update['patient_is_ready'] = 0;
        $status_message = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' is busy. He/She will notify his updates. As soon as he will be free.';
      }

      $update_booking_data = $this->PatientConsultationBookingModel->where('id', $consultation_id)->update($update);
      if($update_booking_data)
      {
        $get_patient_data = $this->UserModel->with('patientinfo')->where('id', $user->id)->first();
        if($get_patient_data)
        {
          $patient_data = $get_patient_data->toArray();
        }

        $notify['from_user_id'] = $this->user_id;
        $notify['to_user_id']   = $booking_data['doctor_user_id'];
        $notify['booking_id']   = $consultation_id;
        $notify['message']      = $status_message;
        $notify['status']       = 'unread';
        
        $this->NotificationModel->insert($notify);

        // get mobile country code
        $get_mobile_code = $this->MobileCountryCodeModel->where('id', $patient_data['patientinfo']['mobile_code'])->first();
        if($get_mobile_code)
        {
          $mobile_data = $get_mobile_code->toArray();
        }

        // send sms to patient
        $to       = '+'.$mobile_data['phonecode'].''.$booking_data['doctor_info']['mobile_no'];
        $message  = $status_message;

        $sid            = env('TWILIO_SMS_SID');
        $token          = env('TWILIO_SMS_TOKEN');
        $twilioNumber   = env('TWILIO_NUMBER');        
        $client         = new Client($sid, $token);

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
            $arr_json['status'] =  "error";
            $arr_json['msg']    =  'Error! Something went wrong';
            return response()->json($arr_json);
        }

        $arr_json['status'] =  "success";
        $arr_json['msg']    =  'Consultation update send successfully';
        return response()->json($arr_json);

      }
      else
      {
        $arr_json['status'] =  "error";
        $arr_json['msg']    =  'Error! Something went wrong';
        return response()->json($arr_json);
      }

    } // end update_booking_call_status


    /*
    | Function  : update booking time using update time and booking id
    | Author    : Deepak Arvind Salunke
    | Date      : 03/11/2017
    | Output    : Update booking time and send notification, sms to patient
    */

    public function update_booking_time(Request $request)
    {
      $consultation_id  = $request->input('consultation_id');
      $update_time      = $request->input('update_time');

      $user = Sentinel::check();

      $get_booking_data = $this->PatientConsultationBookingModel->where('id', $consultation_id)->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
      }

      $booking_datetime = strtotime($booking_data['consultation_datetime']);
      $booking_time     = strtotime($booking_data['consultation_time']);

      $data['consultation_datetime'] = date('Y-m-d H:i:s', strtotime('+'.$update_time.' mins', $booking_datetime));
      $data['consultation_time']     = date('H:i:s', strtotime('+'.$update_time.' mins', $booking_time));

      $update_booking = $this->PatientConsultationBookingModel->where('id', $consultation_id)->update($data);
      if($update_booking)
      {
        $doctor_id = $booking_data['doctor_user_id'];
        $get_doctor_data = $this->UserModel->with('doctor_details')->where('id', $doctor_id)->first();
        if($get_doctor_data)
        {
          $doctor_data = $get_doctor_data->toArray();
        }

        $notify['from_user_id'] = $this->user_id;
        $notify['to_user_id']   = $booking_data['doctor_user_id'];
        $notify['booking_id']   = $booking_data['id'];
        $notify['message']      = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' will be calling you in '.$update_time.' minutes. Please be ready in a quite, private area.';
        $notify['status']       = 'unread';
        
        $this->NotificationModel->insert($notify);

        // get mobile country code
        $get_mobile_code = $this->MobileCountryCodeModel->where('id', $doctor_data['doctor_details']['mobile_code'])->first();
        if($get_mobile_code)
        {
          $mobile_data = $get_mobile_code->toArray();
        }

        // send sms to patient
        $to       = '+'.$mobile_data['phonecode'].''.$doctor_data['doctor_details']['mobile_no'];
        $message  = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' will be calling you in '.$update_time.' minutes. Please be ready in a quite, private area.';

        $sid            = env('TWILIO_SMS_SID');
        $token          = env('TWILIO_SMS_TOKEN');
        $twilioNumber   = env('TWILIO_NUMBER');        
        $client         = new Client($sid, $token);

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
            $arr_json['status'] =  "error";
            $arr_json['msg']    =  'Error! Something went wrong';
            return response()->json($arr_json);
        }

        $arr_json['status'] =  "success";
        $arr_json['msg']    =  'Consultation Time Updated';
        return response()->json($arr_json);
      }
      else
      {
        $arr_json['status'] =  "error";
        $arr_json['msg']    =  'Error! Something went wrong';
        return response()->json($arr_json);
      }

    } // end update_booking_time

    public function start_video_call(Request $request)
    {
        $booking_id  = $request->input('booking_id');
        $call_status = $request->input('call_status');
        $patient_id  = $this->user_id;

        if($call_status == 'started')
        {
            $msg = 'Please join video call now.';
        }

        $user = Sentinel::check();
        $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->first();
        if($get_booking_data)
        {
            $booking_data = $get_booking_data->toArray();
            $doctor_id = $booking_data['doctor_user_id'];

            $get_doctor_data = $this->UserModel->with('doctor_details')->where('id', $doctor_id)->first();
            if($get_doctor_data)
            {
              $doctor_data = $get_doctor_data->toArray();
            }

            $notify['from_user_id'] = $this->user_id;
            $notify['to_user_id']   = $booking_data['doctor_user_id'];
            $notify['booking_id']   = $booking_data['id'];
            $notify['message']      = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' has '.$call_status.' the video call. '.$msg;
            $notify['status']       = 'unread';

            $this->NotificationModel->insert($notify);

            // get mobile country code
            $get_mobile_code = $this->MobileCountryCodeModel->where('id', $doctor_data['doctor_details']['mobile_code'])->first();
            if($get_mobile_code)
            {
              $mobile_data = $get_mobile_code->toArray();
            }

            // send sms to patient
            $to       = '+'.$mobile_data['phonecode'].''.$doctor_data['doctor_details']['mobile_no'];
            $message  = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' has '.$call_status.' the video call. '.$msg;

            $sid            = env('TWILIO_SMS_SID');
            $token          = env('TWILIO_SMS_TOKEN');
            $twilioNumber   = env('TWILIO_NUMBER');        
            $client         = new Client($sid, $token);

              $client->messages->create(
                $to,
                [
                  "body" => $message,
                  "from" => $twilioNumber
                ]
              );

            if(!empty($patient_id) && isset($patient_id))
            {
              $data['active_video_call'] = 'yes';
              $update_data = $this->UserModel->where('id', $patient_id)->update($data);

              $booking_data['patient_active_video_call'] = 'yes';
              $booking_data['doctor_active_video_call']   = 'no';
              $update_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->update($booking_data);
            }
        }

    } // end start_video_call


    public function check_doctor_active_video_call(Request $request)
    {
        $patient_id  = $this->user_id;

        $get_booking_data = $this->PatientConsultationBookingModel->with('doctor_user_details')->where('patient_user_id', $patient_id)->get();
        
        if($get_booking_data)
        {
            $booking_data = $get_booking_data->toArray();
            foreach($booking_data as $data)
            {
                if($data['doctor_active_video_call'] == 'yes')
                {
                    if(empty(\Session::get('doctor_call_time_count'))){
                        \Session::put('doctor_call_time_count' , '1');
                    }else if(\Session::get('doctor_call_time_count') >= 10){
                        \Session::forget('doctor_call_time_count');
                        \Session::forget('doctor_call_time');
                        $booking_id = $data['id'];
                        $update_data['doctor_active_video_call']  = 'no';
                        $update_data['patient_active_video_call'] = 'no';
                        $this->PatientConsultationBookingModel->where('id', $booking_id)->update($update_data);
                        $update_data = [];
                        $update_data['active_video_call'] = 'no';
                        $this->UserModel->where('id', $this->user_id)->update($update_data);


                    }else {
                      if(\Session::get('doctor_call_time') == $data['call_time']){
                         $add = (\Session::get('doctor_call_time_count') + 1);
                         \Session::put('doctor_call_time_count' , $add);
                      }
                      else{
                         \Session::put('doctor_call_time'  ,  $data['call_time']);
                      }
                    }
                    $arr_json['msg']    =  'Consultation Update: '.$data['doctor_user_details']['title'].' '.$data['doctor_user_details']['first_name'].' '.$data['doctor_user_details']['last_name'].' has started video call for the consultation '.$data['consultation_id'].'<br/><br/><a class="open_video_call right accept-btn-green btn green round-corner " data-doctor_id="'.base64_encode($data['doctor_user_id']).'" data-status="started" data-booking_id="'.base64_encode($data['id']).'" style="cursor: pointer;"><i class="material-icons">&#xE0B0;</i> Accept</a><div class="end-call-btn right reject-btn-green btn red round-corner" ><a href="javascript:void(0);" onclick="reject_call('.$data['id'].')"><i class="material-icons">&#xE0B1;</i> Reject</a></div>';
                    return response()->json($arr_json);
                }
                else if($data['doctor_active_video_call'] == 'running' || $data['doctor_active_video_call'] == 'reject') {
                  
                    if(empty(\Session::get('running_doctor_call_time_count'))){
                        \Session::put('running_doctor_call_time_count' , '1');
                    }else if(\Session::get('running_doctor_call_time_count') >= 10){
                      
                        \Session::forget('running_doctor_call_time_count');
                        \Session::forget('running_doctor_call_time');
                        \Session::forget('running_patient_call_time');
                        $booking_id = $data['id'];
                        $update_data['doctor_active_video_call']  = 'no';
                        $update_data['patient_active_video_call'] = 'no';
                        $this->PatientConsultationBookingModel->where('id', $booking_id)->update($update_data);

                        $update_data = [];
                        $update_data['active_video_call'] = 'no';
                        $this->UserModel->where('id', $this->user_id)->update($update_data);


                    }else {
                      if(\Session::get('running_doctor_call_time') == $data['call_time'] && \Session::get('running_patient_call_time') == $data['call_time_patient']){
                         $add = (\Session::get('running_doctor_call_time_count') + 1);
                         \Session::put('running_doctor_call_time_count' , $add);
                      }
                      else{
                         \Session::put('running_doctor_call_time'  ,  $data['call_time']);
                         \Session::put('running_patient_call_time'  , $data['call_time_patient']);
                      }
                    }
                    /*$arr_json['msg']    =  \Session::get('doctor_call_time_count').' '.$data['call_time_patient'].' '.$data['call_time'];
                    return response()->json($arr_json); */
                }
            }
        }
    } // end check_doctor_active_video_call


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