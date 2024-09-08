<?php
namespace App\Http\Controllers\Front\Doctor;

use App\Models\UserModel;
use App\Models\DoctorModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\AvailabilityModel;
use App\Models\NotificationModel;
use App\Models\PatientConsultationImagesModel;
use App\Models\PatientPrescriptionQuestionsModel;
use App\Models\FamilyMemberModel;
use App\Models\PatientConsultationStatusModel;
use App\Models\ConsultationDocumentsModel;
use App\Models\ConsultationNotesModel;
use App\Models\DoctorTimeIntervalModel;
use App\Models\MobileCountryCodeModel;
use App\Models\NotificationSettingModel;
use App\Models\ConsultationPriceModel;
use App\Models\DoctorFeeModel;
use App\Models\AdminProfileModel;
use App\Models\FamilyDoctorsModel;
use App\Models\DoctroFeesModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Twilio\Rest\Client;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Validator;
use PDF;
use Session;
use File;
use DB;
use Mail;

class ConsultationController extends Controller
{
    public function __construct(UserModel                         $user_model,
                                DoctorModel                       $doctor_model,
                                PatientConsultationBookingModel   $patient_booking,
                                AvailabilityModel                 $availability_model,
                                PatientConsultationImagesModel    $consultation_image,
                                NotificationModel                 $notification,
                                PatientPrescriptionQuestionsModel $prescription_model,
                                FamilyMemberModel                 $family_member_model,
                                PatientConsultationStatusModel    $consultation_status,
                                ConsultationDocumentsModel        $ConsultationDocumentsModel,
                                ConsultationNotesModel            $ConsultationNotesModel,
                                DoctorTimeIntervalModel           $DoctorTimeIntervalModel,
                                MobileCountryCodeModel            $MobileCountryCodeModel,
                                NotificationSettingModel          $NotificationSettingModel,
                                ConsultationPriceModel            $ConsultationPriceModel,
                                DoctorFeeModel                    $DoctorFeeModel,
                                FamilyDoctorsModel                $FamilyDoctorsModel,
                                AdminProfileModel                 $AdminProfileModel,
                                DoctroFeesModel                   $DoctroFeesModel
                                )
    {

        $this->arr_view_data                       = [];

        $this->UserModel                           = $user_model;
        $this->DoctorModel                         = $doctor_model;
        $this->PatientConsultationBookingModel     = $patient_booking;
        $this->AvailabilityModel                   = $availability_model;
        $this->PatientConsultationImagesModel      = $consultation_image;
        $this->NotificationModel                   = $notification;
        $this->PatientPrescriptionQuestionsModel   = $prescription_model;
        $this->FamilyMemberModel                   = $family_member_model;
        $this->PatientConsultationStatusModel      = $consultation_status;
        $this->ConsultationDocumentsModel          = $ConsultationDocumentsModel;
        $this->ConsultationNotesModel              = $ConsultationNotesModel;
        $this->DoctorTimeIntervalModel             = $DoctorTimeIntervalModel;
        $this->MobileCountryCodeModel              = $MobileCountryCodeModel;
        $this->NotificationSettingModel            = $NotificationSettingModel;
        $this->ConsultationPriceModel              = $ConsultationPriceModel;
        $this->DoctorFeeModel                      = $DoctorFeeModel;
        $this->AdminProfileModel                   = $AdminProfileModel;
        $this->FamilyDoctorsModel                  = $FamilyDoctorsModel;
        $this->DoctroFeesModel                     = $DoctroFeesModel;


        $this->module_view_folder                   = 'front.doctor.consultation';
        $this->module_url_path                      = url('/').'/doctor/consultation';
        $this->module_booking_path                  = url('/').'/doctor/consultation';

        $this->doctor_base_img_path                 = public_path().config('app.project.img_path.doctor');
        $this->doctor_public_img_path               = url('/public').config('app.project.img_path.doctor');

        $this->health_issue_base_img_path           = public_path().config('app.project.img_path.health_issue_img_path');
        $this->health_issue_public_img_path         = url('/public').config('app.project.img_path.health_issue_img_path');

        $this->prescription_base_img_path           = public_path().config('app.project.img_path.prescription_img');
        $this->prescription_public_img_path         = url('/public').config('app.project.img_path.prescription_img');

        $this->profile_img_base_path                = public_path().config('app.project.img_path.patient');
        $this->profile_img_public_path              = url('/public').config('app.project.img_path.patient');

        $this->patient_uploads_public_url           = public_path().config('app.project.img_path.patient_uploads');
        $this->patient_uploads_base_url             = url('/public').config('app.project.img_path.patient_uploads');

        $this->consultation_documents_base_url      = url('/public').config('app.project.img_path.consultation_documents');
        $this->consultation_documents_public_url    = public_path().config('app.project.img_path.consultation_documents');

        $this->patient_uploads_url                  = url('/public').config('app.project.img_path.patient_uploads');
        $this->profile_uploads_base_url             = public_path().config('app.project.img_path.patient_uploads');

        $this->sid                                  = config('services.twilio')['accountSid'];
        $this->token                                = config('services.twilio')['auth_token'];
        $this->service_id                           = config('services.twilio')['service_id'];
        $this->client                               = new Client($this->sid,$this->token);

        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }
        //$this->client = \Eway\Rapid::createClient(config('services.EWAY')['API_KEY'] ,config('services.EWAY')['API_PASSWORD'],\Eway\Rapid\Client::MODE_SANDBOX);
    }


    /*
    | Function  : Get all the new consultation request which are pending for approve/reject
    | Author    : Deepak Arvind Salunke
    | Date      : 09/08/2017
    | Output    : Listing of new consultation request
    */

    public function new_consultation_request()
    {
        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

        $get_booking = $this->PatientConsultationBookingModel->with('patient_user_details','familiy_member_info')
                                                             ->where('doctor_user_id', $this->user_id)
                                                             ->where('booking_status','Pending')
                                                             /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                             ->orderBy('id','desc')
                                                             ->paginate(10);
        if($get_booking)
        {
            $this->arr_view_data['paginate']      = clone $get_booking;
            $this->arr_view_data['arr_booking']   = $get_booking->toArray();
        }
        
        $this->arr_view_data['doctor_id']         = $this->user_id;
        $this->arr_view_data['profile_img_path']  = $this->profile_img_public_path;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;

        return view($this->module_view_folder.'.new_consultation')->with($this->arr_view_data);
    } 
    
    public function consultation_request_with_ajax(Request $request)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');
        $status            = $request->input('status');
       
        $consultation = '';
        if($status == "Pending"){

        $get_booking = $this->PatientConsultationBookingModel->with('patient_user_details','familiy_member_info')
                            ->where('doctor_user_id', $this->user_id)
                            ->where('booking_status',$status);
                             /*->where('consultation_datetime', '>=', $current_datetime)*/
                            $get_booking->orderBy('id','desc');
                            $get_booking = $get_booking->paginate(10);


        $consultation = 'new_consultation_request_details';                    
        }

        if($status == "Confirmed"){

        $get_booking = $this->PatientConsultationBookingModel
                            ->where([
                                     /*['consultation_datetime','>',$current_datetime],*/
                                     ['booking_status','Confirmed'],
                                     ['doctor_user_id',$this->user_id]
                                    ])
                            ->with('patient_user_details','familiy_member_info')
                            ->orderBy('id','desc')
                            ->paginate(10);

        $consultation = 'upcoming_consultation_details';                            
        }

        if($status == "Completed"){

        $get_booking = $this->PatientConsultationBookingModel
                            ->where([
                                     //['consultation_datetime','<',$current_datetime],
                                     ['doctor_user_id',$this->user_id]
                                    ])
                              ->where(function($query) use($current_datetime){
                                    $query->where('booking_status','Completed');
                                   /* $query->orWhere('booking_status','Confirmed');*/
                               })
                            ->with('patient_user_details','familiy_member_info')
                            ->orderBy('id','desc')
                            ->paginate(10);

        $consultation = 'past_consultation_details';                    
        }

        if($status == "Declined"){

        $get_booking = $this->PatientConsultationBookingModel->with('patient_user_details','familiy_member_info')
                            ->where('doctor_user_id', $this->user_id)
                            ->where(function($query){
                                  $query->where('booking_status','Declined');
                                  $query->orWhere('booking_status','Cancelled');
                                  $query->orWhere('booking_status','Rescheduled');
                            })
                              /*->orWhere([
                                                ['booking_status', 'Pending'],
                                                ['consultation_datetime','<' , $current_datetime]
                                            ])*/
                            ->orderBy('id','desc')
                            ->paginate(10);

        $consultation = 'declined_consultation_details';                    
        }



        if($get_booking){

            $this->arr_view_data['paginate']      = clone $get_booking;
            $this->arr_view_data['arr_booking']   = $get_booking->toArray();
        }

        $arr_booking = $this->arr_view_data['arr_booking'];

        /* Html Content */
        $html = '';
        if(isset($arr_booking['data']) && !empty($arr_booking['data'])) {
            
            $html .= '<div class="table-row heading hidden-xs">';
                        $html .='<div class="table-cell">Patient\'s Name</div>';
                        $html .='<div class="table-cell">Consultation Time</div>';
                        $html .='<div class="table-cell">Type</div>';
                        $html .='<div class="table-cell">Status</div>';
                        $html .='<div class="table-cell center-align">Consultation Details</div>';                        
            $html .='</div>';

            foreach($arr_booking['data'] as $booking_data){

                if($booking_data['familiy_member_info'] == null)
                {
                    $pat_title      = isset($booking_data['patient_user_details']['title'])?$booking_data['patient_user_details']['title']:'';
                    $pat_first_name = isset($booking_data['patient_user_details']['first_name'])?$booking_data['patient_user_details']['first_name']:'';
                    $pat_last_name  = isset($booking_data['patient_user_details']['last_name'])?$booking_data['patient_user_details']['last_name']:'';
                }
                else
                {
                    $pat_title      = "";
                    $pat_first_name = isset($booking_data['familiy_member_info']['first_name'])?$booking_data['familiy_member_info']['first_name']:'';
                    $pat_last_name  = isset($booking_data['familiy_member_info']['last_name'])?$booking_data['familiy_member_info']['last_name']:'';
                }

                // check listisng image
                if($booking_data['familiy_member_info'] == null)
                {
                    if ( isset($booking_data['patient_user_details']['profile_image']) && !empty($booking_data['patient_user_details']['profile_image']) )
                    {
                        $profile_images = $this->profile_img_public_path.$booking_data['patient_user_details']['profile_image'];
                        // check if image exists or not
                        if ( File::exists($profile_images) ) 
                        {
                            $profile_images = $this->profile_img_public_path."default-image.jpeg";
                        } // end if
                    } // end if
                    else
                    {
                        $profile_images = $this->profile_img_public_path."default-image.jpeg";
                    } // end else
                 } 
                 else
                 {
                     $profile_images = $this->profile_img_public_path."default-image.jpeg";
                 }  

                 $consult_datetime = convert_utc_to_userdatetime($this->user_id,"doctor",$booking_data['consultation_datetime']);
                 
                 $html .='<div class="table-row content-row-table">';
                    $html .='<div class="table-cell transaction-id">';
                        $html .='<span class="patient-profile-pic">';
                            $html .='<img src="'.$profile_images.'" alt="" />';
                            if($booking_data['patient_user_details']['is_online'] == 1){
                                $html .= '<span class="onlinenew"></span>';
                            }else{
                                $html .='<span class="online"></span>';
                            }
                        $html .='</span>';
                        $html .='<span class="patient-name-block">'.$pat_title.' '.$pat_first_name.' '.$pat_last_name.'</span>';
                    $html .='</div>';
                    $html .='<div class="table-cell transaction-date">'.date("h:i a D, M d Y", strtotime($consult_datetime)).'</div>';
                    $html .='<div class="table-cell transaction-price">Doctoroo</div>';
                    $html .='<div class="table-cell transaction-desciption"><span class="description">'.$booking_data['booking_status'].'</span></div>';
                    $html .='<div class="table-cell transaction-status view-details-btn">'.'<a href='.url("/").'/doctor/consultation/'.$consultation.'/'.base64_encode($booking_data['id']).'>View details</a></div>';
                $html .='</div>';
            }
        } else {
            $html .= '<h5 class="no-data">No data found</h5>';
                /*$html .='<div class="no-data" style="color: #184059;">No request for now</div>';
            $html .='</div>';*/
        }

        echo $html;
    }
    /* End Html Content */
    // end new_consultation_request





    /*--------------------------------------------------------------------------
                                    CONSULTATION - UPCOMING
    -----------------------------------------------------------------------------*/
    public function upcoming_consultation()
    {
       $current_datetime = date( "Y-m-d H:i:s");
    
       $upcoming_consultation = $this->PatientConsultationBookingModel
                                    ->where([
                                             /*['consultation_datetime','>',$current_datetime],*/
                                             ['booking_status','Confirmed'],
                                             ['doctor_user_id',$this->user_id]
                                            ])
                                    ->with('patient_user_details','familiy_member_info')
                                    ->orderBy('id','desc')
                                    ->paginate(10);
       if($upcoming_consultation)
       {
        $this->arr_view_data['paginate']                  = clone $upcoming_consultation;
        $this->arr_view_data['upcoming_consultation_arr'] =$upcoming_consultation->toArray();
       }
       
       $this->arr_view_data['doctor_id']                   = $this->user_id;
       $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
       $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;
       $this->arr_view_data['module_url_path']             = $this->module_url_path;

       return view($this->module_view_folder.'.upcoming_consultation')->with($this->arr_view_data);
    }
    /*--------------------------------------------------------------------------
                                    CONSULTATION - PAST
    -----------------------------------------------------------------------------*/
    public function past_consultation()
    {
       $current_datetime = date( "Y-m-d H:i:s");
       $past_consultation = $this->PatientConsultationBookingModel
                                    ->where([
                                             //['consultation_datetime','<',$current_datetime],
                                             ['doctor_user_id',$this->user_id]
                                            ])
                                      ->where(function($query) use($current_datetime){
                                            $query->where('booking_status','Completed');
                                           /* $query->orWhere('booking_status','Confirmed');*/
                                       })
                                    ->with('patient_user_details','familiy_member_info')
                                    ->orderBy('id','desc')
                                    ->paginate(10);
       if($past_consultation)
       {
        $this->arr_view_data['paginate']              = clone $past_consultation;
        $this->arr_view_data['past_consultation_arr'] = $past_consultation->toArray();
       }
       
       $this->arr_view_data['doctor_id']                   = $this->user_id;
       $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
       $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;
       $this->arr_view_data['module_url_path']             = $this->module_url_path;
       return view($this->module_view_folder.'.past_consultation')->with($this->arr_view_data);
    }


    /*
    | Function  : Get all the decline consultation
    | Author    : Deepak Arvind Salunke
    | Date      : 09/08/2017
    | Output    : Listing of decline consultation
    */

    public function decline_consultation()
    {
        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

        $get_rejected_booking = $this->PatientConsultationBookingModel->with('patient_user_details','familiy_member_info')
                                                                      ->where('doctor_user_id', $this->user_id)
                                                                      ->where(function($query){
                                                                          $query->where('booking_status','Declined');
                                                                          $query->orWhere('booking_status','Cancelled');
                                                                          $query->orWhere('booking_status','Rescheduled');
                                                                      })
                                                                      /*->orWhere([
                                                                                        ['booking_status', 'Pending'],
                                                                                        ['consultation_datetime','<' , $current_datetime]
                                                                                    ])*/
                                                                      ->orderBy('id','desc')
                                                                      ->paginate(10);
        if($get_rejected_booking)
        {
            $this->arr_view_data['paginate']                = clone $get_rejected_booking;
            $this->arr_view_data['arr_rejected_booking']    = $get_rejected_booking->toArray();
        }

        $this->arr_view_data['doctor_id']         = $this->user_id;
        $this->arr_view_data['profile_img_path']  = $this->profile_img_public_path;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        return view($this->module_view_folder.'.decline_consultation')->with($this->arr_view_data);
    } // end decline_consultation

     public function declined_consultation_details($enc_id)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

       $get_rejected_booking = $this->PatientConsultationBookingModel->with('patient_user_details','familiy_member_info')
                                                                      ->where('doctor_user_id', $this->user_id)
                                                                      ->where('id',base64_decode($enc_id))
                                                                      ->where(function($query) use($current_datetime){
                                                                        $query->orWhere('booking_status','Declined');
                                                                        $query->orWhere('booking_status','Cancelled');
                                                                        $query->orWhere('booking_status','Rescheduled');
                                                                        /*$query->orWhere([
                                                                           ['booking_status', 'Pending'],
                                                                           ['consultation_datetime','<' , $current_datetime]
                                                                        ]);*/
                                                                      })
                                                                      ->first();
        
        if($get_rejected_booking)
        {
         $this->arr_view_data['declined_consultation_arr']   = $get_rejected_booking->toArray();
        }  

        //dd($this->arr_view_data['declined_consultation_arr']);

        $health_images =$this->PatientConsultationImagesModel->where('booking_id',base64_decode($enc_id))
                                                             ->get();
        if(isset($health_images))
        {
            $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        } 

       $this->arr_view_data['doctor_id']                  = $this->user_id;
       $this->arr_view_data['patient_uploads_public_url'] = $this->patient_uploads_public_url;
       $this->arr_view_data['patient_uploads_base_url']   = $this->patient_uploads_base_url; 
       $this->arr_view_data['module_url_path']            = $this->module_url_path;

       return view($this->module_view_folder.'.declined_consultation_details')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                    UPCOMING CONSULTATION DETAILS
    -----------------------------------------------------------------------------*/

    public function upcoming_consultation_details($enc_id)
    {
        $current_datetime = date( "Y-m-d H:i:s");
        $upcoming_consultation = $this->PatientConsultationBookingModel
                                      ->where([
                                              /*['consultation_datetime','>',$current_datetime],*/
                                              ['id', base64_decode($enc_id)],
                                              ['booking_status', 'Confirmed']
                                             ])
                                      ->with('patient_user_details','familiy_member_info','consultation_documents','consultation_notes','invoice_info')
                                      ->first();
        
        if($upcoming_consultation)
        {
         $this->arr_view_data['upcoming_consultation_arr']   = $upcoming_consultation->toArray();
        }

        $health_images =$this->PatientConsultationImagesModel->where('booking_id',base64_decode($enc_id))
                                                             ->get();
        if(isset($health_images))
        {
            $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        }

       $this->arr_view_data['consultation_documents_base_url']   = $this->consultation_documents_base_url;
       $this->arr_view_data['consultation_documents_public_url'] = $this->consultation_documents_public_url;
       $this->arr_view_data['doctor_id']                  = $this->user_id;
       $this->arr_view_data['patient_uploads_public_url'] = $this->patient_uploads_public_url; 
       $this->arr_view_data['patient_uploads_base_url']   = $this->patient_uploads_base_url; 
       $this->arr_view_data['module_url_path']            = $this->module_url_path;

       return view($this->module_view_folder.'.upcoming_consultation_details')->with($this->arr_view_data);
    }
    /*--------------------------------------------------------------------------
                                    PAST CONSULTATION DETAILS
    -----------------------------------------------------------------------------*/
    public function past_consultation_details($enc_id)
    {
      $current_datetime = date('Y-m-d H:i:s');
      $past_consultation = $this->PatientConsultationBookingModel
                                    ->where([['id', base64_decode($enc_id)]])
                                    ->where(function($query) use($current_datetime){
                                          $query->orWhere('booking_status','Completed');
                                          $query->orWhere('booking_status','Confirmed');
                                     })
                                    ->with('patient_user_details','familiy_member_info','consultation_documents','consultation_notes','invoice_info')
                                    ->first();

        if($past_consultation)
        {
         $this->arr_view_data['past_consultation_arr']   = $past_consultation->toArray();
        }

        $health_images =$this->PatientConsultationImagesModel->where('booking_id',base64_decode($enc_id))
                                                             ->get();
        if(isset($health_images))
        {
            $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        }


       $this->arr_view_data['doctor_id']                         = $this->user_id;
       $this->arr_view_data['consultation_documents_base_url']   = $this->consultation_documents_base_url;
       $this->arr_view_data['consultation_documents_public_url'] = $this->consultation_documents_public_url;
       $this->arr_view_data['patient_uploads_public_url']        = $this->patient_uploads_public_url; 
       $this->arr_view_data['patient_uploads_base_url']          = $this->patient_uploads_base_url;  
       $this->arr_view_data['module_url_path']                   = $this->module_url_path;
       
       return view($this->module_view_folder.'.past_consultation_details')->with($this->arr_view_data);
    }



    /*
    | Function  : Get all the decline consultation
    | Author    : Deepak Arvind Salunke
    | Date      : 09/08/2017
    | Output    : Listing of decline consultation
    */

    public function new_consultation_request_details($enc_id)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

        $arr_family_member = $arr_booking_data = [];

        $get_booking = $this->PatientConsultationBookingModel->with('patient_user_details','familiy_member_info')
                                                             ->where('id',base64_decode($enc_id))
                                                             ->where('doctor_user_id', $this->user_id)
                                                             ->where('booking_status','Pending')
                                                             /*->where('consultation_datetime', '>=', $current_datetime)*/
                                                             ->first();
        if($get_booking)
        {
            $arr_booking_data = $get_booking->toArray();
        }
       

        if(isset($arr_booking_data['family_member_id']) && $arr_booking_data['family_member_id'] != 0)
        {
            $get_family_data = $this->FamilyMemberModel->where('id', $arr_booking_data['family_member_id'])
                                                       ->first();
            if($get_family_data)
            {
                $arr_family_member = $get_family_data->toArray();
            }
        }

        $health_images =$this->PatientConsultationImagesModel->where('booking_id',base64_decode($enc_id))
                                                             ->get();
        if(isset($health_images))
        {
            $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        } 


       $this->arr_view_data['doctor_id']                  = $this->user_id;
       $this->arr_view_data['patient_uploads_public_url'] = $this->patient_uploads_public_url; 
       $this->arr_view_data['patient_uploads_base_url']   = $this->patient_uploads_base_url; 
       $this->arr_view_data['arr_family_member'] = $arr_family_member;
       $this->arr_view_data['arr_booking']       = $arr_booking_data;
       $this->arr_view_data['profile_img_path']  = $this->profile_img_public_path;
       $this->arr_view_data['module_url_path']   = $this->module_url_path;

       return view($this->module_view_folder.'.new_consultation_request_details')->with($this->arr_view_data);
    } // end new_consultation_request_details


    /*
    | Function  : Change booking status as per action confirmed/declined for the new consultation request
    | Author    : Deepak Arvind Salunke
    | Date      : 10/08/2017
    | Output    : Success or Error
    */

    public function booking_status(Request $request)
    {
        $booking_id                     = $request->input('booking_id');
        $booking_data['booking_status'] = $request->input('booking_status');

        $update_booking = $this->PatientConsultationBookingModel->where('id', $booking_id)->update($booking_data);

        $status_data['booking_id']     = $request->input('booking_id');
        $status_data['user_id']        = $request->input('user_id');
        $status_data['doctor_id']      = $this->user_id;
        $status_data['status']         = $request->input('booking_status');
        $status_data['performed_by']   = $this->user_id;
        $booking_status                = $request->input('booking_status');

        $notification_type = '';
        if($booking_status == 'Cancelled')
        {
            $status_data['comment'] = 'Consultation Cancelled by Doctor';
            $notification_arr['type'] = 'booking_cancelled';
        }

        $get_count = $this->PatientConsultationStatusModel->where('booking_id', $booking_id)
                                                          ->where('user_id', $request->input('user_id'))
                                                          ->where('doctor_id', $this->user_id)
                                                          ->where(function($query) use($booking_status)
                                                            {
                                                                if($booking_status == 'Confirmed')
                                                                {
                                                                    $query->where('status', 'Confirmed');
                                                                }
                                                                if($booking_status == 'Declined')
                                                                {
                                                                    $query->where('status', 'Declined');
                                                                }
                                                                if($booking_status == 'Cancelled')
                                                                {
                                                                    $query->where('status', 'Cancelled');
                                                                }
                                                            })
                                                          ->count();
        if($get_count == 0)
        {
            $add_booking_status = $this->PatientConsultationStatusModel->create($status_data);
        }

        if($update_booking)
        {
            $arr_json['status'] = 'success';
            if($request->input('booking_status') == 'Confirmed')
            {
              
              $get_booking = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                                   ->with(['patient_user_details' => function($details){
                                                                        $details->select('id', 'title', 'first_name', 'last_name', 'email');
                                                                    },
                                                                    'patient_info' => function($info){
                                                                        $info->select('user_id', 'mobile_code', 'mobile_no');
                                                                    },
                                                                    'patient_info.country_code' => function($code){
                                                                        $code->select('id', 'phonecode');
                                                                    }])
                                                                   ->first();
              if($get_booking)
              {
                $booking_data = $get_booking->toArray();

                $user = Sentinel::findById($this->user_id);
                $doc['title']               = $user->title;
                $doc['first_name']          = $user->first_name;
                $doc['last_name']           = $user->last_name;
                $doc['email']               = $user->email;

                $to = '+'.$booking_data['patient_info']['country_code']['phonecode'].''.decrypt_value($booking_data['patient_info']['mobile_no']);
                $message = "Your consultation request has been confirmed by ".$doc['title']." ".$doc['last_name'];
                
                $sid            = env('TWILIO_SMS_SID');
                $token          = env('TWILIO_SMS_TOKEN');
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

                /* -- send mail to client -- */
                /* content variables in view */
                $content['title']               = $booking_data['patient_user_details']['title'];
                $content['first_name']          = $booking_data['patient_user_details']['first_name'];
                $content['last_name']           = $booking_data['patient_user_details']['last_name'];
                $content['email']               = $booking_data['patient_user_details']['email'];
                $content['message']             = $message;
                $content['subject']             = 'Consultation Update';
                /* end content variables in view */


                /* built content variables in view */
                $content             =  view('front.email.consult_request',compact('content'))->render();
                $content             =  html_entity_decode($content);
                /* end built content variables in view */
               
                $to_email_id         = $booking_data['patient_user_details']['email'];
                $project_name        = config('app.project.name');
                $mail_subject        = 'Consultation Update';


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

              $message = "has Cofirmed your consultation request"; 
              $notification_arr['type'] = 'Confirmed';
            }
            if($request->input('booking_status') == 'Declined')
            {
              $message = "has Declined your consultation request";
              $notification_arr['type'] = 'Declined';
            }
            if($request->input('booking_status') == 'Cancelled')
            {
              $message = "has Cancelled your consultation request";
              $notification_arr['type'] = 'Cancelled';
            }

            /*$res_count =  $this->NotificationSettingModel->where('user_id',$request->input('user_id'))
                                                         ->where('notification','email_consultation')
                                                         ->where('status','yes')
                                                         ->count();
            if($res_count > 0 )
            {*/

                $notification_arr['from_user_id'] = $this->user_id;
                $notification_arr['to_user_id']   = $request->input('user_id');
                $notification_arr['booking_id']   = $booking_id;
                $notification_arr['message']      = $message;

                $create = $this->NotificationModel->create($notification_arr);
            /*}*/
            
        }
        else
        {
            $arr_json['status'] = 'error';
        }
        
        return response()->json($arr_json);

    } // end booking_status

    public function past_consultation_details_download($enc_id)
    {

      $current_datetime = date( "Y-m-d H:i:s");                                    

      $past_consultation = $this->PatientConsultationBookingModel
                                ->where([['id', base64_decode($enc_id)]])
                                ->where([
                                    //['consultation_datetime','<',$current_datetime],
                                    ['doctor_user_id',$this->user_id]
                                ])
                                ->where(function($query) use($current_datetime){
                                    $query->orWhere('booking_status','Completed');
                                    $query->orWhere('booking_status','Confirmed');
                                })
                                ->with('patient_user_details','patient_info','familiy_member_info')
                                ->first();

      $fname = "";
      $fname = "";

      if($past_consultation)
      {
        $past_consultation_arr                          = $past_consultation->toArray();
        $this->arr_view_data['past_consultation_arr']   = $past_consultation_arr;

        if($past_consultation_arr['familiy_member_info'] == null)
        {
            $fname = isset($past_consultation_arr['patient_user_details']['first_name']) ? $past_consultation_arr['patient_user_details']['first_name'].'-' : '';
            $lname = isset($past_consultation_arr['patient_user_details']['last_name']) ? $past_consultation_arr['patient_user_details']['last_name'].'-' : '';
        }
        else
        {
            $fname = isset($past_consultation_arr['familiy_member_info']['first_name']) ? $past_consultation_arr['familiy_member_info']['first_name'].'-' : '';
            $lname = isset($past_consultation_arr['familiy_member_info']['last_name']) ? $past_consultation_arr['familiy_member_info']['last_name'].'-' : '';
        }
      }

      $this->arr_view_data['doctor_id']                   = $this->user_id;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
      $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;
      $this->arr_view_data['pdf_name']                    = $fname.$lname.'post-consultation-details.pdf';

      Session::put("arr_past_consul_data",'');
      return response()->json($this->arr_view_data);
    }

    public function past_consultation_details_download_pdf(Request $request)
    {
      if($request->has('arr_data') && $request->input('arr_data')!='')
      {
        $arr_session_data = $request->input('arr_data');
        Session::put("arr_past_consul_data",$arr_session_data);
        return response()->json(['status'=>'success']);
      }
      $arr_data = Session::get("arr_past_consul_data");
      if(!empty($arr_data))
      {        
              // Custom Header
          PDF::setHeaderCallback(function($pdf) {

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
          
          PDF::SetTitle('Doctoroo | Post Consultation Details');
          PDF::SetMargins(10, 30, 10, 10);
          PDF::SetFontSubsetting(false);
          PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
          PDF::AddPage();
          PDF::writeHTML(view($this->module_view_folder.'.pdf.past_consultation_details', $arr_data)->render());
          PDF::Output($arr_data['pdf_name']);
       }
       return redirect()->back();
    }

    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 12/10/2017
    | Output    : Success or Error
    */

    /*public function show_available_time1(Request $request)
    {
        
        $patient_id = $request->input('get_resechdule_patient_id');
        $booking_id = $request->input('get_resechdule_booking_id');
        
        $insert_arr['from_user_id'] = $this->user_id;
        $insert_arr['to_user_id']   = $patient_id;
        $insert_arr['booking_id']   = $booking_id;
        $insert_arr['message']      = 'Wants to reschedule your consultation';
        $insert_arr['status']       = 'unread';
        $insert_arr['type']         = 'reschedule';

        $count = $this->NotificationModel->where('from_user_id', $this->user_id)
                                ->where('to_user_id', $patient_id)
                                ->where('booking_id',$booking_id)
                                ->where('type','reschedule')
                                ->count();
        if($count > 0 )
        {
          Session::flash('message', 'You have already requested to reschedule this consultation.');
        } 
        else
        {
            $res = $this->NotificationModel->create($insert_arr);

            if($res)
            {
                Session::flash('message', 'Reschedule request has been sent successfully');
            }
            else
            {
              Session::flash('message', 'Something went to wrong ! Please try again later');
            }
        }                               
        

        return redirect()->back();
    }*/ // end show_available_time



    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 12/10/2017
    | Output    : Success or Error
    */

    public function show_available_time(Request $request)
    {
        $selected_date = '';
        $arr_doc_time_slot = [];

        $patient_id     = $request->input('get_patient_id');
        $booking_id     = $request->input('get_booking_id');
        $doctor_id      = $this->user_id;

        if($patient_id != null && !empty($patient_id) && $booking_id != null && !empty($booking_id) )
        {
              $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                                          ->where('patient_user_id', $patient_id)
                                                                          ->with('patient_user_details')
                                                                          ->first();
              if($get_booking_data)
              {
                $booking_data = $get_booking_data->toArray();
                $selected_date = $booking_data['consultation_date'];

                $selected_date = date("Y-m-d");
              }

              $admin_fees_arr = $this->DoctroFeesModel->where('id','1')->first();      
              if($admin_fees_arr)
              {
                $this->arr_view_data['admin_fees_arr'] = $admin_fees_arr->toArray();
              }

              $time_interval = $this->DoctorTimeIntervalModel->select('time_interval')->first();
              if(isset($time_interval))
              {
                $this->arr_view_data['time_interval'] = $time_interval->time_interval;
                $time_var = $this->arr_view_data['time_interval'];
              }

              $current_datetime = convert_utc_to_userdatetime($this->user_id, "doctor", date("Y-m-d H:i:s"));
              $current_day = strtolower(date("D", strtotime($current_datetime)));

              $fees_arr = $this->DoctorFeeModel->where('doctor_id',$doctor_id)->where('day', $current_day)->get();
              if($fees_arr)
              {
                $this->arr_view_data['fees_arr'] = $fees_arr->toArray();
              }

              $get_highest_fees_arr = $this->DoctorFeeModel->where('doctor_id',$doctor_id)->orderBy('total_patient_fee_for_four_min', 'DESC')->first();
              if($get_highest_fees_arr)
              {
                $this->arr_view_data['highest_fees'] = $get_highest_fees_arr->toArray();
                $highest_fees = $this->arr_view_data['highest_fees'];
              }

              $get_time_rate = $this->DoctorFeeModel->where('doctor_id',$doctor_id)->where('day', $current_day)->orderBy('start_time', 'ASC')->get();
              if($get_time_rate)
              {
                $this->arr_view_data['time_rate'] = $get_time_rate->toArray();
                $time_rate = $this->arr_view_data['time_rate'];
              }

              $get_doctor = $this->AvailabilityModel->with(['user_details' => function($user){
                                                              $user->where('verification_status',1);
                                                              $user->where('deleted_status',0);
                                                              $user->where('user_status','Active');
                                                              $user->where('deleted_at',null);
                                                          }])
                                                    ->with('doctor_details')
                                                    ->where('user_id', $doctor_id)
                                                    ->where('date', '=', $selected_date)
                                                    ->orderBy('start_time','ASC')
                                                    ->get();
              if($get_doctor)
              {
                $this->arr_view_data['doctor_details'] = $get_doctor->toArray();

                $doc_availability = $this->arr_view_data['doctor_details'];

                foreach($doc_availability as $doc_avail)
                {
                  // convert doctor aviliable time
                  $start_time = convert_utc_to_userdatetime($this->user_id, "doctor", $doc_avail['start_time']);
                  $end_time = convert_utc_to_userdatetime($this->user_id, "doctor", $doc_avail['end_time']);

                  // get doctor current time
                  $current_time = convert_utc_to_userdatetime($this->user_id, "doctor", date("Y-m-d H:i:s"));

                  $time = $start_time;

                  $current_time = strtotime($current_time);

                  if (true)
                  {
                      $time = strtotime($start_time);

                      while ($time < strtotime($end_time)) 
                      {
                          if ($time > $current_time) 
                          {
                              foreach ($time_rate as $doc_fee)
                              {
                                  $fee_doc_start = convert_utc_to_userdatetime($this->user_id, "doctor", $doc_fee['start_time']);
                                  $fee_start = substr($fee_doc_start, 11);

                                  $fee_doc_end = convert_utc_to_userdatetime($this->user_id, "doctor", $doc_fee['end_time']);
                                  $fee_end = substr($fee_doc_end, 11);

                                  $current = date("Y-m-d H:i:s", $time);
                                  $doc_time_current = substr($current, 11);

                                  if(strtotime($doc_time_current) > strtotime($fee_start))
                                  {
                                      if(strtotime($doc_time_current) < strtotime($fee_end))
                                      {
                                          $doc_time_slot['time']              = date("Y-m-d H:i:s", $time);
                                          $doc_time_slot['dr_fee_per_min']    = $doc_fee['dr_fee_per_min'];
                                          $doc_time_slot['dr_fee_per_hr']     = $doc_fee['dr_fee_per_hr'];
                                          $doc_time_slot['earning_for_4_min'] = $doc_fee['earning_for_4_min'];
                                          $doc_time_slot['earning_per_min']   = $doc_fee['earning_per_min'];
                                          $doc_time_slot['doctoroo_fee']      = $doc_fee['doctoroo_fee'];
                                          $doc_time_slot['total_patient_fee_for_four_min'] = $doc_fee['total_patient_fee_for_four_min'];
                                          $doc_time_slot['total_patient_fee_of_additional_afer_four_min'] = $doc_fee['total_patient_fee_of_additional_afer_four_min'];

                                          $arr_doc_time_slot[] = $doc_time_slot;
                                      }
                                      /*else
                                      {
                                          $doc_time_slot['time']              = date("Y-m-d H:i:s", $time);
                                          $doc_time_slot['dr_fee_per_min']    = $highest_fees['dr_fee_per_min'];
                                          $doc_time_slot['dr_fee_per_hr']     = $highest_fees['dr_fee_per_hr'];
                                          $doc_time_slot['earning_for_4_min'] = $highest_fees['earning_for_4_min'];
                                          $doc_time_slot['earning_per_min']   = $highest_fees['earning_per_min'];
                                          $doc_time_slot['doctoroo_fee']      = $highest_fees['doctoroo_fee'];
                                          $doc_time_slot['total_patient_fee_for_four_min'] = $highest_fees['total_patient_fee_for_four_min'];
                                          $doc_time_slot['total_patient_fee_of_additional_afer_four_min'] = $highest_fees['total_patient_fee_of_additional_afer_four_min'];

                                          $arr_doc_time_slot[] = $doc_time_slot;
                                      }*/
                                  }
                              }
                          }
                          
                          $time = strtotime('+'.$time_var.' minutes', $time);
                      }
                  }
                }
              }
                
                $this->arr_view_data['doc_fee_time_slot'] = $arr_doc_time_slot;
                $this->arr_view_data['doctor_id']       = $this->user_id;
                $this->arr_view_data['booking_data']    = $booking_data;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                return view($this->module_view_folder.'.show_available_time')->with($this->arr_view_data);
        }
        else
        {
            return redirect()->back();
        }
        
    } // end show_available_time



    /*
    | Function  : get selected date and fetch data for that date
    | Author    : Deepak Arvind Salunke
    | Date      : 01/07/2017
    | Output    : show available time of the doctor for selected date
    */

    public function get_doctor_available_time(Request $request)
    {
      $get_date = $request->input('selected_date');

      $date = str_replace('/', '-', $get_date);
      $selected_date = date('Y-m-d', strtotime($date));

      $selected_datetime = convert_utc_to_userdatetime($this->user_id, "doctor", $selected_date);
      $selected_day = strtolower(date('D', strtotime($selected_datetime)));

      $doctor_id = $this->user_id;

      $time_interval = $this->DoctorTimeIntervalModel->select('time_interval')->first();

      if(isset($time_interval))
      {
        $time_interval = $time_interval->time_interval;
        $time_var = $time_interval;
      }
      else
      {
        $time_interval = '';
      }

      $get_highest_fees_arr = $this->DoctorFeeModel->where('doctor_id',$doctor_id)->orderBy('total_patient_fee_for_four_min', 'DESC')->first();
      if($get_highest_fees_arr)
      {
        $highest_fees = $get_highest_fees_arr->toArray();
      }

      $get_time_rate = $this->DoctorFeeModel->where('doctor_id',$doctor_id)->where('day', $selected_day)->orderBy('start_time', 'ASC')->get();
      if($get_time_rate)
      {
        $this->arr_view_data['time_rate'] = $get_time_rate->toArray();
        $time_rate = $this->arr_view_data['time_rate'];
      }
      
      $get_doctor = $this->AvailabilityModel->where('user_id', $doctor_id)
                                            ->where('date', $selected_date)
                                            //->orderBy('id','DESC')
                                            ->orderBy('start_time','ASC')
                                            ->get();
      if($get_doctor)
      {
        $doctor_details = $get_doctor->toArray();

        if(!empty($doctor_details))
        {

          $doc_availability = $doctor_details;

          foreach($doc_availability as $doc_avail)
          {
            // convert doctor aviliable time to patient timezone
            $start_time = convert_utc_to_userdatetime($this->user_id, "doctor", $doc_avail['start_time']);
            $end_time = convert_utc_to_userdatetime($this->user_id, "doctor", $doc_avail['end_time']);

            // get patient current time
            $current_time = convert_utc_to_userdatetime($this->user_id, "doctor", date("Y-m-d H:i:s"));

            $time = $start_time;

            $current_time = strtotime($current_time);

            if (true)
            {
                $time = strtotime($start_time);

                while ($time < strtotime($end_time)) 
                {
                    if ($time > $current_time) 
                    {
                        foreach ($time_rate as $doc_fee)
                        {
                            $fee_doc_start = convert_utc_to_userdatetime($this->user_id, "doctor", $doc_fee['start_time']);
                            $fee_start = substr($fee_doc_start, 11);

                            $fee_doc_end = convert_utc_to_userdatetime($this->user_id, "doctor", $doc_fee['end_time']);
                            $fee_end = substr($fee_doc_end, 11);

                            $current = date("Y-m-d H:i:s", $time);
                            $doc_time_current = substr($current, 11);

                            if(strtotime($doc_time_current) > strtotime($fee_start))
                            {
                                if(strtotime($doc_time_current) < strtotime($fee_end))
                                {
                                    echo '<li class="time circle">
                                        <a href="#requestbooking"
                                            class="valign-wrapper get_time" 
                                            data-doctor="'.$doctor_id.'"
                                            data-date="'.date('l d F, Y', strtotime($doctor_details['0']['date'])).'"
                                            data-time="'.date('h:i a', strtotime(date("Y-m-d H:i:s", $time))).'"
                                            doctor-rate="'.number_format($doc_fee['total_patient_fee_for_four_min'], 2, '.', '').'"
                                            doctor-rate_per_min="'.number_format($doc_fee['earning_per_min'], 2, '.', '').'"
                                            doctor-earning_for_4_min="'.number_format($doc_fee['earning_for_4_min'], 2, '.', '').'"><span>'.date('h:i', strtotime(date("Y-m-d H:i:s", $time))).'<small>'.date('a', strtotime(date("Y-m-d H:i:s", $time))).'</small></span>
                                        </a>
                                    </li>';
                                }
                                /*else
                                {
                                    $doc_time_slot['time']              = date("Y-m-d H:i:s", $time);
                                    $doc_time_slot['dr_fee_per_min']    = $highest_fees['dr_fee_per_min'];
                                    $doc_time_slot['dr_fee_per_hr']     = $highest_fees['dr_fee_per_hr'];
                                    $doc_time_slot['earning_for_4_min'] = $highest_fees['earning_for_4_min'];
                                    $doc_time_slot['earning_per_min']   = $highest_fees['earning_per_min'];
                                    $doc_time_slot['doctoroo_fee']      = $highest_fees['doctoroo_fee'];
                                    $doc_time_slot['total_patient_fee_for_four_min'] = $highest_fees['total_patient_fee_for_four_min'];
                                    $doc_time_slot['total_patient_fee_of_additional_afer_four_min'] = $highest_fees['total_patient_fee_of_additional_afer_four_min'];

                                    $arr_doc_time_slot[] = $doc_time_slot;
                                }*/
                            }
                        }
                    }
                    
                    $time = strtotime('+'.$time_var.' minutes', $time);
                }
            }
          }
        }
        else
        {
          echo '<p style="font-weight:bold;">Doctor is not Available</p>';
        }
      }
      else
      {
        echo '<p style="font-weight:bold;">Doctor is not Available</p>';
      }
      
    } // end get_doctor_available_time


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 12/10/2017
    | Output    : Success or Error
    */

    public function process_offer_time(Request $request)
    {
        
        $booking_id = $request->input('booking_id');
        $patient_id = $request->input('patient_id');

        $session_time     = $request->input('booking_time');
        $booking_date     = date("Y-m-d", strtotime(substr($session_time,10)));
        $booking_time     = date("H:i:s", strtotime(substr($session_time,0,8)));
        $booking_datetime = $booking_date.' '.$booking_time;
        $new_datetime     = date("Y-m-d H:i:s", strtotime($booking_datetime));

        $booking_time = convert_userdatetime_to_utc($this->user_id, "doctor", $new_datetime);
        $booking_time = convert_utc_to_userdatetime($patient_id, "patient", $booking_time);
        
        $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->first();
        if($get_booking_data)
        {
          $booking_data = $get_booking_data->toArray();
        }

        $insert_arr['from_user_id'] = $this->user_id;
        $insert_arr['to_user_id']   = $patient_id;
        $insert_arr['booking_id']   = $booking_id;
        $insert_arr['message']      = 'Wants to offer alternative time ie, '.$booking_time.' for consultation';
        $insert_arr['status']       = 'unread';
        $insert_arr['type']         = 'offer alternative time';

        $res = $this->NotificationModel->create($insert_arr);
        if($res)
        {
            Session::flash('offer_msg', 'Alternative time request has been sent successfully');
        }
        else
        {
          Session::flash('offer_msg', 'Something went to wrong ! Please try again later');
        }
        
        if($booking_data['booking_status'] == 'Pending')
        {
          return redirect(url('/').'/doctor/consultation/new_consultation_request');  
        }
        else
        {
          return redirect(url('/').'/doctor/consultation/decline_consultation');
        }
    } // end show_available_time

    /*
    | Function  : get selected date and fetch data for that date
    | Author    : Deepak Arvind Salunke
    | Date      : 25/10/2017
    | Output    : show available time of the doctor for selected date
    */

    public function get_doctor_available_time1(Request $request)
    {
      $get_date = $request->input('selected_date');

      $date = str_replace('/', '-', $get_date);
      $selected_date = date('Y-m-d', strtotime($date));

      $doctor_id = $this->user_id;

      $time_interval = $this->DoctorTimeIntervalModel->select('time_interval')->first();

      if(isset($time_interval))
      {
        $time_interval = $time_interval->time_interval;
      }
      else
      {
        $time_interval = '';
      }
      
      $get_doctor = $this->AvailabilityModel->where('user_id', $doctor_id)
                                            ->where('date', $selected_date)
                                            //->orderBy('id','DESC')
                                            ->orderBy('start_time','ASC')
                                            ->get();
      if($get_doctor)
      {
        $doctor_details = $get_doctor->toArray();

        if(!empty($doctor_details))
        {

          $html = "";

            foreach ($doctor_details as $doc_data) 
            {
              
              $current_time = strtotime(date("Y-m-d h:i a"));

              $sdate = date('Y-m-d h:i a', strtotime($doc_data['date'].' '.$doc_data['start_time']));
              $edate = date('Y-m-d h:i a', strtotime($doc_data['date'].' '.$doc_data['end_time']));

              $startTime = strtotime($sdate);
              $endTime   = strtotime($edate);

              $time = $startTime;

              if( $time > $current_time )
              {
                while ($time < $endTime) 
                {
                    $time = strtotime('+'.$time_interval.' minutes', $time);

                    $html.= '<li class="time circle"><a href="#requestbooking" class="valign-wrapper get_time" data-date="'.date('l d F, Y', strtotime($selected_date)).'" data-time="'.date('h:i a', $time).'" ><span>'.date('h:i', $time).'<small>'.date('a', $time).'</small></span></a></li>';
                }
              }

              else if( $time < $current_time )
              {
                $i = 0;

                while ($current_time < $endTime) 
                {
                    $time =  date('Y-m-d h:i a', strtotime('+ '.$time_interval.' minutes',$time));
                                        $time = strtotime($time);
                                        $current_time = strtotime('+'.$time_interval.' minutes', $time);                                        
                                        $cr_time = strtotime(date("Y-m-d h:i a"));
                    if($current_time > $cr_time)
                    {
                      if($i != 0)
                      {
                        $html.= '<li class="time circle"><a href="#requestbooking" class="valign-wrapper get_time" data-date="'.date('l d F, Y', strtotime($selected_date)).'" data-time="'.date('h:i a', $current_time).'" ><span>'.date('h:i', $current_time).'<small>'.date('a', $current_time).'</small></span></a></li>';
                      } 
                      $i++;
                    }                                        
                }
              }
            }

          echo $html;
        }
        else
        {
          echo '<p style="font-weight:bold;">Doctor is not Available</p>';
        }
      }
      else
      {
        echo '<p style="font-weight:bold;">Doctor is not Available</p>';
      }
      
    } // end get_doctor_available_time


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

      $get_booking_data = $this->PatientConsultationBookingModel->with('patient_info')->where('id', $consultation_id)->first();
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
        $notify['to_user_id']   = $booking_data['patient_user_id'];
        $notify['booking_id']   = $booking_data['id'];
        $notify['message']      = 'Consultation Update: '.$doctor_data['title'].' '.$doctor_data['first_name'].' '.$doctor_data['last_name'].' will be calling you in '.$update_time.' minutes. Please be ready in a quite, private area.';
        $notify['status']       = 'unread';
        
        $this->NotificationModel->insert($notify);

        // get mobile country code
        $get_mobile_code = $this->MobileCountryCodeModel->where('id', $booking_data['patient_info']['mobile_code'])->first();
        if($get_mobile_code)
        {
          $mobile_data = $get_mobile_code->toArray();
        }

        // send sms to patient
        $to       = '+'.$mobile_data['phonecode'].''.decrypt_value($booking_data['patient_info']['mobile_no']);
        $message  = 'Consultation Update: '.$doctor_data['title'].' '.$doctor_data['first_name'].' '.$doctor_data['last_name'].' will be calling you in '.$update_time.' minutes. Please be ready in a quite, private area.';

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

      $get_booking_data = $this->PatientConsultationBookingModel->with('patient_info')->where('id', $consultation_id)->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
      }

      $user = Sentinel::check();

      if($call_status == 'ready')      
      {
        $update['doctor_is_ready'] = 1;
        $status_message = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' is ready for call. He/She will be calling you in few minutes. Please be online for consultation to start.';
      }
      else if($call_status == 'busy')
      {
        $update['doctor_is_ready'] = 0;
        $status_message = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' is busy. He/She will notify his updates. As soon as he will be free.';
      }

      $update_booking_data = $this->PatientConsultationBookingModel->where('id', $consultation_id)->update($update);
      if($update_booking_data)
      {
        $get_doctor_data = $this->UserModel->with('doctor_details')->where('id', $user->id)->first();
        if($get_doctor_data)
        {
          $doctor_data = $get_doctor_data->toArray();
        }

        $notify['from_user_id'] = $this->user_id;
        $notify['to_user_id']   = $booking_data['patient_user_id'];
        $notify['booking_id']   = $consultation_id;
        $notify['message']      = $status_message;
        $notify['status']       = 'unread';
        
        $this->NotificationModel->insert($notify);

        // get mobile country code
        $get_mobile_code = $this->MobileCountryCodeModel->where('id', $booking_data['patient_info']['mobile_code'])->first();
        if($get_mobile_code)
        {
          $mobile_data = $get_mobile_code->toArray();
        }

        // send sms to patient
        $to       = '+'.$mobile_data['phonecode'].''.decrypt_value($booking_data['patient_info']['mobile_no']);
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


    public function start_video_call(Request $request)
    {
        $booking_id  = $request->input('booking_id');
        $call_status = $request->input('call_status');
        $doctor_id   = $this->user_id;
        $msg         = '';

        if($call_status == 'started')
        {
            $msg = 'Please join video call now.';
        }

        $user = Sentinel::check();
        $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->first();
        if($get_booking_data)
        {
            $booking_data = $get_booking_data->toArray();
            $patient_id = $booking_data['patient_user_id'];

            $get_patient_data = $this->UserModel->with('patientinfo')->where('id', $patient_id)->first();
            if($get_patient_data)
            {
              $patient_data = $get_patient_data->toArray();
            }

            $notify['from_user_id'] = $this->user_id;
            $notify['to_user_id']   = $booking_data['doctor_user_id'];
            $notify['booking_id']   = $booking_data['id'];
            $notify['message']      = 'Consultation Update: '.$user->title.' '.$user->first_name.' '.$user->last_name.' has '.$call_status.' the video call. '.$msg;
            $notify['status']       = 'unread';

            $this->NotificationModel->insert($notify);

            // get mobile country code
            $get_mobile_code = $this->MobileCountryCodeModel->where('id', $patient_data['patientinfo']['mobile_code'])->first();
            if($get_mobile_code)
            {
              $mobile_data = $get_mobile_code->toArray();
            }

            // send sms to patient
            $to       = '+'.$mobile_data['phonecode'].''.decrypt_value($patient_data['patientinfo']['mobile_no']);
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

            if(!empty($doctor_id) && isset($doctor_id))
            {
              $data['active_video_call'] = 'yes';
              $update_data = $this->UserModel->where('id', $doctor_id)->update($data);

              $booking_data['doctor_active_video_call'] = 'yes';
               $booking_data['patient_active_video_call'] = 'no';
              $update_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->update($booking_data);
            }
        }

    } // end start_video_call

   /* public function check_patient_active_video_call(Request $request)
    {
        $doctor_id  = $this->user_id;

        $get_booking_data = $this->PatientConsultationBookingModel->with('patient_user_details')->where('doctor_user_id', $doctor_id)->get();
        if($get_booking_data)
        {
            $booking_data = $get_booking_data->toArray();

            foreach($booking_data as $data)
            {
                if($data['patient_active_video_call'] == 'yes')
                {
                    $arr_json['msg']    =  'Consultation Update: '.$data['patient_user_details']['title'].' '.$data['patient_user_details']['first_name'].' '.$data['patient_user_details']['last_name'].' has started video call for the consultation '.$data['consultation_id'].'<br/><br/><a class="open_video_call accept-btn-green right btn green round-corner" data-doctor_id="'.base64_encode($data['doctor_user_id']).'" data-status="started" data-booking_id="'.base64_encode($data['id']).'" style="cursor: pointer;"><i class="material-icons">&#xE0B0;</i> Accept</a><div class="end-call-btn right btn red reject-btn-green round-corner"><a href="javascript:void(0);" onclick="reject_call('.$data['id'].')"><i class="material-icons">&#xE0B1;</i> Reject</a></div>';
                    return response()->json($arr_json);
                }
                
            }

        }

    }*/ // end check_patient_active_video_call


























    /*
        Rohini Jagtap
        10 april 2017
        description:get list of consultation listing according to status
    */
    public function index()
    {
         $arr_new_consult        = $arr_confirmed_consult = $arr_declined_consult = $arr_past_consult = [];

         $arr_past_consult       = $this->get_past_consultation_list();

         $arr_new_consult        = $this->get_patient_consultation_list('Pending');
         $arr_confirmed_consult  = $this->get_patient_consultation_list('Confirmed');
         $arr_declined_consult   = $this->get_patient_consultation_list('Declined');


         $this->arr_view_data['arr_past_consult']          = $arr_past_consult;
         $this->arr_view_data['arr_declined_consult']      = $arr_declined_consult;
         $this->arr_view_data['arr_new_consult']           = $arr_new_consult;
         $this->arr_view_data['arr_confirmed_consult']     = $arr_confirmed_consult;
         $this->arr_view_data['page_title']                = 'Consultation Listing';
         $this->arr_view_data['module_url_path']           = $this->module_url_path;
         $this->arr_view_data['module_consult_path']       = $this->module_booking_path;
        return view($this->module_view_folder.'.show',$this->arr_view_data);
    }

    /*
        Rohini Jagtap
        31 march 2017
        description:change patient booking status
    */
    
    public function change_booking_status($enc_id,$type)
    {
        $update_status = '';
        if(isset($enc_id) && $enc_id!="")
        {
            $booking_id  = base64_decode($enc_id);
            $obj_patient_booking = $this->PatientConsultationBookingModel->where('id','=',$booking_id)->first();
            $arr_patient_booking = $obj_patient_booking->toArray();

            if(isset($type) && $type=='confirm')
            {
                if(count($arr_patient_booking)>0)
                {
                    $errors = '';
                    $transaction = [
                        'Payment' => [
                            'TotalAmount' => $arr_patient_booking['consultation_charge'],
                        ],
                        'TransactionID' => $arr_patient_booking['eway_transaction_id'],
                    ];
                    $response = $this->client->createTransaction(\Eway\Rapid\Enum\ApiMethod::AUTHORISATION, $transaction);
                    
                    if (!$response->getErrors() && $response->TransactionStatus) 
                    {
                        $update_status = $this->PatientConsultationBookingModel->where('id','=',$booking_id)->update(['booking_status'=>'Confirmed']);
                    }
                    else
                    {
                        foreach ($response->getErrors() as $error) 
                        {
                            $errors .=  "Error: ".\Eway\Rapid::getMessage($error)."<br>";
                        }
                    
                        return redirect()->back()->withErrors($errors);
                    }
                }
            }
            else if(isset($type) && $type=='decline')
            {
                if(count($arr_patient_booking)>0)
                {
                    $response = $this->client->cancelTransaction($arr_patient_booking['eway_transaction_id']);
                    if (!$response->getErrors() && $response->TransactionStatus) 
                    {
                        $update_status = $this->PatientConsultationBookingModel->where('id','=',$booking_id)->update(['booking_status'=>'Declined']);
                    }
                    else
                    {
                        foreach ($response->getErrors() as $error) 
                        {
                            $errors .=  "Error: ".\Eway\Rapid::getMessage($error)."<br>";
                        }
                        return redirect()->back()->withErrors($errors);
                    }                    
                }
            }
            else if(isset($type) && $type=='cancel')
            {
                $update_status = $obj_patient_booking->update(['booking_status'=>'Cancelled']);
            }
            
        }
        if($update_status)
        {
            Flash::success('Booking status changed successfully.');
        }
        else
        {
            Flash::error('Error while changeing a status.');
        }
        return redirect()->back();
    }

     /*
        Rohini Jagtap
        31 march 2017
        description:show booking details
    */
    
    public function show_consultation_details($enc_id,$family_enc_id=false,$enc_status=false)
    {
         $arr_booking_details = $arr_availble_time  = $arr_time_slots = $arr_health_details = [];

         if(isset($enc_id) && $enc_id!="")
         {
             $id                   =  base64_decode($enc_id); 


             $arr_booking_details  =  $this->get_patient_consultation_details($id,$family_enc_id);

            /* get available time for doctor */
            if(isset($arr_booking_details) && sizeof($arr_booking_details)>0)
            {
               $arr_availble_time  =  $this->get_available_time($arr_booking_details['doctor_user_id']);

            }


         }
         if($enc_status!=false && $enc_status!="")
         {
            $status                                           = base64_decode($enc_status);
            $this->arr_view_data['status']                    = $status;
         }
         
         $this->arr_view_data['module_booking_path']          = $this->module_booking_path;

         $this->arr_view_data['doctor_base_img_path']         = $this->doctor_base_img_path;
         $this->arr_view_data['doctor_public_img_path']       = $this->doctor_public_img_path;

         $this->arr_view_data['health_issue_base_img_path']   = $this->health_issue_base_img_path;
         $this->arr_view_data['health_issue_public_img_path'] = $this->health_issue_public_img_path;

         $this->arr_view_data['prescription_base_img_path']   = $this->prescription_base_img_path;
         $this->arr_view_data['prescription_public_img_path'] = $this->prescription_public_img_path;

         $this->arr_view_data['arr_availble_time']            = $arr_availble_time;
         $this->arr_view_data['arr_booking_details']          = $arr_booking_details;
         $this->arr_view_data['page_title']                   = 'Consultation Details';
         $this->arr_view_data['module_url_path']              = $this->module_url_path;

        return view($this->module_view_folder.'.details',$this->arr_view_data);
    }

    public function get_patient_consultation_details($id,$family_enc_id=false)
    {

             if(isset($family_enc_id) && $family_enc_id!=false)
             {
                $familiy_member_id = base64_decode($family_enc_id);
             } 
             else
             {
                $familiy_member_id = 0;
             }

             $obj_booking_details  =  $this->PatientConsultationBookingModel->where('id',$id)
                                                        ->with(['patient_user_details'=>function($q){

                                                            $q->select('id','first_name','last_name','email');

                                                          },'doctor_user_details'=>function($q1){
                                                               
                                                            $q1->select('id','title','first_name','last_name','profile_image');
                                                          },
                                                         'patient_info','familiy_member_info',
                                                         'health_images'=>function($q2) use($familiy_member_id){
                                                            $q2->where('family_member_id','=',$familiy_member_id);
                                                         },'medical_question'=>function($q3) use($familiy_member_id){

                                                            $q3->where('family_member_id','=',$familiy_member_id);

                                                         },'health_precription'=>function($q4)use($familiy_member_id){

                                                            $q4->where('family_member_id','=',$familiy_member_id);
                                                         },'regular_doctor_info'])
                                                        ->first(); 
            if($obj_booking_details)
            {
               $arr_booking_details = $obj_booking_details->toArray();
            }  
            return $arr_booking_details;
           
    }
   
    
   /*
        Rohini Jagtap
        31 march 2017
        description:get doctor available time
    */
    public function get_available_time($doctor_user_id)
    {
        $arr_availble_time = [];

        $current_time      = '';
        $current_time      = date("H:i");
        $current_date      = date('Y-m-d');
        $obj_availability  = $this->AvailabilityModel->where('user_id',$doctor_user_id)
                                ->whereRaw('"'.$current_time.'" BETWEEN start_time and end_time') 
                                ->where('date','>=',$current_date)
                                ->orderBy('start_time','ASC')
                                ->get();

        if($obj_availability)
        {
            $arr_availble_time = $obj_availability->toArray();
  
        }
        return $arr_availble_time;
    }
    /*
        Rohini Jagtap
        31 march 2017
        description:change booking details & send notification to the patient
    */
    public function offer_another_time(Request $request)
    {
        $form_data  = $arr_json = $arr_booking = $arr_notification = [];
        $form_data  = $request->all(); 

        $id = base64_decode($form_data['booking_id']);

        if($form_data['booking_time']=="")
        {
            $arr_json['msg']    = "Please select time slot for booking.";
            $arr_json['status'] = "error"; 
        }
        else
        {
            $consultation_date_time               = $form_data['booking_date']." ".convert_12_to_24($form_data['booking_time']);
            $arr_booking['reschedule_date_time']  = $consultation_date_time;
            $arr_notification['from_user_id']     = $this->user_id;
            $arr_notification['to_user_id']       = base64_decode($form_data['patient_id']);
            $arr_notification['message']          = $form_data['message'];
            $arr_notification['booking_id']       = $id;

            $obj_consultation                     = $this->PatientConsultationBookingModel->where('id',$id)
                                                                                          ->first();

            $update_consultation                  = $obj_consultation->update($arr_booking);

            $notification_status                  = $this->NotificationModel->create($arr_notification);
            $notifiy_id                           = base64_encode($notification_status->id);
            $response = $this->send_notification_to_user($form_data['message'],$arr_notification['to_user_id'],$notifiy_id);

            if($update_consultation && $notification_status)
            {

                 $arr_json['msg']    = "Booking details updated successfully.";
                 $arr_json['status'] = "success"; 

            }
            else
            {
                 $arr_json['msg']    = "Error while updating booking.";
                 $arr_json['status'] = "error";
            }
        }
        return response()->json($arr_json);


        
    }
    /*
      Rohini jagtap
      10 april 2017
      desc:get patient consultation list
    */
    public function get_patient_consultation_list($status)
    {
        $arr_data       = [];
        $current_date   = date('Y-m-d');
        $obj_data       = $this->PatientConsultationBookingModel->where('doctor_user_id', $this->user_id)
                                                           ->where('booking_status',$status)
                                                           //->where('consultation_date','>=',$current_date)
                                                           ->with(['patient_user_details'=>function($q){

                                                                   $q->select('id','first_name','last_name');

                                                                },'familiy_member_info'=>function($qry){

                                                                   $qry->select('id','first_name','last_name');

                                                                }])
                                                            ->orderBy('id','asc')
                                                            ->get();

        if($obj_data)
        {
            $arr_data = $obj_data->toArray();
        }
        return $arr_data;
    }
    public function get_past_consultation_list()
    {
        $current_date = date('Y-m-d');
        $arr_data     = [];
        $obj_data      = $this->PatientConsultationBookingModel->where('doctor_user_id', $this->user_id)
                                                           //->where('consultation_date','<',$current_date)
                                                           ->where('booking_status','<>','Confirmed')
                                                           ->where('booking_status','<>','Declined')
                                                           ->with(['patient_user_details'=>function($q){

                                                                   $q->select('id','first_name','last_name');

                                                                },'familiy_member_info'=>function($qry){

                                                                   $qry->select('id','first_name','last_name');

                                                                }])
                                                           ->get();

        if($obj_data)
        {
            $arr_data = $obj_data->toArray();

        }
        return $arr_data;
    }
    public function download_precription($enc_id)
    {

        if(isset($enc_id) && $enc_id!='')
        {
             $booking_id = base64_decode($enc_id);
             $obj_precription = $this->PatientPrescriptionQuestionsModel->where('temp_booking_id','=',$booking_id)
                                                    ->select('current_prescription_upload')
                                                    ->first();
                if($obj_precription)
                {
                         $arr_precription    = $obj_precription->toArray();

                       if(isset($arr_precription['current_prescription_upload']) && $arr_precription['current_prescription_upload']!='')
                       {
                             $file_name         = $arr_precription['current_prescription_upload'];
                             $pathToFile        = $this->prescription_base_img_path.$file_name;

                             $file_exits        = file_exists($pathToFile);
                            if($file_exits)
                            {
                               //ob_end_clean(); //clear the buffer memory before download file
                               return response()->download($pathToFile,$file_name); 
                            }
                            else
                            {
                               Flash::error("Error while downloading an document.");
                            }
                             

                       }
                        
                          
                }      
        

        }  
        return redirect()->back();     
    }
    /*
        Rohini j
        date : 17 Apr 2017
        description:send push notification to user
    */
    public function send_notification_to_user($message,$user_id,$notification_id)
    {       
                $url = url('/').'/patient/notification/details/'.$notification_id;
                $content = array(
                    
                    "en" => $message
                );
                
                $fields = array(
                    'app_id' => "11df23bf-ba27-40dc-b05d-04d636487720",
                    'filters' => array(array("field" => "tag", "key" => "user_id", "relation" => "=", "value" =>$user_id)),
                    'url'     => $url,
                      'data' => array("foo" => "bar"),
                            'contents' => $content
                 );
                
                $fields = json_encode($fields);
              
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                           'Authorization: Basic NTg4OGU1NTQtMWEzOS00MGQzLTk2OWQtOWNhMDhlZjhkMGZh'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                $response = curl_exec($ch);
                curl_close($ch);
                
                return $response;
                   
    }
    public function past_consultation_update(Request $request)
    {
        $upd_res    = "";
        $delete_res = "";
        $ins_res    = "";
        //$consultation_notes = $request->consultation_notes;
        $consultation_notes = $request->enc_consultation_notes;

        $consultation_id = $request->consultation_id;
        $patient_user_id  = $request->patient_user_id;

        if(isset($request->delete_doc) && $request->delete_doc != '')
        {
          $delete_doc_ids = explode(',', $request->delete_doc);
          $delete_ids = array_filter($delete_doc_ids);

          $del_arr = $this->ConsultationDocumentsModel->whereIn('id', $delete_ids)->get();
          if(isset($del_arr) && !empty($del_arr))
          {
            $data_del = $del_arr->toArray();

            foreach($data_del as $val)
            {
                if(isset($val['document']) && !empty($val['document']) && File::exists($this->consultation_documents_public_url.$val['document']))
                  {
                    @unlink($this->consultation_documents_public_url.$val['document']);
                  }
            }

            $delete_res = $this->ConsultationDocumentsModel->whereIn('id' , $delete_ids)->delete();

          }
          
        }

        if(isset($request->delete_img) && $request->delete_img != '')
        {
          $delete_img_ids = explode(',', $request->delete_img);
          $delete_img = array_filter($delete_img_ids);

          $del_img_arr = $this->PatientConsultationImagesModel->whereIn('id', $delete_img)->get();
          if(isset($del_img_arr) && !empty($del_img_arr))
          {
            $data_img_del = $del_img_arr->toArray();

            foreach($data_img_del as $values)
            {
                if(isset($values['health_image']) && !empty($values['health_image']) && File::exists($this->patient_uploads_public_url.$values['health_image']))
                  {
                    @unlink($this->patient_uploads_public_url.$values['health_image']);
                  }
            }

            $delete_res = $this->PatientConsultationImagesModel->whereIn('id' , $delete_img)->delete();

          }
          
        }
              
        if($request->hasFile('consultation_document'))
        {
            $consultation_document   =   $request->file('consultation_document');


            if(isset($consultation_document) && sizeof($consultation_document)>0)
            {
              

              foreach($consultation_document as $file)
              {
                $extention  =   strtolower($file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('doc_error','Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                    //return redirect()->back()->withInput($request->all());
                }
                else if($file->getClientSize() > 5000000)
                {
                    Session::flash('doc_error','Please upload image with small size. Max size allowed is 5mb');
                    //return redirect()->back()->withInput($request->all());
                }
                else
                {
                    $document_name          = $file;
                    $document_file_ext      = strtolower($file->getClientOriginalExtension()); 
                    $doc_file_name      = sha1(uniqid().$document_name.uniqid()).'.'.$document_file_ext;
                    $doc_upload_result  = $file->move($this->consultation_documents_public_url, $doc_file_name);
                    if($doc_upload_result)
                    {
                      $upd_arr = array(
                        'consultation_id' => $consultation_id,
                        'patient_id'      => $patient_user_id,
                        'doctor_id'       => $this->user_id,
                        'document'        => $doc_file_name
                      );

                      $upd_res = $this->ConsultationDocumentsModel->create($upd_arr);  
                      
                    }
                    
                }
              }

            }
            else
            {
                Session::flash('id_proof_error','Please upload valid image/document.');
                //return redirect()->back()->withInput($request->all());
            }



        }

        if($request->hasFile('consultation_images'))
      {
          $medical_file   =   $request->file('consultation_images');
          if(isset($medical_file) && sizeof($medical_file)>0)
          {
              foreach($medical_file as $file)
              {
                $extention  =   strtolower($file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('medical_img_error','Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                    //return redirect()->back()->withInput($request->all());
                }
                else if($file->getClientSize() > 5000000)
                {
                    Session::flash('medical_img_error','Please upload image with small size. Max size allowed is 5mb');
                    //return redirect()->back()->withInput($request->all());
                }
                else
                {
                    $medical_name           = $file;
                    $medical_file_extension = strtolower($file->getClientOriginalExtension()); 
                    $medical_file_name      = sha1(uniqid().$medical_name.uniqid()).'.'.$medical_file_extension;
                    $medical_upload_result  = $file->move($this->profile_uploads_base_url, $medical_file_name);

                    $insert_arr = array(
                          'user_id'      => $patient_user_id,
                          'booking_id'   => $consultation_id,
                          'health_image' => $medical_file_name,
                      );
                    $ins_res = $this->PatientConsultationImagesModel->create($insert_arr);
                }
              }
          }
          else
          {
              Session::flash('medical_img_error','Please upload valid image.');
              //return redirect()->back()->withInput($request->all());
          }
      }

      $notes_arr = array(
              'consultation_id' => $consultation_id,
              'doctor_id'       => $this->user_id,
              'patient_id'      => $patient_user_id,
              'notes'           => $consultation_notes,
        );
      $count = $this->ConsultationNotesModel->where('consultation_id' ,$consultation_id)->count();

      if($count > 0)
      {
        $notes_res = $this->ConsultationNotesModel->where('consultation_id' ,$consultation_id)
                                                  ->update($notes_arr);    
      }
      else
      {
          $notes_res = $this->ConsultationNotesModel->create($notes_arr);
      }

       

        if($upd_res || $delete_res || $ins_res || $notes_res)
         {
            Session::flash('message','Consultation details updated successfully');
         }
         else
         {
            Session::flash('message','No Changes found'); 
         }

      //return redirect()->back();
    }
   
}
?>