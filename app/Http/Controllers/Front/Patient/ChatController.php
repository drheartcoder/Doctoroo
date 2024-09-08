<?php
namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ChatModel;
use App\Models\UserModel;
use App\Models\PatientConsultationBookingModel;

use Twilio\Rest\Client;
use App\Common\Services\VirgilService;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Validator;
use Session;

class ChatController extends Controller
{
    public function __construct(PatientConsultationBookingModel     $booking_model,
                                ChatModel                           $chat_model,
                                UserModel                           $user_model,
                                VirgilService                       $VirgilService)
    {
        $this->arr_view_data                    = [];
        $this->ChatModel                        = $chat_model;
        $this->UserModel                        = $user_model;
        $this->PatientConsultationBookingModel  = $booking_model;
        $this->VirgilService                    = $VirgilService;

        $this->module_url_path                  = url('/').'/patient/chat';
        $this->module_view_folder               = 'front.patient.chat';

        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
            $this->user    = $user;
        }

        $this->doctor_base_img_path             = public_path().config('app.project.img_path.doctor_image');
        $this->doctor_public_img_path           = url('/public').config('app.project.img_path.doctor_image');

        $this->arr_view_data['doctor_base_img_path']     = $this->doctor_base_img_path;
        $this->arr_view_data['doctor_public_img_path']   = $this->doctor_public_img_path;
        $this->arr_view_data['module_url_path']          = $this->module_url_path;
        $this->arr_view_data['page_title']               = "My Message";

