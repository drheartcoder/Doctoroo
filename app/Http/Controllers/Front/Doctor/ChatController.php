<?php
namespace App\Http\Controllers\Front\Doctor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ChatModel;
use App\Models\UserModel;
use App\Models\PatientConsultationBookingModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Validator;
use Session;

use App\Common\Services\VirgilService;

use Twilio\Rest\Client;
use Twilio\Rest\IpMessaging;

class ChatController extends Controller
{
    public function __construct(PatientConsultationBookingModel     $booking_model,
                                ChatModel                           $chat_model,
                                VirgilService                       $VirgilService,
                                UserModel                           $UserModel)
    {

        $this->arr_view_data                    = [];
        $this->ChatModel                        = $chat_model;
        $this->PatientConsultationBookingModel  = $booking_model;
        $this->VirgilService                    = $VirgilService;
        $this->UserModel                        = $UserModel;

        $this->module_url_path                  = url('/').'/doctor/profile';
        $this->module_chat_path                 = url('/').'/doctor/patients/chats';
        $this->module_view_folder               = 'front.doctor.chat';
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
            $this->user    = $user;
        }

 
        $this->arr_view_data['page_title']              = "My Message";
        $this->arr_view_data['module_chat_path']        = $this->module_chat_path;
        $this->arr_view_data['module_url_path']         = $this->module_url_path;

        $this->profile_img_base_path                    = public_path().config('app.project.img_path.patient');
        $this->profile_img_public_path                  = url('/public').config('app.project.img_path.patient');
        $this->arr_view_data['patient_base_img_path']   = $this->profile_img_base_path;
        $this->arr_view_data['patient_public_img_path'] = $this->profile_img_public_path;

