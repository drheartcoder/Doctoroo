<?php
namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\FamilyMemberModel;
use App\Models\DoctorModel;
use App\Models\VideoChatModel;
use App\Models\MobileCountryCodeModel;
use App\Models\NotificationModel;
use App\Models\PatientConsultationBookingModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Session;

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpentokApi;
use OpenTok\Role;
use OpenTokException;
use OpenTok\OutputMode;
use Twilio\Rest\Client;

class VideoChatController extends Controller
{
    public function __construct(
                                  UserModel                 $user_model,
                                  PatientModel              $patient_model,
                                  FamilyMemberModel         $family_member_model,
                                  DoctorModel               $doctor_model,
                                  VideoChatModel            $video_model,
                                  MobileCountryCodeModel    $MobileCountryCodeModel,
                                  NotificationModel  $NotificationModel,
                                  PatientConsultationBookingModel $PatientConsultationBookingModel
                                )
    {
        $this->arr_view_data                    = [];
        
        $this->UserModel                        = $user_model;
        $this->PatientModel                     = $patient_model;
        $this->FamilyMemberModel                = $family_member_model;
        $this->DoctorModel                      = $doctor_model;
        $this->VideoChatModel                   = $video_model;
        $this->MobileCountryCodeModel           = $MobileCountryCodeModel;
        $this->NotificationModel                = $NotificationModel;
        $this->PatientConsultationBookingModel  = $PatientConsultationBookingModel;

        $this->sid                              = config('services.twilio')['accountSid'];
        $this->token                            = config('services.twilio')['auth_token'];
        $this->service_id                       = config('services.twilio')['service_id'];
        $this->client                           = new Client($this->sid,$this->token);

      	$this->module_view_folder               = 'front.patient.videochat';
        $this->module_url_path                  = url('/').'/patient/videochat';
        
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 06/09/2017
    | Output    : 
    */

    public function index($enc_id)
    {
      $current_datetime = date('Y-m-d H:i:s');
      $booking_id       = base64_decode($enc_id);
      $patient_id       = $this->user_id;
      $call_time        = '00:00:00';

      $user = Sentinel::check();

      $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
        $doctor_id    = $booking_data['doctor_user_id'];


        if($booking_data['doctor_active_video_call'] == 'running'){
          echo "<script>window.close();</script>";
        }

        /*$get_doctor_data = $this->UserModel->with('doctor_details')->where('id', $doctor_id)->first();
        if($get_doctor_data)
        {
          $doctor_data = $get_doctor_data->toArray();
        }

        $notify['from_user_id'] = $this->user_id;
        $notify['to_user_id']   = $booking_data['doctor_user_id'];
        $notify['booking_id']   = $booking_data['id'];
        $notify['message']      = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' has started the video call. Please join video call now.';
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
        $message  = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' has started the video call. Please join video call now.';

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
          );*/
      }



      if(!empty($patient_id) && isset($patient_id))
      {
        $data['active_video_call'] = 'yes';
        $update_data = $this->UserModel->where('id', $patient_id)->update($data);

        $data = [];
        $data['doctor_active_video_call']   = 'running';
        $data['patient_active_video_call']  = 'running';
        $update_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->update($data);
      }

      $get_data = $this->VideoChatModel->where('patient_id', $patient_id)
                                       ->where('doctor_id', $doctor_id)
                                       ->first();
      
      if(count($get_data) == 1)
      {
          $video_data = $get_data->toArray();

          $end_date = date('Y-m-d H:i:s', strtotime($video_data['created_at']. ' + 6 hours'));

          $current_datetime = strtotime($current_datetime);
          $expire_date = strtotime($end_date);

          if ($expire_date < $current_datetime)
          {
              $delete_data = $this->VideoChatModel->where('patient_id', $patient_id)
                                                  ->where('doctor_id', $doctor_id)
                                                  ->where('id', $video_data['id'])
                                                  ->delete();
              if($delete_data)
              {
                  $data = $this->generate_data($patient_id, $doctor_id);
                  $video_data = $this->VideoChatModel->create($data);
              }
          }

      }

      else if(count($get_data) == 0)
      {
        $data = $this->generate_data($patient_id, $doctor_id);
        $video_data = $this->VideoChatModel->create($data);
      }

      $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
        $get_call_time = $booking_data['call_time'];

        if(!empty($get_call_time) && $get_call_time != null)
        {
          $temp_call_time = strtotime($call_time)-strtotime("00:00:00");
          $call_time = date("H:i:s",strtotime($get_call_time)+$temp_call_time);
        }
      }

      $this->arr_view_data['sessionId']           = $video_data['session_id'];
      $this->arr_view_data['api_key']             = $video_data['api_key'];
      $this->arr_view_data['token']               = $video_data['token'];
      $this->arr_view_data['booking_id']          = $booking_id;
      $this->arr_view_data['call_time']           = $call_time;

      $this->arr_view_data['page_title']          = "Video Chat";
      $this->arr_view_data['module_url_path']     = $this->module_url_path;
        