        $this->sid        = config('services.twilio')['accountSid'];
        $this->token      = config('services.twilio')['auth_token'];
        $this->service_id = config('services.twilio')['service_id'];
        $this->client     = new Client($this->sid,$this->token);
    }
    

    /*
    | Function  : Get all the doctor list
    | Author    : Deepak Arvind Salunke
    | Date      : 22/08/2017
    | Output    : show the list of doctors
    */

    public function index()
    {
        $this->arr_view_data['doctors_list']        = $this->get_doctor_list();

        $this->arr_view_data['page_title']          = $this->arr_view_data['page_title'];
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    } // end index

    
    /*
    | Function  : Create channel and get all the send and incoming msgs
    | Author    : Deepak Arvind Salunke
    | Date      : 23/08/2017
    | Output    : Display all the send and incoming msgs
    */

    public function create_channel($enc_id)
    {
        $doctor_id = '';
        $is_exist_channel = $doctor_data = $channel = $arr_chat = [];

        /*$channel = $this->client->ipMessaging
                                    ->services($this->service_id)
                                    ->channels("CH4ede93e8a3b743898c753efcec724604")
                                    ->delete();
                                    die;*/

        $doctor_id = base64_decode($enc_id);

        $is_exist_channel = $this->ChatModel->where('doctor_id', $doctor_id)
                                            ->where('patient_id', $this->user_id)
                                            ->first();

        $doctor_data  =  $this->get_user_info($doctor_id);

        /*$delete_patient_user = $this->delete_user($this->user->first_name.''.$this->user->last_name);
        $delete_doctor_user = $this->delete_user($doctor_data->first_name.''.$doctor_data->last_name);
        die;*/

        if(count($is_exist_channel) == 0)
        {
            $channel = $this->client->ipMessaging
                                    ->services($this->service_id)
                                    ->channels
                                    ->create(
                                        array(
                                            'friendlyName' => $doctor_data->first_name.''.$doctor_data->last_name.''.$doctor_data->id.'-'.$this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                            //'uniqueName' => $doctor_data->first_name.''.$doctor_data->last_name.''.$doctor_data->id.'-'.$this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                            'type' => 'private',
                                            'createdBy' => $this->user->first_name.''.$this->user->last_name.''.$this->user_id,
                                        )
                                    );

            //$create_patient_user = $this->create_user($this->user->first_name.''.$this->user->last_name.''.$this->user_id);
            //$create_doctor_user  = $this->create_user($doctor_data->first_name.''.$doctor_data->last_name.''.$doctor_data->id);

            $arr_chat['doctor_id']      = $doctor_id;
            $arr_chat['patient_id']     = $this->user_id;
            $arr_chat['channel_id']     = $channel->sid;
            //$arr_chat['patient_name']   = $create_patient_user;
            //$arr_chat['doctor_name']    = $create_doctor_user;
            $arr_chat['patient_name']   = $this->user->first_name.''.$this->user->last_name.''.$this->user_id;
            $arr_chat['doctor_name']    = $doctor_data->first_name.''.$doctor_data->last_name.''.$doctor_data->id;

            $obj_chat = $this->ChatModel->create($arr_chat);

            $add_patient_member = $this->add_member($obj_chat->channel_id, $this->user->first_name.''.$this->user->last_name.''.$this->user_id);
            $add_doctor_member  = $this->add_member($obj_chat->channel_id, $doctor_data->first_name.''.$doctor_data->last_name.''.$doctor_data->id);

            $channel_id     = $obj_chat->channel_id;
            $dump_session   = '';
            $dump_id        = '';
        }
        else if(count($is_exist_channel) > 0)
        {
            $this->arr_view_data['doctor_data']         = $doctor_data;
            $this->arr_view_data['arr_all_msg']         = $this->get_all_message($doctor_id);

            $chat_data                                  = $is_exist_channel->toArray();
            $channel_id                                 = $chat_data['channel_id'];
            $dump_session                               = $chat_data['dump_session'];
            $dump_id                                    = $chat_data['dump_id'];
        }
        //dd($this->arr_view_data['arr_all_msg']);

        // get user timezone
        $get_user_data = $this->UserModel->where('id',$this->user_id)->with('patientinfo', 'patientinfo.timezone_data')->first();
        if($get_user_data)
        {
            $user_data = $get_user_data->toArray();
            $user_timezone_id = $user_data['patientinfo']['timezone'];
            $this->arr_view_data['timezone_location'] = $user_data['patientinfo']['timezone_data']['location'];
        }

        $this->arr_view_data['patient_id']              = $this->user_id;
        $this->arr_view_data['doctor_id']               = $doctor_id;
        $this->arr_view_data['doctor_pic']              = $doctor_data->profile_image;
        $this->arr_view_data['doctor_name']             = $doctor_data->first_name.''.$doctor_data->last_name.''.$doctor_data->id;
        $this->arr_view_data['patient_name']            = $this->user->first_name.''.$this->user->last_name.''.$this->user_id;

        $this->arr_view_data['doctor_name_text']        = $doctor_data->first_name.' '.$doctor_data->last_name;
        $this->arr_view_data['patient_name_text']       = $this->user->first_name.' '.$this->user->last_name;

        $this->arr_view_data['doctor_is_online']        = $doctor_data->is_online;
        $this->arr_view_data['channel_id']              = $channel_id;
        $this->arr_view_data['dump_id']                 = $dump_id;
        $this->arr_view_data['dump_session']            = $dump_session;

        $this->arr_view_data['page_title']              = "Chat Messages";
        $this->arr_view_data['module_url_path']         = $this->module_url_path;

        return view($this->module_view_folder.'.messages',$this->arr_view_data);
    } // end create_channel


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 23/08/2017
    | Output    : 
    */

    public function send_message(Request $request)
    {
        $doctor_id = $msg_html = $profile_img = '';
        $channel_id = [];

        $doctor_id   = $request->input('doctor_id');
        $profile_img = $request->input('profile_img');



        if($request->input('channel_id')=='undefined'){

                if(isset($doctor_id) && $doctor_id != '')
                {
                    $obj_chat = $this->ChatModel->where('doctor_id', $doctor_id)
                                                ->where('patient_id', $this->user_id)
                                                ->first();
                    if($obj_chat)
                    {
                        $channel_id = $obj_chat->channel_id;
                        \Session::put('channel_id' , $channel_id);
                    }
                }    
        }
        else{
            $channel_id = $request->input('channel_id');
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
        }
        else
        {
            //$arr_json['status']     = 'error';
            $msg_html .= '<li class="chatt-message right-avtr appeared">';
            $msg_html .= '<div class="text_wrapper first">';
            $msg_html .= '<div class="text">Something went wrong. Please try again!!! </div>';
            $msg_html .= '</div>';
            $msg_html .= '</li>';
        }
        echo $msg_html;
    } // end send_message

    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : /09/2017
    | Output    : Success or Error
    */

    public function get_all_message($user_id)
    {
            $channel_id = '';
            $arr_msg   = $arr_message = [];
            $arr_date  = [];

            if(isset($user_id) && $user_id!='')
            {
               $obj_chat = $this->ChatModel->where('doctor_id','=',$user_id)
                                           ->where('patient_id','=',$this->user_id)
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
                    $arr_msg[$key]['datetime']  = date('D, F d, Y, h:i a',strtotime(convert_utc_to_userdatetime($this->user_id, 'patient',$arr_date['date'])));
                    $arr_message                = explode('|',$message->body);
                    $arr_msg[$key]['msg']       = isset($arr_message[0])?$arr_message[0]:'';
                    $arr_msg[$key]['from']      = $message->from;
                    $arr_msg[$key]['to']        = $message->to;
                    $arr_msg[$key]['attributes'] = $message->attributes;
                    $arr_msg[$key]['lastUpdatedBy'] = $message->lastUpdatedBy;
                }
                  
            }
            //dd($arr_msg);
            return $arr_msg;
    } // end get_all_message



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/03/2018
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
        desc : get all messages of user.
    */
    public function get_send_message($user_id)
    {
            $channel_id = '';
            $arr_msg   = $arr_message = [];
            $arr_date  = [];

            if(isset($user_id) && $user_id!='')
            {
               $obj_chat = $this->ChatModel->where('doctor_id','=',$user_id)
                                           ->where('patient_id','=',$this->user_id)
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
                    $arr_msg[$key]['datetime']  = date('D, F d, Y, h:i a',strtotime(convert_utc_to_userdatetime($this->user_id, 'patient',$arr_date['date'])));
                    $arr_message                = explode('|',$message->body);
                    $arr_msg[$key]['msg']       = isset($arr_message[0])?$arr_message[0]:'';
                    $arr_msg[$key]['from']      = $message->from;
                    $arr_msg[$key]['to']        = $message->to;
                    $arr_msg[$key]['attributes'] = $message->attributes;
                    $arr_msg[$key]['lastUpdatedBy'] = $message->lastUpdatedBy;
                }
                  
            }

            return $arr_msg;
    }
    /*
        Rohini jagtap
        date : 19 Apr 2017
        desc : get list of patient.
    */
    public function get_doctor_list()
    {
        $arr_doctor       = [];
        $obj_doctor_list  =  $this->PatientConsultationBookingModel->where('patient_user_id','=',$this->user_id)
                                                                   ->with(['doctor_user_details'=>function($q){
                                                                        $q->select('id','first_name','last_name','profile_image','title','is_online');
                                                                    }])
                                                                   ->groupBy('doctor_user_id')
                                                                   ->select('id','doctor_user_id')
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
               $obj_chat = $this->ChatModel->where('doctor_id','=',$user_id)
                                           ->where('patient_id','=',$this->user_id)
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

            $doctor_id   = $request->input('doctor_id');
            $profile_img = $request->input('profile_img');

            $doctor_data  = $this->get_user_info($doctor_id);
            $doctor_pic   = $doctor_data->profile_image;
            $doctor_name  = $doctor_data->first_name.''.$doctor_data->last_name.''.$doctor_data->id;
            $patient_name = $this->user->first_name.''.$this->user->last_name.''.$this->user_id;

            if(isset($doctor_id) && $doctor_id!='')
            {
                if($request->input('channel_id')=='undefined'){
                    $obj_chat = $this->ChatModel->where('doctor_id' ,'=',$doctor_id)
                                           ->where('patient_id','=',$this->user_id)
                                           ->first();

                    if($obj_chat)
                    {
                       $channel_id = $obj_chat->channel_id;
                    }
                }
                else{
                    $channel_id = $request->input('channel_id');
                }
            }

            if($channel_id!="")
            {
                $messages  = $this->client->ipMessaging
                                  ->services($this->service_id)
                                  ->channels($channel_id)
                                  ->messages
                                  ->read();
                
                $msg_count = 0;
                foreach ($messages as $key=>$message) {

                    $arr_date                    = json_decode(json_encode($message->dateCreated),true);
                    $arr_msg[$key]['datetime']   = date('D, F d, Y, h:i a',strtotime(convert_utc_to_userdatetime($this->user_id, 'patient',$arr_date['date'])));
                    $arr_message                 = explode('|',$message->body);
                    $arr_msg[$key]['msg']        = isset($arr_message[0])?$arr_message[0]:'';
                    $arr_msg[$key]['from']       = $message->from;
                    $arr_msg[$key]['to']         = $message->to;
                    $arr_msg[$key]['attributes'] = $message->attributes;
                    $msg_time                    = $message->lastUpdatedBy;                    

                    $msg_datetime = date('D, F d, Y, h:i a',strtotime($msg_time));

                    $arr_msg[$key]['lastUpdatedBy'] = $msg_datetime;


                    /*if($message->from == $patient_name)
                    {
                        $msg_html .= '<li class="chatt-message right-avtr appeared">';
                        $msg_html .= '<div class="avatar"><img src="'.$profile_img.'" alt="" height="50px" width="50px"/></div>';
                        
                        $msg_html .= '<div class="text_wrapper first">';
                        $msg_html .= '<div class="text">'.$arr_msg[$key]['msg'].'</div>';
                        $msg_html .= '<div class="time-snt-left right-align">'.date("D, F d, Y, h:i a", strtotime($arr_date['date'])).'</div>';
                        $msg_html .= '</div>';
                        $msg_html .= '</li>';
                    }
                    else if($message->from == $doctor_name)
                    {
                        $msg_html .= '<li class="chatt-message left-avtr appeared">';
                        $msg_html .= '<div class="avatar"><img src="'.$this->doctor_public_img_path.$doctor_pic.'" alt="" height="50px" width="50px"/></div>';
                        
                        $msg_html .= '<div class="text_wrapper first">';
                        $msg_html .= '<div class="text">'.$arr_msg[$key]['msg'].'</div>';
                        $msg_html .= '<div class="time-snt-right left-align">'.date("D, F d, Y, h:i a", strtotime($arr_date['date'])).'</div>';
                        $msg_html .= '</div>';
                        $msg_html .= '</li>';
                    }

                    $msg_count++;*/
                }

                $data['messages'] = $arr_msg;
                $data['patient_img'] = $profile_img;
                $data['doctor_img'] = $this->doctor_public_img_path.$doctor_pic;
                $data['patient_name'] = $patient_name;
                $data['doctor_name'] = $doctor_name;
                $data['doctor_is_online'] = $doctor_data->is_online;

                
                //$msg_html .= '<input type="hidden" name="msg_count" id="msg_count" value="'.$msg_count.'" /><input type="hidden" name="channel_id" id="channel_id" value="'.$channel_id.'" />';

            }
            //echo $msg_html;

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
    | Date      : 19/09/2017
    | Output    : Success or Error
    */    

    public function patient_chat(Request $request)
    {
        dd($request->all());
    } // end patient
}
?>