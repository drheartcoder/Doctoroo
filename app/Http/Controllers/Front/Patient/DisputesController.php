<?php
namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\DisputeModel;
use App\Models\DisputeResponseModel;
use App\Models\AdminNotificationModel;

use App\Common\Services\EmailService;

use Validator;
use Flash;
use Sentinel;
use Activation;
use Reminder;
use URL;
use Session;
use Response;

class DisputesController extends Controller
{

    public function __construct(UserModel $UserModel,
                                DisputeModel $dispute_model,
                                DisputeResponseModel $dispute_response_model,
                                EmailService $EmailService,
                                AdminNotificationModel $AdminNotificationModel)
    {	

    	$this->arr_view_data[]     =  [];
    	$this->UserModel	       =  $UserModel;
        $this->DisputeModel        =  $dispute_model;
        $this->DisputeResponseModel = $dispute_response_model;
        $this->AdminNotificationModel = $AdminNotificationModel;

        $this->module_title       = "Dispute Payment";
        $this->module_view_folder = 'front.patient.disputes';
        $this->module_url_path    = url('/').'/patient';
        $this->base_path          = base_path().'/public';

        $user                     = Sentinel::check();
        $this->user_id            = '';

        if($user != false)
        {
           $this->user_id         = $user->id;
           $this->user_first_name = $user->first_name;
           $this->user_last_name  = $user->last_name;
        }
        else
        {
           $this->user_id         = null;
           $this->user_first_name = null;
           $this->user_last_name  = null;
        }
        
    }	

    public function index($enc_id=FALSE)
    {

        $id="";
        
        $arr_dispute = $arr_dispute_details = array();
        $this->arr_view_data['arr_dispute_details'] = array();
        $this->arr_view_data['arr_dispute']         = array();
        $this->arr_view_data['arr_dispute_response']= array(); 
        $this->arr_view_data['dispute_id'] = 0;

        $user = Sentinel::check();

        if($user)
        {

            /*================List of Dispute===========================*/
         
            $obj_dispute = $this->DisputeModel->where('user_id',$user->id)
                                              ->orderBy('id','desc')
                                              ->get();  
            if($obj_dispute!=FALSE)                                  
            {

                $arr_dispute    = $obj_dispute->toArray();  
            }

            $this->arr_view_data['arr_dispute']     = $arr_dispute;


            /*================Dispute Details===========================*/

            if($enc_id!="")
            {


                $id = base64_decode($enc_id);

                $obj_dispute_details = $this->DisputeModel->where('user_id',$user->id)
                                                          ->where('id',$id)  
                                                          ->first();  
                if($obj_dispute_details!=FALSE)                                  
                {

                    $arr_dispute_details  = $obj_dispute_details->toArray();  
                }

                
                $this->arr_view_data['arr_dispute_details']  = $arr_dispute_details;

                /*==================Response Array======================================*/

                

                $obj_dispute_response = $this->DisputeModel->with('userinfo','disputeresponse')
                                                           ->where('user_id',$user->id)
                                                           ->where('id',$id)  
                                                           ->first();  
                if($obj_dispute_response!=FALSE)                                  
                {

                    $arr_dispute_response  = $obj_dispute_response->toArray();  
                }

                $this->arr_view_data['dispute_id']  = $id;
                $this->arr_view_data['arr_dispute_response']  = $arr_dispute_response;

            }

        }

        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.manage',$this->arr_view_data);
    }

    public function add()
    {

        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.create',$this->arr_view_data);    
    }

    public function store_dispute(Request $request)
    {
        $form_data = $request->all();

        $user = Sentinel::check();

        if($user)
        {
            $arr_dispute['user_id']                 = $user->id; 
            $arr_dispute['payment_reason']          = $form_data['payment_reason']; 
            $arr_dispute['select_payment']          = $form_data['select_payment']; 
            $arr_dispute['what_is_issue']           = $form_data['what_is_issue']; 
            $arr_dispute['what_solution_you_like']  = $form_data['what_solution_you_like'];

            $dispute_result = $this->DisputeModel->create($arr_dispute);
            if($dispute_result)
            {
                $admin_notif['message'] = "Patient - New dispute added by - ".$this->user_first_name.' '.$this->user_last_name;
                $this->AdminNotificationModel->create($admin_notif);

                echo"success";
            }
            else
            {

                echo"error";    
            }

        }
        else
        {

            echo"not-valid";
        }

        return redirect()->back();  
    }

    public function response(Request $request)
    {

        $user = Sentinel::check();

        if($user)
        {

            $form_data = array();
            $form_data = $request->all();

            $upload_attachment = "";

            if($request->hasFile('upload_attachment'))
            {

                $upload_attachment   =   $request->file('upload_attachment');

                if(isset($upload_attachment) && sizeof($upload_attachment)>0)
                {

                                 
                        $extention  =   strtolower($upload_attachment->getClientOriginalExtension());
                        $valid_ext  =   ['pdf','doc','docx'];

                        if(!in_array($extention, $valid_ext))
                        {

                            echo"invalid-extension";
                        }
                        else
                        {

                            
                            $upload_attachment         = $request->file('upload_attachment');
                            $file_extension            = strtolower($request->file('upload_attachment')->getClientOriginalExtension()); 
                            $upload_attachment         = sha1(uniqid().$upload_attachment.uniqid()).'.'.$file_extension;
                            $upload_result             = $request->file('upload_attachment')->move($this->base_path.config('app.project.img_path.dispute_attachment'), $upload_attachment);

                        }
               }
               else
               {
                
                  echo"invalid-file";
                }
            }

              $arr_response['response']   = $form_data['response_msg']; 
              $arr_response['dispute_id'] = $form_data['dispute_id']; 
              $arr_response['to_id']      = 0; 
              $arr_response['from_id']    = $form_data['patient_id']; 
              $arr_response['attachment'] = $upload_attachment;
             
              $response_result = $this->DisputeResponseModel->create($arr_response);

              if($response_result)
              {

                 echo"success";   
              }
              else
              {

                 echo"error";
              }

        }
        else{
                echo"invalid";
            }    
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

}