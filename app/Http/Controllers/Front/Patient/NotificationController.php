<?php
namespace App\Http\Controllers\Front\Patient;
use App\Models\NotificationModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
Use Validator;

class NotificationController extends Controller
{
    public function __construct(NotificationModel        $NotificationModel)
    {

        $this->arr_view_data                      = [];
        $this->NotificationModel                  = $NotificationModel;
      	$this->module_view_folder                 = 'front.patient.messages_and_notification';
        $this->module_url_path                    = url('/').'/patient/messages_and_notification';
        $this->module_title                       = "Notification";
    
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : 
    */

    public function messages_list()
    {

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.messages_list',$this->arr_view_data);
    } // end messages_list


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : 
    */

    public function notification()
    {
      $notification_arr = $this->NotificationModel->where('to_user_id',$this->user_id)
                                                   ->with('user_details','booking_details')
                                                   ->orderBy('id' , 'DESC')
                                                   ->paginate(10);
      if($notification_arr)
      {
       $this->arr_view_data['paginate']                   = clone $notification_arr;
       $this->arr_view_data['notification_arr']           = $notification_arr->toArray();
       $this->NotificationModel->where('to_user_id',$this->user_id)
                                            ->update(['status'=>'read']);

      }

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.notification',$this->arr_view_data);
    } // end notification
    


    /*
      Rohini jagtap
      18 Apr 2017
    */
    public function show_notification()
    {
        $arr_notification = [];
        $obj_notification = $this->NotificationModel->where('to_user_id',$this->user_id)
                                                    ->where('reminder_status','=',0)
                                                    ->with(['user_details'=>function($q){
                                                            $q->select('id','title','first_name','last_name');
                                                      }])
                                                    ->orderBy('id','desc')
                                                    ->get();
        if($obj_notification)
        {
            $arr_notification = $obj_notification->toArray();
        }
        $this->arr_view_data['page_title']         = "Notifications";
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['arr_notification']   = $arr_notification;
        return view($this->module_view_folder.'.notification',$this->arr_view_data);
    }
    public function show_notification_details($enc_id)
    {
            $arr_notification     = []; 
            $notification_id      = '';
            if(isset($enc_id) && $enc_id!=false)
            {
                $notification_id  = base64_decode($enc_id);
                $obj_data = $this->NotificationModel->where('id','=',$notification_id);
                     
                 /* get notification info */                                       
                $obj_notification  = $obj_data->with(['user_details'=>function($q){
                                                                $q->select('id','title','first_name','last_name');
                                                              },'booking_details'=>function($q1){
                                                                 $q1->select('id','reschedule_date_time');
                                                              }])
                                                            ->first();
                if($obj_notification)
                {
                  $arr_notification = $obj_notification->toArray();

                }
                /*if($obj_data)
                {
                   $notify_status = $obj_data->update(['reminder_status'=>1]);
                }*/
                $this->arr_view_data['arr_notification']   = $arr_notification;
                $this->arr_view_data['module_url_path']    = $this->module_url_path;
            }
            return view($this->module_view_folder.'.details',$this->arr_view_data);
    }
}
?>