        $this->sid        = config('services.twilio')['accountSid'];
        $this->token      = config('services.twilio')['auth_token'];
        $this->service_id = config('services.twilio')['service_id'];
        $this->client     = new Client($this->sid,$this->token);
    }
    
    public function index()
    {
        $friendlyName     = '';
        $arr_patient_list =  $arr_sent_msg = [];
        $arr_patient_list =  $this->get_patient_list();

        $this->arr_view_data['profile_img_base_path']   = $this->profile_img_base_path;
        $this->arr_view_data['profile_img_public_path'] = $this->profile_img_public_path;
      
        $this->arr_view_data['arr_sent_msg']            = $arr_sent_msg;
        $this->arr_view_data['friendly_Name']           = $friendlyName;  
        $this->arr_view_data['arr_patient_list']        = $arr_patient_list;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }


    /*
    | Function  : Create channel and get all the send and incoming msgs
    | Author    : Deepak Arvind Salunke
    | Date      : 23/08/2017
    | Output    : Display all the send and incoming msgs
    */

    public function create_channel($enc_id)
    {
        $patient_id = '';
        $is_exist_channel = $patient_data = $channel = $arr_chat = [];

        /*$channel = $this->client->ipMessaging
                                    ->services($this->service_id)
                                    ->channels("CH87c2112361084dd7ad7ba207caf4622e")
                                    ->delete();
                                    die;*/

        $patient_id = base64_decode($enc_id);

        $is_exist_channel = $this->ChatModel->where('doctor_id', $this->user_id)
                                            ->where('patient_id', $patient_id)
                                            ->first();

        $patient_data = $this->get_user_info($patient_id);

        /*$delete_patient_user = $this->delete_user($this->user->first_name.''.$this->user->last_name);
        $delete_doctor_user = $this->delete_user($patient_data->first_name.''.$patient_data->last_name);
        die;*/

        if(count($is_exist_channel) == 0)
        {
            $channel = $this->client->ipMessaging
                                    ->services($this->service_id)
                                    ->channels
                                    ->create(
                                        array(
                                            'friendlyName' => $patient_data['first_name'].''.$patient_data['last_name'].''.$patient_data['id'].'-'.$this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                            //'uniqueName' => $patient_data->first_name.''.$patient_data->last_name.''.$patient_data->id.'-'.$this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                            'type' => 'private',
                                            'createdBy' => $this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                        )
                                    );

            //$create_patient_user = $this->create_user($this->user->first_name.''.$this->user->last_name.''.$this->user_id);
            //$create_doctor_user  = $this->create_user($patient_data->first_name.''.$patient_data->last_name.''.$patient_data->id);

            $arr_chat['patient_id']     = $patient_id;
            $arr_chat['doctor_id']      = $this->user_id;
            $arr_chat['channel_id']     = $channel->sid;
            //$arr_chat['patient_name']   = $create_patient_user;
            //$arr_chat['doctor_name']    = $create_doctor_user;
            $arr_chat['patient_name']   = $patient_data['first_name'].''.$patient_data['last_name'].''.$patient_data['id'];
            $arr_chat['doctor_name']    = $this->user->first_name.''.$this->user->last_name.''.$this->user_id;

            $obj_chat = $this->ChatModel->create($arr_chat);

            $add_doctor_member  = $this->add_member($obj_chat->channel_id, $this->user->first_name.''.$this->user->last_name.''.$this->user_id);
            $add_patient_member = $this->add_member($obj_chat->channel_id, $patient_data['first_name'].''.$patient_data['last_name'].''.$patient_data['id']);

            $channel_id     = $obj_chat->channel_id;
            $dump_session   = '';
            $dump_id        = '';

            $this->arr_view_data['patient_data']        = $patient_data;
            $this->arr_view_data['arr_all_msg']         = $this->get_all_message($patient_id);
        }
        else if(count($is_exist_channel) >0)
        {
            $chat_data      = $is_exist_channel->toArray();
            $channel_id     = $chat_data['channel_id'];
            $dump_session   = $chat_data['dump_session'];
            $dump_id        = $chat_data['dump_id'];

            $this->arr_view_data['patient_data']        = $patient_data;
            $this->arr_view_data['arr_all_msg']         = $this->get_all_message($patient_id);
        }
        //dd($this->arr_view_data['arr_all_msg']);

        // get user timezone
        $get_user_data = $this->UserModel->where('id',$this->user_id)->with('doctor_details', 'doctor_details.timezone_data')->first();
        if($get_user_data)
        {
            $user_data = $get_user_data->toArray();
            $user_timezone_id = $user_data['doctor_details']['timezone'];
            $this->arr_view_data['timezone_location'] = $user_data['doctor_details']['timezone_data']['location'];
        }

        $this->arr_view_data['patient_id']              = $patient_id;
        $this->arr_view_data['enc_patient_id']          = $enc_id;
        $this->arr_view_data['patient_pic']             = $patient_data['profile_image'];
        $this->arr_view_data['doctor_name']             = $this->user->first_name.''.$this->user->last_name.''.$this->user_id;
        $this->arr_view_data['patient_name']            = $patient_data['first_name'].''.$patient_data['last_name'].''.$patient_data['id'];
        $this->arr_view_data['channel_id']              = $channel_id;
        $this->arr_view_data['dump_session']            = $dump_session;
        $this->arr_view_data['dump_id']                 = $dump_id;

        $this->arr_view_data['page_title']              = "Chat Messages";
        $this->arr_view_data['module_url_path']         = $this->module_url_path;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    } // end create_channel


    /*
    | Function  : Create channel and get all the send and incoming msgs using ajax in message section
    | Author    : Tushar A
    | Date      : 07/11/2017
    | Output    : Display all the send and incoming msgs
    */

    public function create_channel_or_get_message($enc_id)
    {
        $patient_id = '';
        $is_exist_channel = $patient_data = $channel = $arr_chat = [];

        /*$channel = $this->client->ipMessaging
                                    ->services($this->service_id)
                                    ->channels("CH87c2112361084dd7ad7ba207caf4622e")
                                    ->delete();
                                    die;*/

        $patient_id = base64_decode($enc_id);

        $is_exist_channel = $this->ChatModel->where('doctor_id', $this->user_id)
                                            ->where('patient_id', $patient_id)
                                            ->first();

        $patient_data  =  $this->get_user_info($patient_id);

        if(count($is_exist_channel) == 0)
        {
            $channel = $this->client->ipMessaging
                                    ->services($this->service_id)
                                    ->channels
                                    ->create(
                                        array(
                                            'friendlyName' => $patient_data['first_name'].''.$patient_data['last_name'].''.$patient_data['id'].'-'.$this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                            //'uniqueName' => $patient_data->first_name.''.$patient_data->last_name.''.$patient_data->id.'-'.$this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                            'type' => 'private',
                                            'createdBy' => $this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                        )
                                    );

            //$create_patient_user = $this->create_user($this->user->first_name.''.$this->user->last_name.''.$this->user_id);
            //$create_doctor_user  = $this->create_user($patient_data->first_name.''.$patient_data->last_name.''.$patient_data->id);

            $arr_chat['patient_id']     = $patient_id;
            $arr_chat['doctor_id']      = $this->user_id;
            $arr_chat['channel_id']     = $channel->sid;
            //$arr_chat['patient_name']   = $create_patient_user;
            //$arr_chat['doctor_name']    = $create_doctor_user;
            $arr_chat['patient_name']   = $patient_data['first_name'].''.$patient_data['last_name'].''.$patient_data['id'];
            $arr_chat['doctor_name']    = $this->user->first_name.''.$this->user->last_name.''.$this->user_id;

            $obj_chat = $this->ChatModel->create($arr_chat);

            $add_doctor_member  = $this->add_member($obj_chat->channel_id, $this->user->first_name.''.$this->user->last_name.''.$this->user_id);
            $add_patient_member = $this->add_member($obj_chat->channel_id, $patient_data['first_name'].''.$patient_data['last_name'].''.$patient_data['id']);

            $channel_id     = $obj_chat->channel_id;
            $dump_session   = '';
            $dump_id        = '';

            $this->arr_view_data['patient_data']        = $patient_data;
            $this->arr_view_data['arr_all_msg']         = $this->get_all_message($patient_id);
        }
        else if(count($is_exist_channel) >0)
        {
            $chat_data                                  = $is_exist_channel->toArray();
            $channel_id                                 = $chat_data['channel_id'];
            $dump_session                               = $chat_data['dump_session'];
            $dump_id                                    = $chat_data['dump_id'];

            $this->arr_view_data['patient_data']        = $patient_data;
            $this->arr_view_data['arr_all_msg']         = $this->get_all_message($patient_id);
        }

        // get user timezone
        $get_user_data = $this->UserModel->where('id',$this->user_id)->with('doctor_details', 'doctor_details.timezone_data')->first();
        if($get_user_data)
        {
            $user_data = $get_user_data->toArray();
            $user_timezone_id = $user_data['doctor_details']['timezone'];
            $this->arr_view_data['timezone_location'] = $user_data['doctor_details']['timezone_data']['location'];
        }

        $this->arr_view_data['patient_id']              = $patient_id;
        $this->arr_view_data['enc_patient_id']          = $enc_id;
        $this->arr_view_data['patient_pic']             = $patient_data->profile_image;
        $this->arr_view_data['doctor_name']             = $this->user->first_name.''.$this->user->last_name.''.$this->user_id;
        $this->arr_view_data['patient_name']            = $patient_data->first_name.''.$patient_data->last_name.''.$patient_data->id;
        $this->arr_view_data['page_title']              = "Chat Messages";
        $this->arr_view_data['module_url_path']         = $this->module_url_path;

        if(isset($this->user->profile_image) && !empty($this->user->profile_image)){
            $dr_profile_image = url('/public').config('app.project.img_path.doctor_image').$this->user->profile_image;
        }
        else{
            $dr_profile_image = url('/').'/uploads/front/patient/profile-image/default-image.jpeg';
        }

        $data['dr_profile_image'] = $dr_profile_image;
        $data['pat_profile'] = $this->arr_view_data['patient_public_img_path'].$this->arr_view_data['patient_pic'];
        $data['patient_fullname'] = $patient_data->first_name.' '.$patient_data->last_name;
        $data['patient_name'] = $patient_data->first_name.''.$patient_data->last_name.''.$patient_data->id;
        $data['doctor_name'] = $this->arr_view_data['doctor_name'];
        $data['enc_patient_id'] = base64_encode($this->arr_view_data['patient_id']);
        $data['user_timezone'] = $this->arr_view_data['timezone_location'];
        $data['dump_id'] = $dump_id;
        $data['dump_session'] = $dump_session;
        $data['msg'] = $this->arr_view_data['arr_all_msg'];
        $data['pat_is_online'] = $patient_data->pat_is_online;

        return response()->json($data);

    } // end create_channel



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 23/08/2017
    | Output    : 
    */

    public function send_message(Request $request)
    {
       
        $patient_id  = $msg_html = $profile_img = '';
        $channel_id  = [];

        $patient_id  = $request->input('patient_id');
        $profile_img = $request->input('profile_img');

        if(isset($patient_id) && $patient_id != '')
        {
            $obj_chat = $this->ChatModel->where('doctor_id', $this->user_id)
                                        ->where('patient_id', base64_decode($patient_id))
                                        ->first();
            if($obj_chat)
            {
                $channel_id = $obj_chat->channel_id;
            }
        }

        $form_data  = $request->all();

        $date       = date('d M,Y');
        $time       = date('h:i a');
        $datetime   = date('D, F d, Y, h:i a');
        $message    = isset($form_data['message'])?$form_data['message']:'';
       

        if(isset($message) && $message!="")
        { 
            
            $message = $this->client->ipMessaging
                            ->services($this->service_id)
                            ->channels($channel_id)
                            ->messages
                            ->create(
                                $message,
                                array(
                                "attributes"    => '[{"time":"'.$datetime.'"}]',
                                "from"          => $this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                "identity"      => $this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                "lastUpdatedBy" => $datetime,
                            ));
  
            $arr_json['datetime']   = date('D, F d, Y, h:i a',strtotime(convert_utc_to_userdatetime($this->user_id, 'doctor',$datetime)));
            $arr_json['id']         = $message->sid;
            $arr_json['message']    = $form_data['message'];

            if($message)
            {
                $data['status']     = 'success';
                $data['arr_msg']    = $arr_json;
                $data['profile_img'] = $profile_img;
            }
            else
            {
                $data['status']     = 'error';
            }

        }
        else
        {
            $data['status']     = 'error';
        }
        return response()->json($data);

    } // end send_message

    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 11/09/2017
    | Output    : Success or Error
    */

    public function get_all_message($user_id)
    {
        $channel_id = '';
        $arr_msg    = $arr_message = [];
        $arr_date   = [];

        if(isset($user_id) && $user_id!='')
        {
           $obj_chat = $this->ChatModel->where('doctor_id','=',$this->user_id)
                                       ->where('patient_id','=',$user_id)
                                       ->first();

            if($obj_chat)
            {
                $channel_id = $obj_chat->channel_id;
            }
        }

        if($channel_id != "")
        {
            $messages  = $this->client->ipMessaging
                              ->services($this->service_id)
                              ->channels($channel_id)
                              ->messages
                              ->read();
              
            foreach ($messages as $key=>$message) {

                $arr_date = json_decode(json_encode($message->dateCreated),true);
                $arr_msg[$key]['datetime']   = date('D, F d, Y, h:i a',strtotime(convert_utc_to_userdatetime($this->user_id, 'doctor',$arr_date['date'])));
                $arr_message                 = explode('|',$message->body);
                $arr_msg[$key]['msg']        = isset($arr_message[0])?$arr_message[0]:'';
                $arr_msg[$key]['from']       = $message->from;
                $arr_msg[$key]['to']         = $message->to;
                $arr_msg[$key]['attributes'] = $message->attributes;
                $arr_msg[$key]['lastUpdatedBy'] = $message->lastUpdatedBy;
            }
              
        }

        return $arr_msg;
    } // end get_all_message


    /*
        Rohini jagtap
        date : 19 Apr 2017
        desc : get all messages of user.
    */
    public function get_send_message($user_id)
    {
        $channel_id = '';
        $arr_msg   = $arr_message = [];
        $arr_date  = [];

        if(isset($user_id) && $user_id!='')
        {
           $obj_chat = $this->ChatModel->where('doctor_id','=',$this->user_id)
                                       ->where('patient_id','=',$user_id)
                                       ->first();

            if($obj_chat)
            {
                $channel_id = $obj_chat->channel_id;
            }
        }

        if($channel_id != "")
        {
            $messages  = $this->client->ipMessaging
                              ->services($this->service_id)
                              ->channels($channel_id)
                              ->messages
                              ->read();
              
            foreach ($messages as $key=>$message) {

                $arr_date = json_decode(json_encode($message->dateCreated),true);
                $arr_msg[$key]['datetime']  = date('D, F d, Y, h:i a',strtotime(convert_utc_to_userdatetime($this->user_id, 'doctor',$arr_date['date'])));
                $arr_message                = explode('|',$message->body);
                $arr_msg[$key]['msg']       = isset($arr_message[0])?$arr_message[0]:'';
                $arr_msg[$key]['from']      = $message->from;
                $arr_msg[$key]['to']        = $message->to;
                $arr_msg[$key]['attributes'] = $message->attributes;
            }
              
        }

        return $arr_msg;
    }
    /*
        Rohini jagtap
        date : 19 Apr 2017
        desc : get list of patient.
    */
    public function get_patient_list()
    {
        $arr_doctor       = [];
        $obj_doctor_list  =  $this->PatientConsultationBookingModel->where('doctor_user_id','=',$this->user_id)
                                               ->with(['patient_user_details'=>function($q){
                                                    $q->select('id','first_name','last_name','profile_image','title','is_online');
                                               }])
                                              ->groupBy('patient_user_id')
                                              ->select('id','patient_user_id')
                                              ->get();

        if($obj_doctor_list)
        {
            $arr_doctor  = $obj_doctor_list->toArray();
        }
        return $arr_doctor;

    }

    public function get_user_info($user_id)
    {
        $user = Sentinel::findById($user_id);
        return $user;
    }
   
    public function get_incoming_message($user_id)
    {
            $arr_msg = $arr_first_msg = [];
            $channel_id = '';
            if(isset($user_id) && $user_id!='')
            {
               $obj_chat = $this->ChatModel->where('doctor_id','=',$this->user_id)
                                           ->where('patient_id','=',$user_id)
                                           ->first();
                if($obj_chat)
                {
                    $channel_id = $obj_chat->channel_id;
                }
            }

            if($channel_id!="")
            {
                $messages  = $this->client->ipMessaging
                                  ->services($this->service_id)
                                  ->channels($channel_id)
                                  ->messages
                                  ->read();

                foreach ($messages as $key=>$message) {
                       
                    $arr_date = json_decode(json_encode($message->dateCreated),true);
                    $arr_msg[$key]['datetime'] = $arr_date['date'];
                    $arr_msg[$key]['msg']      = $message->body;
                    $arr_msg[$key]['from']     = $message->from;
                    $arr_msg[$key]['to']       = $message->to;
                }
            }
            return $arr_msg;
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 12/09/2017
    | Output    : Success or Error
    */

    public function get_messages(Request $request)
    {

            $channel_id  = $msg_html = '';
            $arr_msg     = $arr_message = $arr_date = [];

            $patient_id   = $request->input('patient_id');
            $profile_img  = $request->input('profile_img');

            $patient_data  = $this->get_user_info(base64_decode($patient_id));

            $patient_pic   = $patient_data->profile_image;
            $patient_name  = $patient_data->first_name.''.$patient_data->last_name.''.$patient_data->id;
            $doctor_name   = $this->user->first_name.''.$this->user->last_name.''.$this->user_id;

            if(isset($patient_id) && $patient_id!='')
            {
               $obj_chat = $this->ChatModel->where('doctor_id','=',$this->user_id)
                                           ->where('patient_id','=',base64_decode($patient_id))
                                           ->first();
                if($obj_chat)
                {
                    $channel_id = $obj_chat->channel_id;
                }
            }

            if($channel_id!="")
            {
                $messages  = $this->client->ipMessaging
                                  ->services($this->service_id)
                                  ->channels($channel_id)
                                  ->messages
                                  ->read();

                foreach ($messages as $key => $message) {
                
                    $arr_date                    = json_decode(json_encode($message->dateCreated),true);
                    $arr_msg[$key]['datetime']   = date('D, F d, Y, h:i a',strtotime(convert_utc_to_userdatetime($this->user_id, 'doctor',$arr_date['date'])));
                    $arr_message                 = explode('|',$message->body);
                    $arr_msg[$key]['msg']        = isset($arr_message[0])?$arr_message[0]:'';
                    $arr_msg[$key]['from']       = $message->from;
                    $arr_msg[$key]['to']         = $message->to;
                    $arr_msg[$key]['attributes'] = $message->attributes;
                    $msg_time                    = $message->lastUpdatedBy;                    

                    $msg_datetime = date('D, F d, Y, h:i a',strtotime($msg_time));

                    $arr_msg[$key]['lastUpdatedBy'] = $msg_datetime;
                }

                $data = array('status' => 'success', 'messages' => $arr_msg, 'doc_profile_img' => $profile_img, 'pat_profile_path' => $this->profile_img_public_path, 'patient_pic' => $patient_pic, 'patient_name' => $patient_name, 'doctor_name' => $doctor_name, 'pat_is_online' => $patient_data->pat_is_online);
            }
            else
            {
                $status   = 'error';
            }
            return response()->json($data);
            
    } // end get_messages


    /*
    | Function  : 
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
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 09/09/2017
    | Output    : Success or Error
    */

    public function delete_user($username)
    {
        // Create the user
        $user = $this->client->chat
                     ->services($this->service_id)
                     ->users($username)
                     ->delete();

        /*echo $user;*/
        if($user == 1)
        {
            return true;
        }
        else
        {
            return false;
        }

    } // end delete_user


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 09/09/2017
    | Output    : Success or Error
    */

    public function add_member($channelid, $username)
    {
        // Create the user
        $member = $this->client->chat
                        ->services($this->service_id)
                        ->channels($channelid)
                        ->members
                        ->create($username);

        return $member->identity;
        
    } // end add_member


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 26/03/2018
    | Output    : Success or Error
    */    

    public function virgil(Request $request)
    {
        $exportedCard   = $request->input('exportedCard');
        $exportedKey    = $request->input('exportedKey');
        $channel_id     = $request->input('channel_id');

        $virgilApi = $this->VirgilService->serverToken();

        // import a Virgil Card from string
        $importedCard  = $virgilApi->Cards->import($exportedCard);
        $publishedCard = $virgilApi->Cards->publish($importedCard);


        $cardId = $importedCard->getCard()->getId();

        $chat_data['dump_id']        = $cardId;
        $chat_data['dump_session']   = $exportedKey;

        $obj_chat = $this->ChatModel->where('channel_id', $channel_id)->update($chat_data);

        if($obj_chat)
        {
            $status         = 'success';
            $dump_id        = $cardId;
            $dump_session   = $exportedKey;
        }
        else
        {
            $status         = 'error';
            $dump_id        = '';
            $dump_session   = '';
        }

        $data = array('status' => $status, 'dump_id' => $dump_id, 'dump_session' => $dump_session);
        return response()->json($data);

        
    } // end virgil


    /*
        Rohini jagtap
        date : 19 Apr 2017
        desc : create channel for each user.
    */
    public function create_channel1($enc_id)
    {    
        $this->arr_view_data['profile_img_base_path']   = $this->profile_img_base_path;
        $this->arr_view_data['profile_img_public_path'] = $this->profile_img_public_path;

        $channel_id = $user_id  = '';
        $arr_chat   = $arr_sent_msg = $arr_patient_list = $arr_incoming_msg = []; 

        if(isset($enc_id) && $enc_id!='')
        {
            $user_id    = base64_decode($enc_id);
        }
        $user           = $this->get_user_info($user_id);

        if(isset($user) && !empty($user))
        {
            $patient_data = $user->toArray();
        }

        Session::put('user_id',$user_id);
     
        $is_exist_channel  = $this->ChatModel->where('patient_id','=',$user_id)
                                             ->where('doctor_id','=',$this->user_id)
                                             ->count();

        if($is_exist_channel==0)
        {
            $channel    =  $this->client->ipMessaging
                            ->services($this->service_id)
                            ->channels
                            ->create(
                                array(
                                    'friendlyName' => $user->first_name,                                 
                                )
                            );

            $channel_id               = $channel->sid;
            $arr_chat['from_user_id'] = $this->user_id;
            $arr_chat['to_user_id']   = $user_id;
            $arr_chat['channel_id']   = $channel_id;
            $obj_chat = $this->ChatModel->create($arr_chat);
 
        }
        //$arr_patient_list    =  $this->get_patient_list();
        $arr_sent_msg        =  $this->get_sent_message();
        $arr_incoming_msg    =  $this->get_incoming_message($user_id);

        //dd($arr_sent_msg);

        $this->arr_view_data['patient_data']            = $patient_data;
        $this->arr_view_data['arr_incoming_msg']        = $arr_incoming_msg;
        $this->arr_view_data['enc_patient_id']          = $enc_id;
        $this->arr_view_data['arr_sent_msg']            = $arr_sent_msg;
        $this->arr_view_data['friendly_Name']           = $user->first_name;  
        //$this->arr_view_data['arr_patient_list']        = $arr_patient_list;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
       
    }
    /*
        Rohini jagtap
        date : 19 Apr 2017
        desc : send message to the user using channel id.
    */
    public function send_message1(Request $request)
    {
        $date       = $time     = $channel_id = '';
        $form_data  = $arr_json = $arr_date = [];
        $flag       = 1;
        $user_id = Session::get('user_id');
       
            if(isset($user_id) && $user_id!='')
            {
                $obj_chat = $this->ChatModel->where('patient_id','=',$user_id)->first();
                if($obj_chat)
                {
                    $channel_id = $obj_chat->channel_id;
                }
            }

        $form_data  = $request->all();
        $date       = date('d M,Y');
        $time       = date('h:i a');
        $message    = isset($form_data['message'])?$form_data['message']:'';
        if($message!="")
        {
            $message = $this->client->ipMessaging
                            ->services($this->service_id)
                            ->channels($channel_id)
                            ->messages
                            ->create($message);

            $arr_json['datetime']   = $date.' '.$time;
            $arr_json['id']         = $message->sid;
            $arr_json['message']    = $message->body;
            if($message)
            {
                $arr_json['status']     = 'success';    
            }
            else
            {
                $arr_json['status']     = 'error';       
            }
        }
        else
        {
            $arr_json['status']     = 'error';
        }
        return response()->json($arr_json);     
    }
    /*
        Rohini jagtap
        date : 19 Apr 2017
        desc : get all messages of user.
    */
    public function get_sent_message1()
    {
            $channel_id = '';
            $arr_msg   = [];
            $arr_date  = [];

            $user_id = Session::get('user_id');
            /*
                get channel info by user id
            */
            if(isset($user_id) && $user_id!='')
            {
                $obj_chat = $this->ChatModel->where('patient_id','=',$user_id)
                                            ->where('doctor_id','=',$this->user_id)
                                            ->first();
                if($obj_chat)
                {
                    $channel_id = $obj_chat->channel_id;
                }
            }
 
            if($channel_id!="")
            {
                $messages  = $this->client->ipMessaging
                                  ->services($this->service_id)
                                  ->channels($channel_id)
                                  ->messages
                                  ->read();

                foreach ($messages as $key=>$message) {
                        
                    $arr_date = json_decode(json_encode($message->dateCreated),true);
                    $arr_msg[$key]['datetime'] = $arr_date['date'];
                    $arr_msg[$key]['msg']      = $message->body;
                }
            }
            return $arr_msg;
    }
    /*
        Rohini jagtap
        date : 19 Apr 2017
        desc : get list of patient.
    */
    public function get_patient_list1()
    {
        $arr_patient      = [];
        $obj_patient_list =  $this->PatientConsultationBookingModel->where('doctor_user_id','=',$this->user_id)
                                               ->with(['patient_user_details'=>function($q){
                                                    $q->select('id','first_name','last_name','profile_image');
                                               }])
                                              ->groupBy('patient_user_id')
                                              ->select('id','patient_user_id')
                                              ->get();

        if($obj_patient_list)
        {
            $arr_patient  = $obj_patient_list->toArray();
        }
        return $arr_patient;

    }
    public function get_user_info1($user_id)
    {
        $user = Sentinel::findById($user_id);
        return $user;
    }
    public function get_incoming_message1($user_id)
    {
            $channel_id = '';
            $arr_msg = [];
            if(isset($user_id) && $user_id!='')
            {
                $obj_chat = $this->ChatModel->where('patient_id','=',$user_id)
                                            ->where('doctor_id','=',$this->user_id)
                                            ->first();
                if($obj_chat)
                {
                    $channel_id = $obj_chat->channel_id;
                }
            }

            if($channel_id!="")
            {
                $messages  = $this->client->ipMessaging
                                  ->services($this->service_id)
                                  ->channels($channel_id)
                                  ->messages
                                  ->read();

                foreach ($messages as $key=>$message) {
                        
                    $arr_date = json_decode(json_encode($message->dateCreated),true);
                    $arr_msg[$key]['datetime'] = $arr_date['date'];
                    $arr_msg[$key]['msg']      = $message->body;
                }
            }
            return $arr_msg;
    }
}
?>