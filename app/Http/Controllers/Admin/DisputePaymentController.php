<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\DisputeModel;
use App\Models\DisputeResponseModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\NotificationModel;

use Validator;
use Flash;
use Sentinel;
use Session;
use Activation;
use Response;
use DB;
use Stripe;


/*-------------------------------Ankit Aher(20th feb 2017)---------------------------*/
class DisputePaymentController extends Controller
{

    public function __construct(UserModel  $user,DisputeModel $dispute_model,DisputeResponseModel $response_model, NotificationModel                 $NotificationModel, PatientConsultationBookingModel $PatientConsultationBookingModel)
    {
       
        $this->UserModel               = $user;
        $this->DisputeModel            = $dispute_model;
        $this->DisputeResponseModel    = $response_model;
        $this->PatientConsultationBookingModel = $PatientConsultationBookingModel;
        $this->NotificationModel       = $NotificationModel;

        $this->arr_view_data           = [];
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/dispute");
        $this->module_title            = "Dispute Payment";
        $this->module_view_folder      = "admin.disputes";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
        $this->base_path               = base_path().'/public';
        $this->site_url                = url('/');

         $user = Sentinel::check();
        if($user)
        {
          $this->user_id = $user->id;
        }
        else
        {
          $this->user_id = null;
        }

    }

    /*================Updated by Seema(27-Feb-2017)========================================*/