      return view($this->module_view_folder.'.index',$this->arr_view_data);
    } // end index


    /*
    | Function  : generate data for video chat
    | Author    : Deepak Arvind Salunke
    | Date      : 27/09/2017
    | Output    : generated data
    */

    public function generate_data($patient_id, $doctor_id)
    {
        $openTokAPI = new OpenTok(env('TOKBOX_API_KEY'), env('TOXBOX_API_SECRET'));
        $session    = $openTokAPI->createSession(array('mediaMode' => MediaMode::ROUTED));
        $sessionId  = $session->getSessionId();
        
        $data['patient_id'] = $patient_id;
        $data['doctor_id']  = $doctor_id;
        $data['session_id'] = $sessionId;
        $data['api_key']    = env('TOKBOX_API_KEY');
        $data['token']      = $openTokAPI->generateToken($sessionId);

        return $data;
    } // end generate_data


    /*
    | Function  : get booking id and assgin it to room
    | Author    : Deepak Arvind Salunke
    | Date      : 07/10/2017
    | Output    : Open new window for video chat
    */

    public function connect_video($enc_id)
    {
        //dd($enc_id);
        $booking_id = base64_decode($enc_id);

        $this->arr_view_data['booking_id']           = $booking_id;

        $this->arr_view_data['page_title']          = "Video Chat";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
          
        return view($this->module_view_folder.'.connect_video',$this->arr_view_data);

    } // end connect_video

    public function update_video_call_status(Request $request)
    {
      $get_call_time = '';
      $user_id = $this->user_id;
      $call_time = $request->input('call_time');
      $booking_id = $request->input('booking_id');

      $call['call_time'] = $call_time;
      $call['patient_active_video_call'] = 'end';
      $call['doctor_active_video_call'] = 'end';
      $booking_update = $this->PatientConsultationBookingModel->where('id', $booking_id)->update($call);

      $data = [];
      $data['active_video_call'] = 'no';
      $update_data = $this->UserModel->where('id', $user_id)->update($data);
      echo 'success';
    } // end update_video_call_status

    public function update_video_call_end_status(Request $Request)
    {
      $user_id = $this->user_id;
      $booking_id = $Request->input('booking_id');
      $call_time = $Request->input('call_time');
      //$data['call_time'] = $call_time;
      $data['doctor_active_video_call']  = 'no';
      $data['patient_active_video_call'] = 'no';
      $update_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->update($data);

      $data = [];
      $data['active_video_call'] = 'no';
      $update_data = $this->UserModel->where('id', $user_id)->update($data);
      echo 'success';

    } // end update_video_call_status

     public function update_video_call_reject_status(Request $Request)
    {
      $user_id = $this->user_id;
      $booking_id = $Request->input('booking_id');
      //$data['call_time'] = $call_time;
      $data['patient_active_video_call'] = 'reject';
      $data['doctor_active_video_call']  = 'reject';
      $update_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->update($data);

      $data = [];
      $data['active_video_call'] = 'no';
      $update_data = $this->UserModel->where('id', $user_id)->update($data);
      echo 'success';

    } // end update_video_call_status

    public function update_video_call_time(Request $Request)
    {
      $user_id    = $this->user_id;
      $booking_id = $Request->input('booking_id');
      $call_time  = $Request->input('time');

      $data['call_time_patient']  = $call_time;
      $update_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->update($data);

      $getDoctorCallTime = $this->PatientConsultationBookingModel->where('id', $booking_id)->first();

      echo $getDoctorCallTime['call_time'];
    } 


    public function check_doctor_active(Request $request)
    {
      $booking_id = $request->input('booking_id');
      
      $get_booking_data = $this->PatientConsultationBookingModel->with('doctor_user_details')->where('id', $booking_id)->get();
      if($get_booking_data)
      {
          $booking_data = $get_booking_data->toArray();

          foreach($booking_data as $data)
          {
              if($data['doctor_active_video_call'] == 'end')
              {
                $arr_json['msg']    =  'Consultation Update: '.$data['doctor_user_details']['title'].' '.$data['doctor_user_details']['first_name'].' '.$data['doctor_user_details']['last_name'].' has closed video call for the consultation '.$data['consultation_id'].'<div class="clearfix"></div>'.'<button class="btn btn_call_end margin-top-btn right " onclick="close_call()">Close Tab</button>';
                $arr_json['call_status']    =  'end';
                return response()->json($arr_json);
              }
              else if($data['doctor_active_video_call'] == 'reject')
              {
                $arr_json['msg']    =  'Consultation Update: '.$data['doctor_user_details']['title'].' '.$data['doctor_user_details']['first_name'].' '.$data['doctor_user_details']['last_name'].' has rejected video call for the consultation '.$data['consultation_id'].'<div class="clearfix"></div>'.'<button class="btn btn_call_end margin-top-btn right" onclick="close_call()">Close Tab</button>';
                $arr_json['call_status']    =  'reject';
                return response()->json($arr_json);
              }
          }

      }
    } // end check_doctor_active

}
?>