<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Common\Services\EmailService;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\DoctorModel;
use App\Models\TimezonesModel;
use App\Models\UserTimezonesModel;
use App\Models\NotificationSettingModel;
use App\Models\PatientInvitationModel;
use App\Models\DoctorInvitationModel;
use App\Models\PharmacyInvitationModel;
use App\Models\FaqCategoryModel;
use App\Models\FaqsModel;
use App\Models\ContactEnquiryModel;
use App\Models\StaticPagesModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\DisputeModel;
use App\Models\FeedbackModel;
use App\Models\DisputeResponseModel;
use App\Models\NotificationModel;
use App\Models\AdminNotificationModel;

use Twilio\Rest\Client;

use Validator;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use PDF;
use Session;
use DB;

class SettingsController extends Controller
{
    public function __construct(
                                  EmailService                    $EmailService,   
                                  UserModel                       $user_model,
                                  DoctorModel                     $doctor_model,
                                  TimezonesModel                  $TimezonesModel,
                                  UserTimezonesModel              $UserTimezonesModel,
                                  NotificationSettingModel        $NotificationSettingModel,
                                  PatientInvitationModel          $PatientInvitationModel,
                                  DoctorInvitationModel           $doctor_invt_model,
                                  PharmacyInvitationModel         $pharmacy_invt_model,
                                  FaqCategoryModel                $faq_cat,
                                  FaqsModel                       $faq_model,
                                  ContactEnquiryModel             $contact_enquiry_model,
                                  StaticPagesModel                $StaticPagesModel,
                                  PatientConsultationBookingModel $patient_booking,
                                  DisputeModel                    $DisputeModel,
                                  FeedbackModel                   $FeedbackModel,
                                  NotificationModel               $NotificationModel,
                                  DisputeResponseModel            $dispute_response_model,
                                  AdminNotificationModel          $AdminNotificationModel
                                )
    {
        $this->arr_view_data                    = [];

        $this->EmailService                     = $EmailService;
        $this->UserModel                        = $user_model;
        $this->DoctorModel                      = $doctor_model;
        $this->TimezonesModel                   = $TimezonesModel;
        $this->UserTimezonesModel               = $UserTimezonesModel;
        $this->NotificationSettingModel         = $NotificationSettingModel;
        $this->PatientInvitationModel           = $PatientInvitationModel;
        $this->doctor_invt_model                = $doctor_invt_model;
        $this->pharmacy_invt_model              = $pharmacy_invt_model;
        $this->StaticPagesModel                 = $StaticPagesModel;
        $this->FaqcatModel                      = $faq_cat;
        $this->faqModel                         = $faq_model; 
        $this->contact_enquiry_model            = $contact_enquiry_model;
        $this->PatientConsultationBookingModel  = $patient_booking;
        $this->DisputeModel                     = $DisputeModel;
        $this->FeedbackModel                    = $FeedbackModel;
        $this->DisputeResponseModel             = $dispute_response_model;
        $this->NotificationModel                = $NotificationModel;
        $this->AdminNotificationModel           = $AdminNotificationModel;

        $this->patient_img_base_path            = public_path().config('app.project.img_path.patient');
        $this->patient_img_public_path          = url('/public').config('app.project.img_path.patient');

      	$this->module_view_folder               = 'front.doctor.settings';
        $this->module_url_path                  = url('/').'/doctor/settings';
        
        $user                                   = Sentinel::check();
        $this->user_id                          = '';

        if($user != false)
        {
           $this->user_id                       = $user->id;
           $this->user_first_name               = $user->first_name;
           $this->user_last_name                = $user->last_name;
        }
        else
        {
           $this->user_id                       = null;
           $this->user_first_name               = null;
           $this->user_last_name                = null;
        }
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 18/10/2017
    | Output    : 
    */

    public function index()
    {
          
        $this->arr_view_data['page_title']          = "Settings";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    } // end index


    /*
    | Function  : Get the email and password
    | Author    : Deepak Arvind Salunke
    | Date      : 23/10/2017
    | Output    : show email and password
    */
    
    public function email_and_password()
    {
        $get_user = $this->UserModel->where('id', $this->user_id)->first();

        $this->arr_view_data['user_arr']            = $get_user;
        $this->arr_view_data['page_title']          = "Email And Password";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        
        return view($this->module_view_folder.'.email_password.index',$this->arr_view_data);
    } // end email_and_password


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 24/10/2017
    | Output    : show information page
    */

    public function password_reset()
    {
        $this->arr_view_data['page_title']          = "Reset Password";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        return view($this->module_view_folder.'.email_password.password_reset',$this->arr_view_data);
    } // end password_reset


    /*
    | Function  : get all the data and store
    | Author    : Deepak Arvind Salunke
    | Date      : 24/10/2017
    | Output    : Success or error
    */

    public function password_update(Request $request)
    {
        $hasher = Sentinel::getHasher();
        $password = $request->password;
        
        $user = Sentinel::getUser();     
        if (!$hasher->check($request->old_password, $user->password)) {
            $arr_response['msg']='Your current password is incorrect';
        }   
        else
        {
            $res=Sentinel::update($user, array('password' => $password));
            if($res)
            {
                Session::flash('message', 'Password updated successfully');
            }
            else
            {
                Session::flash('message', 'Something went to wrong');
            }
        }
        return redirect()->back();

    } // end password_update


    /*
    | Function  : get all the store data
    | Author    : Deepak Arvind Salunke
    | Date      : 25/10/2017
    | Output    : show all the data for the user
    */

    public function notification()
    {
        $get_notification_arr = $this->NotificationSettingModel->where('user_id',$this->user_id)->get();
        if($get_notification_arr)
        {
            $notification_arr = $get_notification_arr->toArray();
        }

        $get_doc_data = $this->DoctorModel->where('user_id',$this->user_id)->select('mobile_no')->first();
        if($get_doc_data)
        {
            $this->arr_view_data['doc_data'] = $get_doc_data->toArray();
        }

        $this->arr_view_data['notification_arr']    = $notification_arr;
        $this->arr_view_data['page_title']          = "Notification Settings";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        return view($this->module_view_folder.'.notification_settings.index',$this->arr_view_data);
    } // end notification


    /*
    | Function  : store all the data in database
    | Author    : Deepak Arvind Salunke
    | Date      : 25/10/2017
    | Output    : Success or error
    */

    public function store_notification(Request $request)
    {
        $notification_arr = array(
            'notification_email'    => $request->email_notification,
            'email_consultation'    => $request->email_consultation,
            'email_orders'          => $request->email_orders,
            'email_newsletter'      => $request->email_newsletter,
            'msg_notification'      => $request->msg_notification,
            'msg_consultation'      => $request->msg_consultation,
            'msg_orders'            => $request->msg_orders,
            'msg_newsletter'        => $request->msg_newsletter,
            'app_notification'      => $request->app_notification,
            'app_consultation'      => $request->app_consultation,
            'app_orders'            => $request->app_orders,
            'app_newsletter'        => $request->app_newsletter,
        );

        $num = $this->NotificationSettingModel->where('user_id',$this->user_id)->count();

        if($num > 0)
        {
            foreach( $notification_arr as $key => $val)
            {
                if(isset($key) && !empty($val))
                {
                    $res = DB::table('dod_notification_settting')->where(['user_id'  =>  $this->user_id, 'notification' => $key ])->update(['status'=>$val]);
                }
            }
            $arr_response['msg'] = "Notification setting saved successfully";
        }
        else
        {
            foreach( $notification_arr as $key => $val)
            {
                if(isset($key) && !empty($val))
                {
                    $res=DB::table('dod_notification_settting')->insert(['user_id'=>$this->user_id,'notification'=>$key,'status'=>$val]); 
                }
            }

            if($res)
            {
                $arr_response['msg'] = "Notification setting saved successfully";
            }
            else
            {
                $arr_response['msg'] = "Something went to wrong";
            }
        }

        return response()->json($arr_response);

    } // end store_notification

    /*--------------------------------------------------------------------------
                                    INVITATION PAGE
    -----------------------------------------------------------------------------*/

    public function invitation()
    {
      $this->arr_view_data['module_url_path']       = $this->module_url_path;
      $this->arr_view_data['multipleArray']         = array($this->arr_view_data);

      return view($this->module_view_folder.'.invitation.index')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                            PATIENT INVITATION SENT AND STORE
    -----------------------------------------------------------------------------*/

    public function patient_invitation(Request $request)
    {
        $insert_arr['first_name'] = $request->first_name;
        $insert_arr['last_name'] = $request->last_name;
        $insert_arr['user_id'] = $this->user_id;
        $insert_arr['phone'] = $request->phone_no;
        $insert_arr['email_id'] = $request->email_id;
        $insert_arr['email_id'] = $request->email_id;
        $insert_arr['address'] = $request->address;

        $res=$this->PatientInvitationModel->create($insert_arr);
        if($res)
          {
            $this->module_path=url('');
            $link="<a class='btn_emailer_cls' href='".url('')."'>Accept Invitation</a>";

            $arr_built_content = [ 
                                      'MEMBER'            =>  $request->first_name.' '.$request->last_name,
                                      'APP_NAME'          =>  config('app.project.name'),
                                      'SENDER'            =>  'SENDER NAME',                
                                      'ACCEPT'            =>   $link
                                  ];

            $arr_data['first_name']     =   $request->first_name;
            $arr_data['last_name']     =   $request->last_name;
            $arr_data['email']         =   $request->email_id;
                                        
            $arr_mail_data                      = [];
            $arr_mail_data['email_template_id'] = '42';
            $arr_mail_data['arr_built_content'] = $arr_built_content;
            $arr_mail_data['user']              = $arr_data;
            $mail_status  = $this->EmailService->send_mail($arr_mail_data);            
            if($mail_status)
            {
              $arr_response['msg']='Invitation sent successfully';
            }
            else
            {
              $arr_response['msg']='Failed to sent Invitation ! Please try again later';
            }
          }
          else
          {
            $arr_response['msg']='something went to wrong';
          }

          return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                            PATIENT - CHECK INVITATION MAIL
    -----------------------------------------------------------------------------*/

    public function check_patient_invitation_mail(Request $request)
    {
       $num = $this->PatientInvitationModel->where('email_id',$request->email_id)->count();
       if($num>0)
       {
         $arr_response['status']='exist';
         $arr_response['msg']='Email id already registered, Please try again with other email id.';
       }
        else
        {
          $arr_response['status']='not_exist';
          $arr_response['msg']='';
        }

        return response()->json($arr_response); 
    }

    /*--------------------------------------------------------------------------
                            DOCTOR - INVITATION SENT AND STORE
    -----------------------------------------------------------------------------*/

    public function doctor_invitation(Request $request)
    {   
        $insert_arr['first_name'] = $request->first_name;
        $insert_arr['last_name'] = $request->last_name;
        $insert_arr['user_id'] = $this->user_id;
        $insert_arr['phone'] = $request->phone_no;
        $insert_arr['email'] = $request->email_id;
        $insert_arr['practice_name'] = $request->practice_name;
        $insert_arr['address'] = $request->practice_addr;

        $res=$this->doctor_invt_model->create($insert_arr);
        if($res)
          {
            $this->module_path=url('');
            $link="<a class='btn_emailer_cls' href='".url('')."/doctor"."'>Accept Invitation</a>";

            $arr_built_content = [ 
                                      'MEMBER'            =>  $request->first_name.' '.$request->last_name,
                                      'APP_NAME'          =>  config('app.project.name'),
                                      'SENDER'            =>  'SENDER NAME',                
                                      'ACCEPT'            =>   $link
                                  ];

            $arr_data['first_name']     =   $request->first_name;
            $arr_data['last_name']     =   $request->last_name;
            $arr_data['email']         =   $request->email_id;
                                        
            $arr_mail_data                      = [];
            $arr_mail_data['email_template_id'] = '42';
            $arr_mail_data['arr_built_content'] = $arr_built_content;
            $arr_mail_data['user']              = $arr_data;
            $mail_status  = $this->EmailService->send_mail($arr_mail_data);            
            if($mail_status)
            {
              $arr_response['msg']='Invitation sent successfully';
            }
            else
            {
              $arr_response['msg']='Failed to sent Invitation ! Please try again later';
            }
          }
          else
          {
            $arr_response['msg']='something went to wrong';
          }

          return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                                DOCTOR -  CHECK INVITATION MAIL 
    -----------------------------------------------------------------------------*/

    public function check_doctor_invitation_mail(Request $request)
    {
        $num = $this->doctor_invt_model->where('email',$request->email_id)->count();
        if($num>0)
        {
          $arr_response['status']='exist';
          $arr_response['msg']='Email id already registered, Please try again with other email id.';
        }
        else
        {
          $arr_response['status']='not_exist';
          $arr_response['msg']='';
        }

        return response()->json($arr_response); 
    }

    /*--------------------------------------------------------------------------
                              PHARMACY - CHECK INVITATION MAIL
    -----------------------------------------------------------------------------*/

    public function check_pharmacy_invitation_mail(Request $request)
    {
        $num    =   $this->pharmacy_invt_model->where('email',$request->email_id)->count();
        if($num>0)
        {
          $arr_response['status']='exist';
          $arr_response['msg']='Email id already registered, Please try again with other email id.';
        }
        else
        {
          $arr_response['status']='not_exist';
          $arr_response['msg']='';
        }

        return response()->json($arr_response);  
    }
    /*--------------------------------------------------------------------------
                            PHARMACY  - INVITATION SEND AND STORE
    -----------------------------------------------------------------------------*/
    public function pharmacy_invitation(Request $request)
    {

      $this->pharmacy_invt_model->user_id=$this->user_id;
      $this->pharmacy_invt_model->pharmacy_name=$request->pharmacy_name;
      $this->pharmacy_invt_model->pharmacy_no=$request->pharmacy_no;
      $this->pharmacy_invt_model->contact_person=$request->person_name;
      $this->pharmacy_invt_model->email=$request->pharmacy_mail;

      $insert_arr['user_id']       = $this->user_id;
      $insert_arr['pharmacy_name'] = $request->pharmacy_name;
      $insert_arr['pharmacy_no'] = $request->pharmacy_no;
      $insert_arr['contact_person'] = $request->person_name;
      $insert_arr['email'] = $request->pharmacy_mail;

      $res=$this->pharmacy_invt_model->create($insert_arr);
      if($res)
      {
        $this->module_path=url('');
        $link="<a class='btn_emailer_cls' href='".url('')."/pharmacy"."'>Accept Invitation</a>";

        $arr_built_content = [ 
                                  'MEMBER'            =>  $request->person_name,
                                  'APP_NAME'          =>  config('app.project.name'),
                                  'SENDER'            =>  'SENDER NAME',                
                                  'ACCEPT'            =>   $link
                              ];

        $arr_data['first_name']     =   $request->person_name;
        $arr_data['last_name']      =   '';
        $arr_data['email']          =   $request->pharmacy_mail;
                                    
        $arr_mail_data                      = [];
        $arr_mail_data['email_template_id'] = '42';
        $arr_mail_data['arr_built_content'] = $arr_built_content;
        $arr_mail_data['user']              = $arr_data;
        $mail_status  = $this->EmailService->send_mail($arr_mail_data);            
        if($mail_status)
        {
          $arr_response['msg']='Invitation sent successfully';
        }
        else
        {
          $arr_response['msg']='Failed to sent Invitation ! Please try again later';
        }
      }
      else
      {
        $arr_response['msg']='something went to wrong';
      }

      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                                    FAQ - DISPLAY CATEGORIES
    -----------------------------------------------------------------------------*/    
    public function faq_categories()
    {
        $faq_cats_arr=$this->FaqcatModel->where('belongs_to','doctor')
                                        ->orWhere('belongs_to','all')    
                                        ->orderBy('id','desc')->get()->toArray();

        $this->arr_view_data['module_url_path']       = $this->module_url_path;
        $this->arr_view_data['faq_cats_arr']          = $faq_cats_arr;
        return view($this->module_view_folder.'.help_and_support.faq')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                    FAQ - DISPLAY CATEGORYWISE
    -----------------------------------------------------------------------------*/
    public function faq($cat_id,$faq_id=false)
    {
      $faq_arr=$this->faqModel->where('category_id',$cat_id)->get()->toArray();

      $cat=$this->FaqcatModel->where('id',$cat_id)->select('category_name')->first();
      if(!empty($cat))
      {
       $cat_arr=$cat->toArray();
       $cat_name=$cat_arr['category_name'];
       $this->arr_view_data['category_name']=$cat_name;
      }

      $this->arr_view_data['faq_id']                =  $faq_id;
      $this->arr_view_data['module_url_path']       =  $this->module_url_path;
      $this->arr_view_data['faq_arr']               =  $faq_arr;

      return view($this->module_view_folder.'.help_and_support.faq_settings')->with($this->arr_view_data);
    }

    public function search_faq(Request $request)
    {  
      $faq_arr = $this->faqModel->whereHas('faq_catgeory', function($faq_cat){
                                        $faq_cat->where('belongs_to','doctor');
                                        $faq_cat->orWhere('belongs_to','all');
                                })
                                ->where('question','LIKE','%'.$request->search_txt.'%')
                                ->get()->toArray();
      
      return response()->json($faq_arr);
    }

     /*--------------------------------------------------------------------------
                                    ENQUIRY MESSAGE 
    -----------------------------------------------------------------------------*/
    public function enquiry_msg(Request $request)
    {
       
       $user_arr  = $this->UserModel->with('doctor_details')
                                    ->where('id',$this->user_id)
                                    ->first()
                                    ->toArray();
      $name='';
      $lname='';
     
      if(!empty($user_arr['first_name']))
      {
        $name=$user_arr['first_name'];
      }

      if(!empty($user_arr['last_name']))
      {
        $lname=$user_arr['last_name'];
      }

      $mob_no='';
      if(!empty($user_arr['doctor_details']['mobile_no']))
      {
        $phone_no=$user_arr['doctor_details']['mobile_no'];
      }

      $insert_arr['user_id']  = $this->user_id;
      $insert_arr['name']     = $name.' '.$lname;
      $insert_arr['phone_no'] = $phone_no;
      $insert_arr['email']    = $user_arr['email'];
      $insert_arr['message']  = $request->msg;

      $res=$this->contact_enquiry_model->create($insert_arr);

      if($res)
      {
         $arr_response['msg']='Message sent successfully';
      }
      else
      {
        $arr_response['msg']='Something went to wrong ! Please try again later';
      }

      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                                    LEGAL
    -----------------------------------------------------------------------------*/
    public function legal()
    {
      $data_arr=$this->StaticPagesModel->where('id','12')->orWhere([
                                                                      ['id','16']
                                                                      
                                                                    ])->orWhere([
                                                                      ['id','27']
                                                                      
                                                                    ])->get()->toArray();



      $this->arr_view_data['data_arr']              =  $data_arr;
      $this->arr_view_data['module_url_path']       =  $this->module_url_path;
      return view($this->module_view_folder.'.help_and_support.legal')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                    DYNAMIC PAGES - MISSION, PRIVACY POLICY , CONDITIONS 
    -----------------------------------------------------------------------------*/
    public function dynamic_pages($slug=false)
    {
      $data_arr = $this->StaticPagesModel->where('page_slug',$slug)
                                         ->first()
                                         ->toArray();

      $this->arr_view_data['data_arr']              =$data_arr;
      $this->arr_view_data['module_url_path']       =  $this->module_url_path;

      return view($this->module_view_folder.'.help_and_support.dynamic_pages')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                    DISPUTE NEW
    -----------------------------------------------------------------------------*/

    public function disputes()
      {
        $get_consult = $this->PatientConsultationBookingModel->where('doctor_user_id', $this->user_id)
                                                             ->where('booking_status', 'completed')
                                                             ->get();
        if($get_consult)
        {
          $this->arr_view_data['consult_data'] = $get_consult->toArray();
        }

        $dispute_arr = $this->DisputeModel->where('status', 'new')
                                          ->where(function($dispute){
                                                $dispute->where('added_by_user_id', $this->user_id);
                                                $dispute->orWhere('against_user_id', $this->user_id);
                                          })
                                          ->with('added_by_user_info','against_user_info')
                                          ->orderBy('id', 'desc')
                                          ->paginate(1);
        if(isset($dispute_arr))
        {
            $paginate = clone $dispute_arr;
            $this->arr_view_data['paginate'] = $paginate;
            $this->arr_view_data['dispute_arr'] = $dispute_arr->toArray();
        }                                          

        $this->arr_view_data['current_user_id']  = $this->user_id;
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
        return view($this->module_view_folder.'.disputes.new')->with($this->arr_view_data);
      } 

    /*--------------------------------------------------------------------------
                                DISPUTE OPEN 
    -----------------------------------------------------------------------------*/

      public function disputes_open()
      {

        $dispute_arr = $this->DisputeModel->where('status', 'opened')
                                          ->where(function($dispute){
                                                $dispute->where('added_by_user_id', $this->user_id);
                                                $dispute->orWhere('against_user_id', $this->user_id);
                                          })
                                          ->with('added_by_user_info','against_user_info')
                                          ->orderBy('id', 'desc')
                                          ->Paginate(1);
        if(isset($dispute_arr))
        {
            $paginate = clone $dispute_arr;
            $this->arr_view_data['paginate'] = $paginate; 
            $this->arr_view_data['dispute_arr'] = $dispute_arr->toArray();
        }  
        $this->arr_view_data['current_user_id']  = $this->user_id;
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
        return view($this->module_view_folder.'.disputes.open')->with($this->arr_view_data);
      } 

      /*--------------------------------------------------------------------------
                            DISPUTE CLOSED
      -----------------------------------------------------------------------------*/

      public function disputes_closed()
      {
        $dispute_arr = $this->DisputeModel->where('status', 'closed')
                                          ->where(function($dispute){
                                                $dispute->where('added_by_user_id', $this->user_id);
                                                $dispute->orWhere('against_user_id', $this->user_id);
                                          })
                                          ->with('added_by_user_info','against_user_info')
                                          ->orderBy('id', 'desc')
                                          ->paginate(1);
        if(isset($dispute_arr))
        {
            $paginate = clone $dispute_arr;
            $this->arr_view_data['paginate'] = $paginate;
            $this->arr_view_data['dispute_arr'] = $dispute_arr->toArray();
        }  
        $this->arr_view_data['current_user_id']  = $this->user_id;
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
        return view($this->module_view_folder.'.disputes.closed')->with($this->arr_view_data);
      } 


       /*--------------------------------------------------------------------------
                            DISPUTE - STORE
      -----------------------------------------------------------------------------*/

      public function disputes_store(Request $request)
      {
          $arr_rules['consultid']   =   "required";
          $arr_rules['reason']      =   "required";
          $arr_rules['option']      =   "required";
          $arr_rules['issue']       =   "required";
          $arr_rules['solution']    =   "required";
          $arr_rules['amount']      =   "required";
          
          $validator  =   Validator::make($request->all(),$arr_rules);
          if($validator->fails())
          {
            $arr_response['msg']= "All fields are required";
            return response()->json($arr_response);
          }

          $count_dispute = $this->DisputeModel->count();
          if($count_dispute <= 0)
          {
            $data['dispute_id'] = "D00401";
          }
          else
          {
            $get_id  = $this->DisputeModel->latest()->first();
            if($get_id)
            {
              $new_id = substr($get_id->dispute_id, 1);
              $data['dispute_id'] = "D".str_pad($new_id+1, 5, '0', STR_PAD_LEFT);
            }
          }

          $data['added_by_user_id']       = $this->user_id;
          $data['against_user_id']        = $request->input('against_user_id');
          $data['consultation_id']        = $request->input('consultid');
          $data['payment_reason']         = $request->input('reason');
          $data['amount']                 = $request->input('amount');
          $data['select_payment']         = $request->input('option');
          $data['what_is_issue']          = $request->input('issue');
          $data['what_solution_you_like'] = $request->input('solution');
          $data['status']                 = 'new';

          $this->NotificationModel->from_user_id =  $this->user_id;
          $this->NotificationModel->to_user_id   =  $request->input('against_user_id');
          $this->NotificationModel->message      =  "New dispute is added";
          $this->NotificationModel->save();

          $admin_notif['message'] = "Doctor - New dispute added by - ".$this->user_first_name.' '.$this->user_last_name;
          $this->AdminNotificationModel->create($admin_notif);

          $store_data = $this->DisputeModel->create($data);
          if($store_data)
          {
            $arr_response['msg']= "New Dispute added successfully !";
          }
          else
          {
            $arr_response['msg']= "Something went to wrong";
          }
          return response()->json($arr_response);
      }

      public function dispute_against_user(Request $request)
      {
          $consultation_id = $request->consultation_id;

          $user_obj = $this->PatientConsultationBookingModel->where('id', $consultation_id)
                                                       ->with('patient_user_details')
                                                       ->first();

          if(isset($user_obj) && !empty($user_obj))
          {
            $user_arr = $user_obj->toArray();

            $title = isset($user_arr['patient_user_details']['title']) ? $user_arr['patient_user_details']['title'] : '';
            $first_name = isset($user_arr['patient_user_details']['first_name']) ? $user_arr['patient_user_details']['first_name'] : '';
            $last_name = isset($user_arr['patient_user_details']['last_name']) ? $user_arr['patient_user_details']['last_name'] : '';
            $arr_response['status'] = 'success';
            $arr_response['against_user_name'] = $title.' '.$first_name.' '.$last_name;

            $arr_response['against_user_id'] = isset($user_arr['patient_user_details']['id']) ? $user_arr['patient_user_details']['id'] : '';
            return response()->json($arr_response);
          }
          else
          {
            $arr_response['status']            = 'error';
            $arr_response['against_user_name'] = '';
            $arr_response['against_user_id']   = '';
            return response()->json($arr_response);
          }                                                       
      }

      /*--------------------------------------------------------------------------
                    FEEDBACK PAGE 
    -----------------------------------------------------------------------------*/

    public function feedback()
    {
      $this->arr_view_data['module_url_path']       =  $this->module_url_path;
      return view($this->module_view_folder.'.help_and_support.feedback')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                    FEEDBACK - STORE 
    -----------------------------------------------------------------------------*/
    public function feedback_store(Request $request)
    {

      $insert_arr['doctor_id']  = $this->user_id;
      $insert_arr['feedback'] = $request->feedback;
      $insert_arr['rating']   = $request->rating;


      $res=$this->FeedbackModel->create($insert_arr);

      if($res)
      {
        $arr_response['msg']='Feedback Sent successfully';
      }
      else
      {
        $arr_response['msg']='Something went to wrong';
      }
      return response()->json($arr_response);

    }

    public function dispute_comments(Request $request)
    {
      if($request->dispute_id)
      {
          $dispute_id = base64_decode($request->dispute_id);
          
          $obj_dispute_response = $this->DisputeResponseModel->with('userinfo')
                                                  ->where('dispute_id',$dispute_id)
                                                  ->get();
          if(isset($obj_dispute_response) && !empty($obj_dispute_response))
          {
            $dispute_arr = $obj_dispute_response->toArray();
          }
          
      }
      else
      {
        $dispute_arr = '';       
      }

      return response()->json($dispute_arr);
    }

    public function dispute_comments_store(Request $request)
    {
      $arr_response['response']   = $request->reply; 
      $arr_response['dispute_id'] = base64_decode($request->dispute_id); 
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

  /*
  | Function  : 
  | Author    : Deepak Arvind Salunke
  | Date      : 03/04/2017
  | Output    : 
  */

  public function camera_and_internet_test()
  {
      
      
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.camera_and_internet_test.index',$this->arr_view_data);

  } // end camera_and_internet_test

}
?>