     public function index()
    {

        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $this->arr_view_data['arr_dispute'] =  array();

        $user = Sentinel::check();

        if($user)
        {

            if($user->inRole('admin'))
            {
                    
                $obj_dispute = $this->DisputeModel->with('added_by_user_info','against_user_info')
                                                  ->orderBy('id','DESC')
                                                  ->get();

                if($obj_dispute!=FALSE)
                {

                    $arr_dispute = $obj_dispute->toArray();
                }

                $this->arr_view_data['arr_dispute']     = $arr_dispute;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = 'Manage Dispute Payment';
                return view($this->module_view_folder.'/index',$this->arr_view_data);
            }
            else
            {

                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
        }
        else
        {
            
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    public function view($enc_id=FALSE)
    {        
        $dispute_id = 0; $arr_dispute_response       =  array();
        $arr_dispute = array();
        $id = "";
        $this->arr_view_data['page_title']           =  str_singular($this->module_title);
        $this->arr_view_data['arr_dispute_response'] =  array();
        $this->arr_view_data['arr_dispute']          =  array();

        if($enc_id!="")
        {
                $id = base64_decode($enc_id);

                $obj_dispute = $this->DisputeModel->with('added_by_user_info', 'against_user_info')
                                                  ->where('id',$id)
                                                  ->first();
                if($obj_dispute!=FALSE)
                {

                    $arr_dispute = $obj_dispute->toArray();
                }

                $obj_dispute_response = $this->DisputeResponseModel->with('userinfo')
                                                  ->where('dispute_id',$id)
                                                  ->get();



                if($obj_dispute_response!=FALSE)
                {
                    $arr_dispute_response = $obj_dispute_response->toArray();
                }

                if(isset($arr_dispute['added_by_user_id']) && !empty($arr_dispute['added_by_user_id']))
                {
                    
                    $added_by_user = DB::table('users')
                                    ->join('role_users','role_users.user_id','=','users.id')
                                    ->join('roles','roles.id','=','role_users.role_id')
                                    ->where('users.id' , $arr_dispute['added_by_user_id'])
                                    ->select('users.id','users.title','users.first_name','users.last_name','roles.name')
                                    ->first();

                    $add_by_user_arr['id']  = isset($added_by_user->id) ? $added_by_user->id : '';   
                    $add_by_user_arr['title'] = isset($added_by_user->title) ? $added_by_user->title : '';   
                    $add_by_user_arr['first_name'] = isset($added_by_user->first_name) ? $added_by_user->first_name : '';   
                    $add_by_user_arr['last_name'] = isset($added_by_user->last_name) ? $added_by_user->last_name : '';   
                    $add_by_user_arr['name'] = isset($added_by_user->name) ? $added_by_user->name : '';   
                    
                    $this->arr_view_data['add_by_user_arr'] = $add_by_user_arr;
                }

                if(isset($arr_dispute['against_user_id']) && !empty($arr_dispute['against_user_id']))
                {
                    
                    $against_user = DB::table('users')
                                    ->join('role_users','role_users.user_id','=','users.id')
                                    ->join('roles','roles.id','=','role_users.role_id')
                                    ->where('users.id' , $arr_dispute['against_user_id'])
                                    ->select('users.id','users.title','users.first_name','users.last_name','roles.name')
                                    ->first();
                            
                    $against_user_arr['id'] = isset($against_user->id) ? $against_user->id : '';   
                    $against_user_arr['title'] = isset($against_user->title) ? $against_user->title : '';   
                    $against_user_arr['first_name'] = isset($against_user->first_name) ? $against_user->first_name : '';   
                    $against_user_arr['last_name'] = isset($against_user->last_name) ? $against_user->last_name : '';   
                    $against_user_arr['name'] = isset($against_user->name) ? $against_user->name : '';   
                    
                    $this->arr_view_data['against_user_arr'] = $against_user_arr;
                }
                
                $this->arr_view_data['current_user_id']      = $this->user_id;
                $this->arr_view_data['dispute_id']           = $id;
                $this->arr_view_data['enc_dispute_id']           = $enc_id;
                $this->arr_view_data['arr_dispute']          = $arr_dispute;
                $this->arr_view_data['arr_dispute_response'] = $arr_dispute_response;
                $this->arr_view_data['module_url_path']      = $this->module_url_path;
                $this->arr_view_data['module_title']         = 'Dispute Payment details';

                return view($this->module_view_folder.'/view',$this->arr_view_data);

         }

        return redirect()->back(); 
    }

    public function response(Request $request)
    {
        $form_data = array();
        $form_data = $request->all();

        $arr_response['response']   = $form_data['response_msg']; 
        $arr_response['dispute_id'] = $form_data['dispute_id']; 
        $arr_response['to_id']      = ''; 
        $arr_response['from_id']    = $this->user_id; 
         
        $response_result = $this->DisputeResponseModel->create($arr_response);

         if($response_result)
        {
            $arr_response['status'] = 'success'; 
            $arr_response['msg'] = 'Comment has been sent Successfully.'; 
        }        
        else
        {
            $arr_response['status'] = 'error'; 
            $arr_response['msg'] = 'Problem Occured, While sending comment.'; 
        }

        return response()->json($arr_response);
    }

    public function multi_action(Request $request)
    {
        $arr_rules                   = array();
        $arr_rules['multi_action']   = 'required';
        $arr_rules['checked_record'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            {        
                $delete_dispute= $this->DisputeModel->where('id',$record_id)->delete();

                if($delete_dispute)
                {
                    Flash::success('Dispute Deleted Successfully.');                         
                }        
                else
                {
                   Flash::error('Problem Occured, While Deleting Dispute.');    
                }                 
            }
        }

        return redirect()->back();
    }

    public function download_dispute($enc_id)
    {

        if($enc_id!="")
        {
            $id = base64_decode($enc_id);  

            $obj_response_info = $this->DisputeResponseModel->where('id',$id)->first();
            if($obj_response_info!=FALSE)
            {

                $arr_response = $obj_response_info->toArray();

                if(sizeof($arr_response)>0)
                {

                    if(isset($arr_response['attachment']) && $arr_response['attachment']!=""  && file_exists('uploads/patient/dispute-attachment/'.$arr_response['attachment']))
                    {    
                 
                        $file     = "uploads/patient/dispute-attachment/".$arr_response['attachment'];
                        return Response::download($file);

                    }    
                }    
            }

        }

        return redirect()->back();
    }

    public function change_status(Request $request, $enc_dispute_id = FALSE)
    {
        $arr_rules                   = array();
        $arr_rules['dispute_status']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select dispute status');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        if($enc_dispute_id)
        {
          $msg = '';

          $dispute_id = base64_decode($enc_dispute_id);
          $dispute_status = $request->dispute_status;

          $get_dispute_data = $this->DisputeModel->where('id' , $dispute_id)->first();
          if($get_dispute_data)
          {
          	$dispute_data = $get_dispute_data->toArray();

          	$added_by_user_id = $dispute_data['added_by_user_id'];
          	$against_user_id = $dispute_data['against_user_id'];
          	$booking_id = $dispute_data['consultation_id'];
          	$dispute = $dispute_data['dispute_id'];
          	$from_user_id = "0";
          }

          if($dispute_status == 'closed')
          {
            $current_datetime = date('Y-m-d H:i:s');
            $upd_arr['status'] = $dispute_status; 
            $upd_arr['closed_date'] = $current_datetime;

            $msg = 'Dispute closed successfully';

            $this->create_notification($from_user_id, $added_by_user_id, $booking_id, $dispute." dispute is closed by Admin");
            $this->create_notification($from_user_id, $against_user_id, $booking_id, $dispute." dispute is closed by Admin");
          }
          else if($dispute_status == 'opened')
          {
            $upd_arr['status'] = $dispute_status; 
            $upd_arr['closed_date'] = '';

            $msg = 'Dispute Open successfully';

            $this->create_notification($from_user_id, $added_by_user_id, $booking_id, $dispute." dispute is opened by Admin");
            $this->create_notification($from_user_id, $against_user_id, $booking_id, $dispute." dispute is opened by Admin");
          }
          else if($dispute_status == 'new')
          {
            $upd_arr['status'] = $dispute_status; 
            $upd_arr['closed_date'] = ''; 

            $msg = 'Dispute status changed to new successfully';
          }

          $result_status = $this->DisputeModel->where('id' , $dispute_id)->update($upd_arr);
          if($result_status)
          {
             Flash::success($msg);
          }
          else
          {
             Flash::error('Problem Occured, While Changing dispute status.');
          }                                              
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

         return redirect()->back();
    }

    public function refund(Request $request)
    {
        $refund_to  = $request->input('cmb_refund_to');
        $dispute_id = base64_decode($request->input('txt_dispute_id'));

        $get_booking_data = $this->DisputeModel->with('booking_data')->where('id', $dispute_id)->first();
        if($get_booking_data)
        {
            $booking_data = $get_booking_data->toArray();

            \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
            $refund = Stripe\Refund::create(array(
              "charge" => $booking_data['booking_data']['transaction_id'],
              //"amount" => 1000,
              "refund_application_fee" => true,
              "reverse_transfer" => true
            ));

            $booking_id = $booking_data['booking_data']['id'];

            $data['refund_date'] = date("Y-m-d");
            $data['refind_amount'] = '';
            $data['refund_status'] = 'Completed';
            $this->PatientConsultationBookingModel->where('id', $booking_id)->update($data);

            Flash::success('Amount refunded to the selected user');
        }
        else
        {
            Flash::error('Something went wrong! Try again later.');
        }
        return redirect()->back();

    } // end refund


    public function create_notification($from_user_id, $to_user_id, $booking_id, $message)
    {
		$noti_arr['from_user_id'] = $from_user_id;
		$noti_arr['to_user_id']   = $to_user_id;
		$noti_arr['booking_id']   = $booking_id;
		$noti_arr['message']      = $message;

		$notification_res = $this->NotificationModel->create($noti_arr);

		if($notification_res)
		{
			$status = "success";
		}
		else
		{
			$status = "error";
		}
		return $status;
    } // end create_notification
   
}   
