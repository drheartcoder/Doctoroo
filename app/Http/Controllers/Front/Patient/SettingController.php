<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;
use Twilio\Rest\Client;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\FamilyMemberModel;
use App\Models\DoctorModel;
use App\Models\MyPharmacyModel;
use App\Models\PharmacyModel;
use App\Models\PharmacyInvitationModel;
use App\Models\EntitlementModel;
use App\Models\DoctorInvitationModel;
use App\Models\PaymentMethodsModel;
use App\Models\FaqCategoryModel;
use App\Models\FaqsModel;
use App\Models\ContactEnquiryModel;
use App\Models\StaticPagesModel;
use App\Models\FamilyDoctorsModel;
use App\Models\FeedbackModel;
use App\Models\NotificationSettingModel;
use App\Models\TimezonesModel;
use App\Models\TimezoneModel;
use App\Models\UserTimezonesModel;
use App\Models\UserEntitlementModel;
use App\Models\UserPreferencesModel;
use App\Models\ShareDiscountCodeModel;
use App\Models\ProfileAffectedAreaModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\PatientConsultationImagesModel;
use App\Models\MobileCountryCodeModel;
use App\Models\DisputeModel;
use App\Models\OtpModel;
use App\Models\DisputeResponseModel;
use App\Models\PatientConsultationPaymentModel;
use App\Models\PharmacyListModel;
use App\Models\NotificationModel;
use App\Models\AdminNotificationModel;

use Validator;
use Flash;
use Sentinel;
use Activation;
use Reminder;
use URL;
use Session;
use File;
use Mail;
use DB;
use Exception;

class SettingController extends Controller
{
    public function __construct(UserModel                         $user_model,
                                PatientModel                      $patient_model, 
                                EmailService                      $EmailService, 
                                FamilyMemberModel                 $family_member_model, 
                                DoctorModel                       $doctor_model,
                                MyPharmacyModel                   $my_pharmacy_model,
                                PharmacyModel                     $pharmacy_model,
                                PharmacyInvitationModel           $pharmacy_invt_model,
                                EntitlementModel                  $entitlement_model,
                                DoctorInvitationModel             $doctor_invt_model,
                                PaymentMethodsModel               $payment_methods_model,
                                FaqCategoryModel                  $faq_cat,
                                FaqsModel                         $faq_model,
                                ContactEnquiryModel               $contact_enquiry_model,
                                StaticPagesModel                  $StaticPagesModel,
                                FamilyDoctorsModel                $FamilyDoctorsModel,
                                FeedbackModel                     $FeedbackModel,
                                NotificationSettingModel          $NotificationSettingModel,
                                TimezonesModel                    $TimezonesModel,
                                TimezoneModel                     $TimezoneModel,
                                UserTimezonesModel                $UserTimezonesModel,
                                UserEntitlementModel              $UserEntitlementModel,
                                UserPreferencesModel              $UserPreferencesModel,
                                ShareDiscountCodeModel            $ShareDiscountCodeModel,
                                ProfileAffectedAreaModel          $ProfileAffectedAreaModel,
                                PatientConsultationBookingModel   $patient_booking,
                                PatientConsultationImagesModel    $consultation_image,
                                MobileCountryCodeModel            $mob_country_code,
                                DisputeModel                      $DisputeModel,
                                OtpModel                          $OtpModel,
                                DisputeResponseModel              $dispute_response_model,
                                PatientConsultationPaymentModel   $patient_consultation_payment_model,
                                NotificationModel                 $NotificationModel,
                                PharmacyListModel   			        $PharmacyListModel,
                                AdminNotificationModel            $AdminNotificationModel
                               )
    {
        $this->arr_view_data                        = [];
        $this->module_title                         = "Setting";
        $this->module_url_path                      = url('/').'/patient/setting';
        $this->module_view_folder                   = "front.patient.setting";
        $this->UserModel                            = $user_model;
        $this->PatientModel                         = $patient_model;
        $this->family_member_model                  = $family_member_model;
        $this->doctor_model                         = $doctor_model;
        $this->EmailService                         = $EmailService;
        $this->MyPharmacyModel                      = $my_pharmacy_model;
        $this->PharmacyModel                        = $pharmacy_model;
        $this->pharmacy_invt_model                  = $pharmacy_invt_model;
        $this->entitlement_model                    = $entitlement_model;
        $this->doctor_invt_model                    = $doctor_invt_model;
        $this->payment_methods_model                = $payment_methods_model;
        $this->FaqcatModel                          = $faq_cat;
        $this->faqModel                             = $faq_model; 
        $this->contact_enquiry_model                = $contact_enquiry_model;
        $this->StaticPagesModel                     = $StaticPagesModel;  
        $this->FamilyDoctorsModel                   = $FamilyDoctorsModel;
        $this->DoctorInvitationModel                = $doctor_invt_model;
        $this->FeedbackModel                        = $FeedbackModel;
        $this->NotSettingModel                      = $NotificationSettingModel;
        $this->TimezonesModel                       = $TimezonesModel;
        $this->TimezoneModel                        = $TimezoneModel;
        $this->UserTimezonesModel                   = $UserTimezonesModel; 
        $this->UserEntitlementModel                 = $UserEntitlementModel;
        $this->UserPreferencesModel                 = $UserPreferencesModel;
        $this->ShareDiscountCodeModel               = $ShareDiscountCodeModel;
        $this->ProfileAffectedAreaModel             = $ProfileAffectedAreaModel;
        $this->PatientConsultationBookingModel      = $patient_booking;
        $this->PatientConsultationImagesModel       = $consultation_image;
        $this->MobileCountryCodeModel               = $mob_country_code;
        $this->DisputeModel                         = $DisputeModel;
        $this->OtpModel                             = $OtpModel;
        $this->DisputeResponseModel                 = $dispute_response_model;
        $this->PatientConsultationPaymentModel      = $patient_consultation_payment_model;
        $this->PharmacyListModel      				      = $PharmacyListModel;
        $this->NotificationModel                    = $NotificationModel;
        $this->AdminNotificationModel               = $AdminNotificationModel;

        $this->arr_view_data                        = [];    
        $this->profile_img_base_path                = public_path().config('app.project.img_path.patient');
        $this->profile_img_public_path              = url('/public').config('app.project.img_path.patient');
        $this->patient_uploads_url                  = public_path().config('app.project.img_path.patient_uploads');
        $this->patient_uploads_base_url             = url('/public').config('app.project.img_path.patient_uploads');

        $user                                       = Sentinel::check();
        $this->user_id                              = '';
        if($user != false)
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

        $this->sid                                  = config('services.twilio')['accountSid'];
        $this->token                                = config('services.twilio')['auth_token'];
        $this->service_id                           = config('services.twilio')['service_id'];
        $this->client                               = new Client($this->sid,$this->token);
    }

    /*--------------------------------------------------------------------------
                                    Settings page
    -----------------------------------------------------------------------------*/

    public function settings()
    {
      $this->arr_view_data['page_title']            = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']       = $this->module_url_path;
      return view($this->module_view_folder.'.setting',$this->arr_view_data);
    }

        /*--------------------------------------------------------------------------
                                     Patient profile details
        -----------------------------------------------------------------------------*/

    public function personal_details()
    {
        $arr_personal_details = [];

        $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                                ->with('patientinfo','patientinfo.timezone_data')
                                                ->get();
      
        if($obj_personal_details)
        {
           $arr_personal_details = $obj_personal_details->toArray();
        }

        $entitlement_arr = $this->entitlement_model->get()->toArray();

        $affected_area_img = $this->ProfileAffectedAreaModel->where('patient_id' , $this->user_id)
                                                            ->get();

        if($affected_area_img)
        {
          $this->arr_view_data['affected_area_img_arr'] = $affected_area_img->toArray();      
        }

        $get_mob_code = $this->MobileCountryCodeModel->where('id', $arr_personal_details['0']['patientinfo']['mobile_code'])->first();
        if($get_mob_code)
        {
            $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
        }


         $entitle_arr = $this->UserEntitlementModel->where('user_id' , $this->user_id)
                                                   ->with('user_entitlement')
                                                ->get();

        if($entitle_arr)
        {
          $this->arr_view_data['user_entitlement_arr'] = $entitle_arr->toArray();
        }                                                 

        //For International timezone 
        /*$get_timezone = $this->TimezonesModel->get();
        if($get_timezone)
        {
            $this->arr_view_data['timezone_data'] = $get_timezone->toArray();
        }*/

        //For australia timezone
        $get_timezone = $this->TimezoneModel->get();
        if($get_timezone)
        {
            $this->arr_view_data['timezone_data'] = $get_timezone->toArray();
        }

        $usertimezone_arr = $this->UserTimezonesModel->where('user_id',$this->user_id)->first();
        if($usertimezone_arr)
        {
          $this->arr_view_data['user_timezone'] = $usertimezone_arr->toArray();
        }
         
        $this->arr_view_data['patient_uploads_url']       = $this->patient_uploads_url;
        $this->arr_view_data['patient_uploads_base_url']  = $this->patient_uploads_base_url;
        $this->arr_view_data['profile_img_public_path']   = $this->profile_img_public_path;
        $this->arr_view_data['profile_img_base_path']     = $this->profile_img_base_path;
        $this->arr_view_data['arr_personal_details']      = $arr_personal_details;
        $this->arr_view_data['page_title']                = str_singular($this->module_title);
        $this->arr_view_data['entitlement']               = $entitlement_arr;
        $this->arr_view_data['module_url_path']           = $this->module_url_path;


      return view($this->module_view_folder.'.personal_details',$this->arr_view_data);
    }

        /*--------------------------------------------------------------------------
                                     Patient profile edit 
        -----------------------------------------------------------------------------*/


    public function edit_personal_details()
    {
      $arr_personal_details = [];

      $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                              ->with('patientinfo')->get();
       
      if($obj_personal_details)
      {
         $arr_personal_details = $obj_personal_details->toArray();
      }

      $entitlement_arr=$this->entitlement_model->get()->toArray();

      $affected_area_img = $this->ProfileAffectedAreaModel->where('patient_id' , $this->user_id)
                                                            ->get();
      if($affected_area_img)
      {
        $this->arr_view_data['affected_area_img_arr'] = $affected_area_img->toArray();      
      }

      $get_mob_code = $this->MobileCountryCodeModel->get();
      if($get_mob_code)
      {
          $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
      }

       $entitle_arr = $this->UserEntitlementModel->where('user_id' , $this->user_id)
                                                   ->with('user_entitlement')
                                                ->get();

      if($entitle_arr)
      {
        $this->arr_view_data['user_entitlement_arr'] = $entitle_arr->toArray();
      }

      //For International timezone 
      /*$get_timezone = $this->TimezonesModel->get();
      if($get_timezone)
      {
          $this->arr_view_data['timezone_data'] = $get_timezone->toArray();
      }*/

      //For australia timezone
      $get_timezone = $this->TimezoneModel->get();
      if($get_timezone)
      {
          $this->arr_view_data['timezone_data'] = $get_timezone->toArray();
      }

      $usertimezone_arr = $this->UserTimezonesModel->where('user_id',$this->user_id)->first();
      if($usertimezone_arr)
      {
        $this->arr_view_data['user_timezone'] = $usertimezone_arr->toArray();
      }
      
      $this->arr_view_data['patient_uploads_url']       = $this->patient_uploads_url;
      $this->arr_view_data['patient_uploads_base_url']  = $this->patient_uploads_base_url;
      $this->arr_view_data['profile_img_base_path']     = $this->profile_img_base_path;
      $this->arr_view_data['profile_img_public_path']   = $this->profile_img_public_path;
      $this->arr_view_data['arr_personal_details']      = $arr_personal_details;
      $this->arr_view_data['entitlement']               = $entitlement_arr;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.edit_personal_details',$this->arr_view_data);
    }

       /*--------------------------------------------------------------------------
                                     Patient profile update
        -----------------------------------------------------------------------------*/

    public function store(Request $request)
    {  
      $medical_file   =   $request->file('affected_area');

      $arr_rules['first_name']          = "required";
      $arr_rules['last_name']           = "required";
      $arr_rules['edit_mobile_no_code'] = "required";
      $arr_rules['mobile_no']           = "required";
      $arr_rules['address']             = "required";
      $arr_rules['timezone']            = "required";

      /* encryption fields */
      /*$arr_rules['enc_first_name']      = "required";
      $arr_rules['enc_last_name']       = "required";*/
      //$arr_rules['enc_mobile_no']       = "required";
      $arr_rules['enc_address']         = "required";
      
      $validator = Validator::make($request->all(),$arr_rules);

      if($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput($request->all());
      }

      $date1 = strtr($request->dob, '/', '-');
      $date=date('Y-m-d', strtotime($date1)); 
       
      $obj_data = $this->UserModel->where('id',$this->user_id)->first(['id','profile_image']);

      $data_affect = $this->PatientModel->where('user_id',$this->user_id)->first(['id','affected_area']);

      if($obj_data)
      {
        $arr_data = $obj_data->toArray(); 
      }

      if($data_affect)
      {
        $arr_affect = $data_affect->toArray();   
      }

      $file_name = $arr_data['profile_image'];
        
      if($request->hasFile('profile_image'))
      { 
        $fileExtension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 

        $arr_file_types = ['jpg','jpeg','png','bmp'];

          if(in_array($fileExtension, $arr_file_types) )
          {
            if(isset($arr_data) && sizeof($arr_data)>0)
            {
              if(File::exists($this->profile_img_base_path.$arr_data['profile_image']))
              {              
                @unlink($this->profile_img_base_path.$arr_data['profile_image']);
              } 
            }

            $file_name      = $request->input('profile_image');
            $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
            $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
            $request->file('profile_image')->move($this->profile_img_base_path, $file_name);
          } 
          else 
          {
            Session::flash('msg','Please upload valid image with jpg, jpeg ,png extension');
            return redirect()->back();
          }  
      }

      $data['first_name']     = ucwords(strtolower($request->input('first_name')));
      $data['last_name']      = ucwords(strtolower($request->input('last_name')));

      $data['profile_image']  = $file_name;

      $user_data = $this->UserModel->where('id',$this->user_id)->update($data);

      $data1['phone_no']       = $request->input('enc_contact_no');
      $data1['mobile_no']      = encrypt_value($request->input('mobile_no'));
      $data1['mobile_code']    = $request->input('edit_mobile_no_code');
      $data1['suburb']         = $request->input('enc_address');
      $data1['date_of_birth']  = $date;
      $data1['gender']         = $request->edit_gender;
      $data1['timezone']       = $request->input('timezone');

      $user_data = $this->PatientModel->where('user_id',$this->user_id)->update($data1);
      if($user_data)
      {   
        Session::flash('msg','Profile Updated Successfully.');
        return redirect()->back();
      }
      else
      { 
        Session::flash('msg','Problem Occured While Updating Profile.');
        return redirect()->back();
      }
      
    }

     /*--------------------------------------------------------------------------
                                     Patient Family members list
        -----------------------------------------------------------------------------*/

    public function family_members(Request $request)
    {

      $arr_personal_details = [];

      $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                              ->with('patientinfo')
                                              ->get();
    
      if($obj_personal_details)
      {
         $arr_personal_details = $obj_personal_details->toArray();
      }

       $family_members = $this->family_member_model->where([
            ['user_id', '=', $this->user_id],
            ['relationship', '<>', 'myself'],
            ['member_status','=','link']
        ])->orderBy('id','desc')->get();

       $this->arr_view_data['profile_img_public_path']  = $this->profile_img_public_path;  
       $this->arr_view_data['page_title']               = str_singular($this->module_title);      
       $this->arr_view_data['family_members']           = $family_members;
       $this->arr_view_data['arr_personal_details']     = $arr_personal_details;
       $this->arr_view_data['module_url_path']          = $this->module_url_path;
       $this->arr_view_data['multipleArray']            = array($this->arr_view_data);

       return view($this->module_view_folder.'.family_member')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                     ADD NEW MEMBER
        -----------------------------------------------------------------------------*/

    public function family_members_add(Request $request)
    {
      Session::forget('inserted_family_member_id');

/*      $date1 = strtr($request->input('datebirth'), '/', '-');
      $date  = date('Y-m-d', strtotime($date1)); 
      dd($request->all());*/
      $data['user_id']        = $this->user_id;
      $data['relationship']   = $request->user_relation;
      $data['first_name']     = $request->firstname;
      $data['last_name']      = $request->lastname;
      $data['gender']         = $request->gender;
      $data['email']          = $request->email;
      $data['mobile_number']  = $request->contact_no;
      $data['date_of_birth']  = $request->datebirth;
      $data['member_status']  = 'link';

      $insert_data = $this->family_member_model->create($data);
      if($insert_data)
      {
        $msg    = "Family Member Added Successfully";
        $status = 'success';
        Session::put('inserted_family_member_id', $insert_data->id);
      }
      else
      {
        $msg    = "Something went to wrong";
        $status = 'error';
      }

      $data = array('status'=>$status,'msg'=>$msg);

      return response()->json($data);
    }

    /*--------------------------------------------------------------------------
                                     FAMILY MEMBER DETAILS AND EDIT
        -----------------------------------------------------------------------------*/

    public function family_members_view(Request $request)
    {
      $family_members=$this->family_member_model->where([
            ['id', '=', $request->id]
        ])->get();

      if($family_members)
      {
        $family_details = $family_members->toArray();
      }
      return response()->json(['response'=>$family_details]); 
    }

    public function family_members_edit(Request $request)
    {
        /*$date1 = strtr($request->datebirth, '/', '-');
        $date=date('Y-m-d', strtotime($date1));*/
        $data=[
                'first_name'    => $request->firstname,
                'last_name'     => $request->lastname,
                'relationship'  => $request->user_relation,
                'email'         => $request->member_email,
                'mobile_number' => $request->contact_no,
                'date_of_birth' => $request->datebirth,
                'gender'        => $request->gender
              ];

        $res = $this->family_member_model->where('id',$request->member_id)->update($data);
        if($res)
        {
          $msg    = "Family Member Updated Successfully";
          $status = 'success';
        }
        else
        {
          $msg    = "Something went to wrong";
          $status = 'error';
        }

        $data = array('status'=>$status,'msg'=>$msg);

        return response()->json($data);
    }

    /*--------------------------------------------------------------------------
                                     DELETE FAMILY MEMBER
        -----------------------------------------------------------------------------*/

    public function family_members_delete(Request $request)
    { 
        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

       if(!empty($request->member_id))
       {
          
          $count = $this->PatientConsultationBookingModel->where('family_member_id',$request->member_id)
                                                          ->where('consultation_datetime', '>=', $current_datetime)
                                                          ->where(function ($query) {
                                                                $query->where('booking_status', 'Pending')
                                                                      ->orWhere('booking_status', 'Confirmed');
                                                            })
                                                         ->count();
                                                                    
          if($count > 0 )
          {
              $msg = "You can't delete this member, consultation has been booked for this member. You may delete this member after consultation or cancel consultation and delete";
              $status = 'error';
               $data = array('status'=>$status,'msg'=>$msg);
          } 
          else
          {
              $patient_uploads_url = $this->patient_uploads_url;

              $data = $this->PatientConsultationImagesModel->where('family_member_id' ,$request->member_id)
                                                  ->get();

              if(isset($data) && !empty($data))
              {
                $data_arr = $data->toArray();
                foreach($data_arr as $val )
                {
                  if(isset($val['health_image']) && !empty($val['health_image']) && File::exists($patient_uploads_url.$val['health_image']))
                  {
                    @unlink($patient_uploads_url.$val['health_image']);
                  }
                }
              }

              $this->PatientConsultationImagesModel->where('family_member_id' ,$request->member_id)
                                                   ->delete();
                                                   
              $this->PatientConsultationBookingModel->where('family_member_id' ,$request->member_id)
                                                    ->delete();

              $delete = $this->family_member_model->destroy($request->member_id);

              if($delete)
              {
                $msg    = "Family Member Deleted Successfully";
                $status = 'success';
                $data = array('status'=>$status,'msg'=>$msg);
                return response()->json($data);
              }
              else
              {
                $msg    = "Something went to wrong";
                $status = 'error';
                $data = array('status'=>$status,'msg'=>$msg);
                
              }
          }
          return response()->json($data);                                               
       }
    }

      /*--------------------------------------------------------------------------
                                     UNLINK FAMILY MEMBER FORM
        -----------------------------------------------------------------------------*/
    public function family_members_unlink($member_id)
    {
      $arr_personal_details = [];

      $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                              ->with('patientinfo')->get();
       
      if($obj_personal_details)
      {
         $arr_personal_details = $obj_personal_details->toArray();
      }

      $members=$this->family_member_model->where([
            ['id', '=', base64_decode($member_id)]
        ])->get();

      if(!empty($members))
      {
        $member_array=$members->toArray();
      }

      $this->arr_view_data['profile_img_public_path'] = $this->profile_img_public_path;
      $this->arr_view_data['module_url_path']         = $this->module_url_path;
      $this->arr_view_data['member_data']             = $member_array;
      $this->arr_view_data['arr_personal_details']    = $arr_personal_details;
      $this->arr_view_data['multipleArray']           = $this->arr_view_data;

      return view($this->module_view_folder.'.family_member_unlink',$this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                     FAMILY MEMBER UNLINK - SEND MAIL
    ----------------------------------------------------------------------------*/

    public function family_members_unlink_mail(Request $request)
    {
        /*$member_first_name = $member_last_name = $sender_first_name = $sender_last_name = '';

        if($request->input('member_first_name')!='' && $request->input('member_last_name')!='' && $request->input('sender_first_name')!='' && $request->input('sender_last_name')!='')
        {
            $member_first_name = $request->input('member_first_name'); 
            $member_last_name  = $request->input('member_last_name');
            $sender_first_name  = $request->input('sender_first_name');
            $sender_last_name  = $request->input('sender_last_name');
        }*/

        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

       if(!empty($request->member_id))
       {
          
          $count = $this->PatientConsultationBookingModel->where('family_member_id',$request->member_id)
                                                          ->where('consultation_datetime', '>=', $current_datetime)
                                                          ->where(function ($query) {
                                                                $query->where('booking_status', 'Pending')
                                                                      ->orWhere('booking_status', 'Confirmed');
                                                            })
                                                         ->count();
                                                                    
          if($count > 0 )
          {
              $msg = "You can't unlink this member, consultation has been booked for this member. You may unlink this member after consultation or cancel consultation and unlink";
              

              $arr_response['status']='error';
              $arr_response['msg']= $msg;
          }
          else
          {
              $this->module_path=url('');
      
              $from_mail="";
              
              $res=$this->UserModel->where('id',$this->user_id)->first();

              if($res)
              {
                $user_arr=$res->toArray();
                $from_mail=$user_arr['email'];
              }
           
              $member=$this->family_member_model->where('id',$request->member_id)->first();
              if($member)
              {
                $member_arr=$member->toArray();
              }
              
              $this->arr_view_data['module_url_path']= $this->module_url_path;
              $this->arr_view_data['user_arr']=$user_arr;
              $this->arr_view_data['member_mail']=$request->email;
              $this->arr_view_data['member_arr']=$member_arr;

              $this->arr_view_data['multipleArray']=$this->arr_view_data;

              $arr_data['first_name']     =   "";
              $arr_data['last_name']      =   "";
              $arr_data['email']          =   $request->email;
              $arr_data['password']       =   "";
              $arr_data['user_status']    =   'Active';

              $sender_fname="";
              $sender_lname="";

              if(!empty($user_arr['first_name']))
              {
                $sender_fname=$user_arr['first_name'];
              }

              if(!empty($user_arr['last_name']))
              {
                $sender_lname=$user_arr['last_name'];
              }

              $unlink_link="<a class='btn_emailer_cls' href='".$this->module_path."/member_unlink_confirmation/".base64_encode($member_arr['id'])."/".base64_encode($request->email)."'>Unlink Account</a>";

              $arr_built_content = [ 
                                      'MEMBER'=>  $member_arr['first_name'].' '.$member_arr['last_name'] , 
                                      'APP_NAME'  =>config('app.project.name'),
                                      'SENDER'    =>$sender_fname.' '.$sender_lname,
                                      'ACTIVATION_LINK'=>'my_link',
                                      'UNLINK'    =>$unlink_link
                                   ];

              $arr_mail_data                      = [];
              $arr_mail_data['email_template_id'] = '40';
              $arr_mail_data['arr_built_content'] = $arr_built_content;
              $arr_mail_data['user']              = $arr_data;
              $mail_status  = $this->EmailService->send_mail($arr_mail_data);

              if($mail_status)
              {
                  $arr_response['status']='success';
                  $arr_response['msg']='Successfully Sent!';
              }
              else
              {
                $arr_response['status']='error';
                $arr_response['msg']='Something went to wrong !';
              }
          }
      }

      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
               FAMILY MEMBER UNLINK CONFIRMATION(CREATE PATIENT FROM MEMBER)
    ---------------------------------------------------------------------------*/

    public function member_unlink_confirmation($member_id,$mail)
    {
      $mail=base64_decode($mail);

      $obj = new UserModel;
      $this->arr_view_data['module_url_path']= $this->module_url_path;

      $user_exist = $obj::where('email',$mail)->count();
      
      if($user_exist == 0)
      {  
        $member = $this->family_member_model->where('id',base64_decode($member_id))->first();

        if(!empty($member))
          {
              $member_arr=$member->toArray();

              $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
              $charactersLength = strlen($characters);
              $randomString = '';
              for ($i = 0; $i < 10; $i++) {
                  $randomString .= $characters[rand(0, $charactersLength - 1)];
              }

              $obj->first_name = $member_arr['first_name'];
              $obj->last_name = $member_arr['last_name'];
              $obj->email = $mail;
              $obj->profile_image = $member_arr['profile_img'];
              $obj->is_invited = $randomString;
              $obj->user_status ='Active';
              $user = $obj->save();
              $insertedId = $obj->id;

              $arr_data['first_name']     =   $member_arr['first_name'];
              $arr_data['last_name']      =   $member_arr['last_name'];
              $arr_data['email']          =   $mail;
              $arr_data['password']       =   "123456";
              $arr_data['user_status']    =   'Active';
              $arr_data['is_invited']     =   $randomString;
        
              $referred_by['user_id'] = '';
        
             if($user)
              {
                if($member_arr['gender']=='Male')
                {
                    $gender='M';
                }
                else
                {
                  $gender='F';
                }

                $patient_data['user_id']                = $insertedId;
                $patient_data['country']                = "Australia";
                $patient_data['state']                  = "";
                $patient_data['mobile_no']              = encrypt_value($member_arr['mobile_number']);
                $patient_data['gender']                 = $gender;
                $patient_data['date_of_birth']          = $member_arr['date_of_birth'];
                $patient_data['referred_by']            = "";
                $patient_data['my_referral_code']       = $randomString;
                $patient_data['friend_referral_code']   = "";

                $user  =  Sentinel::findById($insertedId);
                $role  =  Sentinel::findRoleBySlug('patient');
                $user->roles()->attach($role);

                // create user for twilio chat
                $create_user = $this->create_user($user->first_name.''.$user->last_name.''.$user->id);

                $activation =   Activation::create($user);
                $activation_code    =   $activation->code;

                $this->family_member_model->where('id',base64_decode($member_id))
                ->update(['member_status'=>'unlink']);

                $res_patient = $this->PatientModel->create($patient_data);
                if($res_patient)
                {
                    $admin_notif['message'] = "Patient - New Registration - Family Member unlink - ".$member_arr['first_name'].' '.$member_arr['last_name'];
                    $this->AdminNotificationModel->create($admin_notif);

                    $activation_link    ='<a class="btn_emailer_cls" href="'.url('/patient/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
                    $arr_built_content = [ 
                                        'FIRST_NAME'=>$member_arr['first_name'] , 
                                        'APP_NAME'  =>config('app.project.name'),
                                        'ACTIVATION_LINK'=>$activation_link,
                                         ];         

                  $status='create'; 
                  $this->module_path=url('');
                  $Password_set_link="<a class='btn_emailer_cls' href='".$this->module_path."/set_account_details/".base64_encode($insertedId)."'>Set Account Details</a>";

                  $arr_data['first_name']     =   "dd";
                  $arr_data['last_name']      =   "ss";
                  $arr_data['email']          =   $mail;
                  $arr_data['password']       =   "123456";
                  $arr_data['user_status']    =   'Active';

                    $arr_built_content = [ 
                                        'MEMBER'=>  $member_arr['first_name'].' '.$member_arr['last_name'] , 
                                        'APP_NAME'  =>config('app.project.name'),
                                        'PASSWORDSET'    => $Password_set_link,
                                        'ACTIVATION_LINK'=>'my_link',
                                         ];

                    $arr_mail_data                      = [];
                    $arr_mail_data['email_template_id'] = '41';
                    $arr_mail_data['arr_built_content'] = $arr_built_content;
                    $arr_mail_data['user']              = $arr_data;
                    $email_status  = $this->EmailService->send_mail($arr_mail_data);
                }
                else
                {
                   $status='error';      
                }
              }
          }
      }
      else
      {
        $status='already_exist';
      }

      $this->arr_view_data['module_url_path']= $this->module_url_path;
      $this->arr_view_data['status']=$status;
      $this->arr_view_data['multipleArray']=$this->arr_view_data;

      return view('front.patient.setting.unlink_confirmation',$this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                   MEMBER PASSWORD FORM  
     ---------------------------------------------------------------------------*/

    public function set_account_details($id)
    {
      $password=$this->UserModel->where('id',base64_decode($id))->select('password')->first();

      if(isset($password['password']) && $password['password']!='')
      {
        $password_status="already_set";
      }
      else
      {
        $password_status="not_set";
      }

      $get_mob_code = $this->MobileCountryCodeModel->get();
      if($get_mob_code)
      {
          $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
      }

     $this->arr_view_data['password_status']  = $password_status;
     $this->arr_view_data['module_url_path']  = $this->module_url_path;
     $this->arr_view_data['module_path']      = url('');
     $this->arr_view_data['user_id']          = $id;
     $this->arr_view_data['multipleArray']    = $this->arr_view_data;
     return view('front.patient.setting.set_account',$this->arr_view_data);
    }
            /*--------------------------------------------------------------------------
                                  MEMBER PASSWORD SET 
            ---------------------------------------------------------------------------*/

    public function account_details_set(Request $request)
    {

      $mobile_no_code = $request->mobile_no_code;
      $mobile_no = $request->mobile_no;

       $user_id = base64_decode($request->user_id);

       $count = $this->PatientModel->where('mobile_no' ,$mobile_no)
                                  ->count();
      if($count == 0)
      {
         $user_arr = $this->UserModel->where('id',$user_id)
                                  ->select('email')  
                                  ->first();
          $email = "";
          if($user_arr)
          {
              $email = $user_arr->toArray();
              $email = $user_arr['email'];
          }                                  
                                          

          $user_details['patientinfo']['mobile_code'] = $mobile_no_code;
          $user_details['patientinfo']['mobile_no']   = $mobile_no;
          $user_details['id']                         = $user_id;
          $user_details['email'] = $email;

            $otp= rand(100000, 999999);
            $otp_id = $this->send_otp($otp,$user_details);
            
            if($otp_id !='0')
            {
                $upd_arr['mobile_code'] = $mobile_no_code;
                $upd_arr['mobile_no']   = $mobile_no;  

                $mobile_details_res = $this->PatientModel->where('user_id' , $user_id)
                                                         ->update($upd_arr);

                if($mobile_details_res)
                {
                    $res = $this->UserModel->where('id',base64_decode($request->user_id))
                                ->update(['password'=>bcrypt($request->password)]);
                    if($res)
                    {
                      $return_arr['status']='success';
                      $return_arr['msg']="Password set successfully ! Please Login to access your account";
                      $return_arr['otp_id']   =  $otp_id;
                      $return_arr['password'] =  base64_encode($request->password);
                      $return_arr['email']    =  $email;
                    }
                    else
                    {
                      $return_arr['status']='error';
                      $return_arr['msg']="Something went to wrong";
                      $return_arr['otp_id']   =  '';
                    }                            
                }                               

            }
            else
            {
                $return_arr['otp_id']   =  '0';
                $return_arr['status'] = 'mob_error';
                $return_arr['msg'] = 'Invalid entered mobile number and country code';
            }
      }                            
      else
      {
        $return_arr['status'] = 'error';
        $return_arr['msg'] = 'This mobile number is already registered ! try another';
      }
          return response()->json($return_arr);
    }

    /*--------------------------------------------------------------------------
                                  FAMILY DOCTORS LIST DISPLAY 
    ---------------------------------------------------------------------------*/

    public function family_doctors()
    {
      $arr_personal_details = [];

      $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                              ->with('patientinfo')
                                              ->get();
    
      if($obj_personal_details)
      {
         $arr_personal_details = $obj_personal_details->toArray();
      }

      $family_doctors = $this->FamilyDoctorsModel->where([['user_id',$this->user_id],['status','link']])->orderBy('id','desc')->get()->toArray();
                
       $this->arr_view_data['profile_img_public_path']  = $this->profile_img_public_path;  
       $this->arr_view_data['page_title']               = str_singular($this->module_title);      
       $this->arr_view_data['family_doctors']           = $family_doctors;
       $this->arr_view_data['arr_personal_details']     = $arr_personal_details;
       $this->arr_view_data['module_url_path']          = $this->module_url_path;
       $this->arr_view_data['multipleArray']            = array($this->arr_view_data);

       return view($this->module_view_folder.'.family_doctor')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                  FAMILY DOCTOR ADD PAGE 
     ---------------------------------------------------------------------------*/

    public function family_doctors_add()
    {
      $arr_personal_details = [];

      $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                              ->with('patientinfo')
                                              ->get();
    
      if($obj_personal_details)
      {
         $arr_personal_details = $obj_personal_details->toArray();
      }

      $this->arr_view_data['arr_personal_details']     = $arr_personal_details;
      $this->arr_view_data['profile_img_public_path']  = $this->profile_img_public_path;
      $this->arr_view_data['page_title']               = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']          = $this->module_url_path;
      $this->arr_view_data['multipleArray']            = array($this->arr_view_data);

      return view($this->module_view_folder.'.doctor_add')->with($this->arr_view_data);       
    }

    /*--------------------------------------------------------------------------
                                  FAMILY DOCTOR ADD DATA
    ---------------------------------------------------------------------------*/

    public function add_doctor(Request $request)
    {
      if($request->action=='check_mail')
      {

        $num    =   $this->FamilyDoctorsModel->where([
                                                      ['user_id',$this->user_id],
                                                      ['email',$request->email],
                                                      ['status','link']
                                                    ])->count();
        if($num>0)
        {
          $arr_response['msg']="This doctor's Email id is already registered with your account.";
        }
        else
        {
          $arr_response['msg']='not_exist';
        }
        return response()->json($arr_response);
        exit();
      }
      else if($request->action=='search_dr')
      {
        $search_txt=$request->search_txt;

        $data_arr=DB::table('users')
                  ->join('role_users','users.id','=','role_users.user_id')
                  ->where([
                            ['role_users.role_id','2'],
                            ['users.first_name','LIKE','%'.$search_txt.'%']
                      ])->orderBy('users.first_name' , 'ASC')
                  ->take(10)
                  ->get();
        
        return response()->json(['response'=>$data_arr]);
        exit();
      }
      else if($request->action=='search_dr_by_lname')
      {
        $search_txt=$request->search_txt;

        $data_arr=DB::table('users')
                  ->join('role_users','users.id','=','role_users.user_id')
                  ->where([
                            ['role_users.role_id','2'],
                            ['users.last_name','LIKE','%'.$search_txt.'%']
                      ])->orderBy('users.last_name' , 'ASC')
                  ->take(10)
                  ->get();                                

        return response()->json(['response'=>$data_arr]);
        exit();
      }
      else if($request->action=='select_doctor')
      {
        $res=DB::table('users')
        ->join('dod_doctor','users.id','=','dod_doctor.user_id')
        ->select('users.*','dod_doctor.*')
        ->where('users.id',$request->user_id)->get();
        return response()->json(['response'=>$res]);
        exit();
      }

      if($request->mail_action=='send')
      {
        $invite_doctor_status = 'yes';
      }
      else
      {
        $invite_doctor_status = 'no'; 
      }

      $this->FamilyDoctorsModel->user_id=$this->user_id;
      $this->FamilyDoctorsModel->first_name=$request->fname;
      $this->FamilyDoctorsModel->last_name=$request->lname;
      $this->FamilyDoctorsModel->phone_no=$request->phone_no;
      $this->FamilyDoctorsModel->mobile_no=$request->enc_mob_no;
      $this->FamilyDoctorsModel->email=$request->dr_mail;
      $this->FamilyDoctorsModel->practice_name=$request->pract_name;
      $this->FamilyDoctorsModel->practice_address=$request->enc_pract_addr;
      $this->FamilyDoctorsModel->consultation_details=$request->consultation;
      $this->FamilyDoctorsModel->status='link';
      $this->FamilyDoctorsModel->invitation=  $invite_doctor_status;

      $status=$this->FamilyDoctorsModel->save();

      if($status && $request->mail_action=='send')
	    {
	      $this->module_path=url('');
	      $link="<a class='btn_emailer_cls' href='".url('')."/doctor"."'>Accept Invitation</a>";

	      $arr_built_content = [ 
	                          'MEMBER'            =>  $request->fname.' '.$request->lname , /* REceiver name */ 
	                          'APP_NAME'          =>  config('app.project.name'),
	                          'SENDER'            =>  'SENDER NAME',                
	                          'ACCEPT'            =>   $link
	                           ];

	                           $arr_data['first_name']     =   $request->fname;
	                            $arr_data['last_name']     =   $request->lname;
	                            $arr_data['email']         =   $request->dr_mail;
	                                
	      $arr_mail_data                      = [];
	      $arr_mail_data['email_template_id'] = '42';
	      $arr_mail_data['arr_built_content'] = $arr_built_content;
	      $arr_mail_data['user']              = $arr_data;
	      $mail_status  = $this->EmailService->send_mail($arr_mail_data);       
	    }

      if($status)
      {
        $this->DoctorInvitationModel->user_id=$this->user_id;
        $this->DoctorInvitationModel->first_name=$request->fname;
        $this->DoctorInvitationModel->last_name=$request->lname;
        $this->DoctorInvitationModel->phone=$request->mob_no;
        $this->DoctorInvitationModel->email=$request->dr_mail;
        $this->DoctorInvitationModel->practice_name=$request->pract_name;
        $this->DoctorInvitationModel->address=$request->pract_addr;
        $this->DoctorInvitationModel->save();

        $arr_response['status'] = 'success';
        $arr_response['msg']    = 'Family Doctor added successfully';
      }
      else
      {
        $arr_response['status'] = 'error';
        $arr_response['msg']    = 'Something went to wrong'; 
      } 
      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                                  DISPLAY EMAIL AND PASSWORD
 ---------------------------------------------------------------------------*/

    public function email_and_password()
    {
      $user_arr=$this->UserModel->where([
            ['id', '=', $this->user_id]
        ])->get();
      
      $this->arr_view_data['user_arr']              = $user_arr;  
      $this->arr_view_data['page_title']            = str_singular($this->module_title);      
      $this->arr_view_data['module_url_path']       = $this->module_url_path;
      $this->arr_view_data['multipleArray']         = array($this->arr_view_data);

      return view($this->module_view_folder.'.password_email')->with($this->arr_view_data);
    }

 /*--------------------------------------------------------------------------
                                  PASSWORD RESET FORM 
 ---------------------------------------------------------------------------*/

    public function password_reset()
    {
          $this->arr_view_data['module_url_path']       = $this->module_url_path;
          $this->arr_view_data['multipleArray']         = array($this->arr_view_data);

          return view($this->module_view_folder.'.password-reset')->with($this->arr_view_data);
    }
    /*--------------------------------------------------------------------------
                                  PASSWORD RESET DATA 
    ---------------------------------------------------------------------------*/
    public function password_reset_data(Request $request)
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
            $arr_response['msg']='Password updated successfully';
          }
          else
          {
            $arr_response['msg']='Something went to wrong';
          }
        }
        return response()->json($arr_response);
    }


    /*
    | Function  : Get all the pharmacy which are added to my pharmacy list by the user
    | Author    : Deepak Arvind Salunke
    | Date      : 11/07/2017
    | Output    : Show list of pharmacy
    */

    public function my_pharmacy()
    {
      $get_pharmacy_list = $this->MyPharmacyModel->where('patient_id', $this->user_id)
                                                 ->orderBy('id','desc')
                                                 /*->with(['pharmacy_user_details' => function($user) {
                                                        $user->where('user_status', 'Active');
                                                        $user->where('verification_status', '1');
                                                        $user->where('deleted_at', null);
                                                 }])
                                                 ->with('pharmacy_details')*/
                                                 ->with('pharmacy_list')
                                                 ->get();
      if($get_pharmacy_list)
      {
        $this->arr_view_data['pharmacy_data'] = $get_pharmacy_list->toArray();
      }
      
      $entitlement_arr = $this->entitlement_model->get()->toArray();

      $user_entitlement=$this->UserPreferencesModel->where('user_id',$this->user_id)
                                                   ->select(['entitlement_id','card_no','brand'])
                                                   ->first();                                    

      

      if($user_entitlement)
      {
        $user_entitlement_arr=$user_entitlement->toArray();
        $this->arr_view_data['user_entitlement_arr']    = $user_entitlement_arr;
      }

      $this->arr_view_data['entitlement']               = $entitlement_arr;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.my_pharmacy',$this->arr_view_data);
    } 

    // end my_pharmacy

    /*
    | Function  : Delete selected Pharmacy from my list
    | Author    : Deepak Arvind Salunke
    | Date      : 11/07/2017
    | Output    : Success or Error msg
    */

    public function delete_my_pharmacy(Request $request)
    {
      $my_pharmacy_id = base64_decode($request->pharmacy_id);

      $del_pharmacy = $this->MyPharmacyModel->where('id', $my_pharmacy_id)->delete();

      if($del_pharmacy)
      {
        $msg    = "Pharmacy Deleted Successfully";
        $status = 'success';
        $data = array('status'=>$status,'msg'=>$msg);
        return response()->json($data);
      }
      else
      {
        $msg    = "Problem Occured While Deleting Pharmacy";
        $status = 'error';
        $data = array('status'=>$status,'msg'=>$msg);
        return response()->json($data);
      }
    } // end delete_my_pharmacy


    /*--------------------------------------------------------------------------
                                  DOCTOR EDIT FORM 
    ---------------------------------------------------------------------------*/

    public function edit_doctor($enc_id)
    {
      $arr_personal_details = [];

      $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                              ->with('patientinfo')
                                              ->get();
    
      if($obj_personal_details)
      {
         $arr_personal_details = $obj_personal_details->toArray();
      }

      $family_doctor =$this->FamilyDoctorsModel->where('id',base64_decode($enc_id))->first();

      $this->arr_view_data['arr_personal_details']  = $arr_personal_details;
      $this->arr_view_data['family_doctor']         = $family_doctor;
      $this->arr_view_data['module_url_path']       = $this->module_url_path;
      $this->arr_view_data['multipleArray']         = array($this->arr_view_data);
      
      return view($this->module_view_folder.'.doctor_edit')->with($this->arr_view_data);
    }
    /*--------------------------------------------------------------------------
                                  DOCTOR EDIT DATA 
    ---------------------------------------------------------------------------*/
    public function edit_doctor_data(Request $request)
    {
        if($request->mail_action  == 'send')
        {
          $invite_doctor_status = 'yes';
        }
        else
        {
          $invite_doctor_status = 'no';
        }
        $doctor_data['first_name']                     =   $request->fname;
        $doctor_data['last_name']                      =   $request->lname;
        $doctor_data['phone_no']                       =   $request->phone_no;
        $doctor_data['practice_name']                  =   $request->pract_name;
        $doctor_data['practice_address']               =   $request->pract_addr;
        $doctor_data['mobile_no']                      =   $request->mob_no;
        $doctor_data['consultation_details']           =   $request->consultation;
        $doctor_data['invitation']                     =   $invite_doctor_status;

        $res=$this->FamilyDoctorsModel->where('id',$request->doctor_id)
                                      ->update($doctor_data);
        if($res)
        {
          $arr_response['status'] = 'success';
          $arr_response['msg']    = "Doctor's details updated successfully";
        }
        else
        {
          $arr_response['status'] = 'error';
          $arr_response['msg']    = 'Something went to wrong or no changes found !';
        }

        if($request->mail_action=='send')
        {
            $this->module_path=url('');
            $link="<a class='btn_emailer_cls' href='".url('')."/doctor"."'>Accept Invitation</a>";

            $arr_built_content = [ 
                                  'MEMBER'            =>  $request->fname.' '.$request->lname , 
                                  'APP_NAME'          =>  config('app.project.name'),
                                  'SENDER'            =>  'SENDER NAME',                
                                  'ACCEPT'            =>   $link
                                   ];

           $arr_data['first_name']    =   $request->fname;
           $arr_data['last_name']     =   $request->lname;
           $arr_data['email']         =   $request->dr_mail;
                                    
           $arr_mail_data                      = [];
           $arr_mail_data['email_template_id'] = '42';
           $arr_mail_data['arr_built_content'] = $arr_built_content;
           $arr_mail_data['user']              = $arr_data;
           $mail_status  = $this->EmailService->send_mail($arr_mail_data);       
        }

        return response()->json($arr_response);

    }
    /*--------------------------------------------------------------------------
                                  DOCTOR INFO IN DETAILS 
    ---------------------------------------------------------------------------*/
    public function family_doctors_view($enc_id)
    {
      $arr_personal_details = [];

      $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                              ->with('patientinfo')
                                              ->get();
    
      if($obj_personal_details)
      {
         $arr_personal_details = $obj_personal_details->toArray();
      }

      $family_doctor=$this->FamilyDoctorsModel->where('id',base64_decode($enc_id))->first();

      $this->arr_view_data['family_doctor']         = $family_doctor;
      $this->arr_view_data['arr_personal_details']  = $arr_personal_details;
      $this->arr_view_data['module_url_path']       = $this->module_url_path;
      $this->arr_view_data['multipleArray']         = array($this->arr_view_data);

      return view($this->module_view_folder.'.doctor_view')->with($this->arr_view_data);
    }


    /*
    | Function  : Get all the pharmacy data
    | Author    : Deepak Arvind Salunke
    | Date      : 12/07/2017
    | Output    : Success or Error
    */

    public function add_pharmacy()
    {
      /*$get_pharmacy_list = $this->PharmacyModel->whereHas('userinfo' , function($user) {
                                                        $user->where('user_status', 'Active');
                                                        $user->where('verification_status', '1');
                                                        $user->where('deleted_at', null);
                                                })
                                                ->with('userinfo')
                                                ->paginate(10);*/

      $get_pharmacy_list = $this->PharmacyListModel->orderBy('company_name', 'ASC')->paginate(10);

      if($get_pharmacy_list)
      {
        $paginate = clone $get_pharmacy_list;
        $pharmacy_data = $get_pharmacy_list->toArray();

        $this->arr_view_data['pharmacy_data'] = $pharmacy_data;
        $this->arr_view_data['paginate']      = $paginate;
      }

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.add_pharmacy',$this->arr_view_data);
    } // end add_pharmacy


    /*--------------------------------------------------------------------------
                                  SEARCH PHARMACY 
    ---------------------------------------------------------------------------*/

    public function search_pharmacy(Request $request)
    {
      $suburb = $request->input('txt_search');
      if(is_numeric($suburb))
      {
          $search_pharmacies = $this->PharmacyListModel->orderBy('company_name', 'ASC')
                                                       ->where('code','like','%'.$suburb.'%')
                                                       ->paginate(10);
      }
      else
      {
          $search_pharmacies = $this->PharmacyListModel->orderBy('company_name', 'ASC')
                                                       ->where('suburb','like','%'.$suburb.'%') 
                                                       ->paginate(10);
      }
    
      if($search_pharmacies)
      {
        $this->arr_view_data['pharmacy_data']  = $search_pharmacies->toArray();
        $this->arr_view_data['paginate']       = clone $search_pharmacies;
        $this->arr_view_data['search_keyword'] = $suburb;
      }

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.add_search_pharmacy',$this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                  ADD PHARMACY DATA 
    ---------------------------------------------------------------------------*/
    public function add_pharmacy_data(Request $request)
    {
       $num    =   $this->MyPharmacyModel->where([
                                                  ['patient_id','=',$this->user_id],
                                                  ['pharmacy_id','=',$request->pharmacy_id]
                                                  ]
                                                )
                                                  ->count();

       if($num==0)
       {
          $this->MyPharmacyModel->patient_id=$this->user_id;
        $this->MyPharmacyModel->pharmacy_id=$request->pharmacy_id;

        $res=$this->MyPharmacyModel->save();
        if($res)
        {
          $arr_response['msg']='Pharmacy Added successfully';
        }
        else
        {
         $arr_response['msg']='Something went to wrong, Please try again'; 
        }
       }
       else
       {
        $arr_response['msg']='Pharmacy is already added';
       }

       return response()->json($arr_response);        
        
    }

    /*--------------------------------------------------------------------------
                                  INVITE PHARMACY TO JOIN 
    ---------------------------------------------------------------------------*/

    public function invite_pharmacy()
    {
       $this->arr_view_data['module_url_path']       = $this->module_url_path;
       $this->arr_view_data['multipleArray']         = array($this->arr_view_data);
       return view($this->module_view_folder.'.invite_pharmacy')->with($this->arr_view_data);
    }

/*--------------------------------------------------------------------------
                            INVITE PHARMACY DATA STORE 
---------------------------------------------------------------------------*/

    public function invite_pharmacy_data(Request $request)
    {
      $this->pharmacy_invt_model->user_id=$this->user_id;
      $this->pharmacy_invt_model->pharmacy_name=$request->pharmacy_name;
      $this->pharmacy_invt_model->pharmacy_no=$request->pharmacy_no;
      $this->pharmacy_invt_model->contact_person=$request->person_name;
      $this->pharmacy_invt_model->email=$request->pharmacy_mail;

      $res=$this->pharmacy_invt_model->save();
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
                            FAMILY DOCTOR DELETE / UNLINK 
    ---------------------------------------------------------------------------*/

    public function family_doctor_delete_unlink(Request $request)
    {
      // set referral_by (patient_id) null so that this record will not display in patien's family doctors list.
      $res = $this->doctor_model->where('id',$request->doctor_id)->update(['referral_by'=>'']);
             $this->FamilyDoctorsModel->where('id',$request->doctor_id)->update(['status'=>'unlink']);

      if($request->action=='delete')
      {
        $return_arr['msg']='Doctor deleted successfully';
        return response()->json($return_arr);  
      }
      else if($request->action=='unlink')
      {
        $return_arr['msg']= "Doctor unlink successfully";
        return response()->json($return_arr);  
      } 
      else
      {
        $return_arr['msg']='Something went to wrong';
        return response()->json($return_arr);  
      }
     
    }

    /*--------------------------------------------------------------------------
                            INVITATION PAGE
     ---------------------------------------------------------------------------*/
    public function invitation()
    {
      $refererral_code = "";
      $ref_code=$this->PatientModel->where('user_id',$this->user_id)->select('my_referral_code')->first()->toArray();
      if(!empty($ref_code))
      {
        $refererral_code=$ref_code['my_referral_code'];
      }      

      $refererral_url=url('/').'/ICareForYou/'.$refererral_code;  
      $this->arr_view_data['refererral_code']       = $refererral_code; 
      $this->arr_view_data['refererral_url']        = $refererral_url;
      $this->arr_view_data['module_url_path']       = $this->module_url_path;
      $this->arr_view_data['multipleArray']         = array($this->arr_view_data);

      return view($this->module_view_folder.'.invitation')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                            SENT INVITATION TO DOCTOR
     ---------------------------------------------------------------------------*/

    public function invite_doctor(Request $request)
    {
        $this->doctor_invt_model->user_id=$this->user_id;
        $this->doctor_invt_model->first_name=$request->first_name;
        $this->doctor_invt_model->last_name=$request->last_name;
        $this->doctor_invt_model->phone=$request->phone_no;
        $this->doctor_invt_model->email=$request->email_id;
        $this->doctor_invt_model->practice_name=$request->practice_name;
        $this->doctor_invt_model->address=$request->practice_addr;

        $res=$this->doctor_invt_model->save();
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
                            CHECK EMAIL IS REGISTERED OR NOT
---------------------------------------------------------------------------*/

    public function check_mail(Request $request)
    {
       $num    =   $this->UserModel->where('email',$request->email_id)->count();
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

    public function check_member_mail(Request $request)
    {
     $num    =   $this->family_member_model->where('email',$request->email_id)
                                           ->where('member_status','link')
                                            ->count();
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
                            PAYMENT METHOD PAGE.
---------------------------------------------------------------------------*/

    public function payment_method_settings()
    {

      $payment_methods = $this->payment_methods_model->where('user_id',$this->user_id)
                                                   ->orderBy('id','desc')
                                                   ->get()
                                                   ->toArray();

      $this->arr_view_data['payment_methods']       =  $payment_methods;
      $this->arr_view_data['module_url_path']       =  $this->module_url_path;
      $this->arr_view_data['payment_methods']       =  $payment_methods;
      $this->arr_view_data['multipleArray']         =  array($this->arr_view_data);

      return view($this->module_view_folder.'.payment_method')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                            PAYMENT METHOD - ADD DATA
    ---------------------------------------------------------------------------*/
    public function payment_method(Request $request)
    {
      $date=$request->card_expiry_date;

      $arr_data['user_id'] = $this->user_id;
      $arr_data['card_no'] = $request->card_no;
      $arr_data['card_type'] = $request->card_type;
      $arr_data['card_expiry_date'] = $date;
      $arr_data['cvv'] = $request->cvv;

      $last_inserted_id = $this->payment_methods_model->insertGetId($arr_data);

      if($last_inserted_id)
      {
        Session::set('last_payment_method_id' ,$last_inserted_id);

        $arr_response['msg']= "Payment method added successfully !";
      }
      else
      {
        $arr_response['msg']="Something went to wrong";
      }
      return response()->json($arr_response);
    }


    /*--------------------------------------------------------------------------
                                    PAYMENT METHOD VIEW / EDIT DETAILS PAGE
    -----------------------------------------------------------------------------*/

    public function payment_method_details(Request $request)
    {
      $payment_method=$this->payment_methods_model->where('id',$request->id)->first()->toArray();
        
        return response()->json($payment_method);
    }


    /*--------------------------------------------------------------------------
                                    PAYMENT METHOD - EDIT DATA
    -----------------------------------------------------------------------------*/

    public function payment_method_edit(Request $request)
    {
      $date=$request->card_expiry_date;
    
      $res=$this->payment_methods_model->where('id',$request->pay_meth_id)
                                       ->update(['card_no'=>$request->card_no,'card_type'=>$request->card_type,'card_expiry_date'=>$date,'cvv'=>$request->cvv]);

      if($res)
      {
        $arr_response['msg']="Payment method updated successfully";
      }
      else
      {
       $arr_response['msg']="Something went to wrong or No changes found";
      }

      return response()->json($arr_response);
    }


    /*--------------------------------------------------------------------------
                                    PAYMENT METHOD - DELETE 
    -----------------------------------------------------------------------------*/

    public function payment_method_remove(Request $request)
    {
      if($request->remove_id!='')
      {
        $res=$this->payment_methods_model->destroy($request->remove_id);
          if($res)
          {
            $arr_response['msg']="Payment method deleted successfully";
          }
          else
          {
           $arr_response['msg']="Something went to wrong"; 
          }
      }

      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                                    FAQ - CATEGORIES DISPLAY 
    -----------------------------------------------------------------------------*/

    public function faq_categories()
    {
        $faq_cats_arr=$this->FaqcatModel->where('belongs_to','patient')->orderBy('id','desc')->get()->toArray();

        $this->arr_view_data['module_url_path']       = $this->module_url_path;
        $this->arr_view_data['faq_cats_arr']          = $faq_cats_arr;
        return view($this->module_view_folder.'.faq')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                    FAQ 
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

      return view($this->module_view_folder.'.faq_settings')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                    FAQ - SEARCH 
    -----------------------------------------------------------------------------*/

    public function search_faq(Request $request)
    {  
      $faq_arr = $this->faqModel->whereHas('faq_catgeory', function($faq_cat){
                                        $faq_cat->where('belongs_to','patient');
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
       
       $user_arr  = $this->UserModel->with('patientinfo')
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
      if(!empty($user_arr['patientinfo']['mobile_no']))
      {
        $phone_no=$user_arr['patientinfo']['mobile_no'];
      }
      
      $this->contact_enquiry_model->user_id=$this->user_id;
      $this->contact_enquiry_model->name=$name.' '.$lname;
      $this->contact_enquiry_model->phone_no=$phone_no;
      $this->contact_enquiry_model->email=$user_arr['email'];
      $this->contact_enquiry_model->user_id=$this->user_id;
      $this->contact_enquiry_model->message=$request->msg;

      $res=$this->contact_enquiry_model->save();

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
                                                                      ['id','22']
                                                                      
                                                                    ])->get()->toArray();



      $this->arr_view_data['data_arr']              =  $data_arr;
      $this->arr_view_data['module_url_path']       =  $this->module_url_path;
      return view($this->module_view_folder.'.legal')->with($this->arr_view_data);
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

      return view($this->module_view_folder.'.dynamic_pages')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                    NOTIFICATION SETTING PAGE 
    -----------------------------------------------------------------------------*/
    public function notification_settings()
    {
      $notification_arr=$this->NotSettingModel->where('user_id',$this->user_id)->get()->toArray();

      $timezone_arr=$this->TimezonesModel->get()->toArray();

      $usertimezone_arr=$this->UserTimezonesModel->where('user_id',$this->user_id)->first();      

      if(!empty($usertimezone_arr))
      {
        $user_timezone=$usertimezone_arr['timezone_id'];
        $this->arr_view_data['user_timezone_id']     =  $user_timezone;       
      }

      $payment_methods=$this->payment_methods_model->where('user_id',$this->user_id)->get()->toArray();
      
      $this->arr_view_data['payment_methods']  =  $payment_methods;       
      $this->arr_view_data['timezone_arr']     =  $timezone_arr;       
      $this->arr_view_data['notification_arr'] =  $notification_arr;
      $this->arr_view_data['module_url_path']  =  $this->module_url_path;
      
      return view($this->module_view_folder.'.notification_settings')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                    FEEDBACK PAGE 
    -----------------------------------------------------------------------------*/

    public function feedback()
    {
      $this->arr_view_data['module_url_path']       =  $this->module_url_path;
      return view($this->module_view_folder.'.feedback')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                    FEEDBACK - STORE 
    -----------------------------------------------------------------------------*/
    public function feedback_store(Request $request)
    {
      $this->FeedbackModel->user_id=$this->user_id;
      $this->FeedbackModel->feedback=$request->feedback;
      $this->FeedbackModel->rating=$request->rating;

      $res=$this->FeedbackModel->save();

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

    /*--------------------------------------------------------------------------
                    NOTIFICATION - STORE TO DB
    -----------------------------------------------------------------------------*/
    public function notification_store(Request $request)
    {
       $notification_arr=array(
            'notification_email' => $request->email_notification,
            'email_consultation' => $request->email_consultation,
            'email_orders'       => $request->email_orders,
            'email_newsletter'   => $request->email_newsletter,
            'msg_notification' => $request->msg_notification,
            'msg_consultation' => $request->msg_consultation,
            'msg_orders' => $request->msg_orders,
            'msg_newsletter' => $request->msg_newsletter,
            'app_notification' => $request->app_notification,
            'app_consultation' => $request->app_consultation,
            'app_orders' => $request->app_orders,
            'app_newsletter' => $request->app_newsletter,
        );

        $num    =   $this->NotSettingModel->where('user_id',$this->user_id)->count();

        if($num>0)
        {
         foreach( $notification_arr as $key => $val)
           {
              if(isset($key) && !empty($val))
              {
               $res=DB::table('dod_notification_settting')
                ->where(['user_id'  =>  $this->user_id, 'notification' => $key ])
                ->update(['status'=>$val]); 
              }   
           }
              $arr_response['msg']="Notification setting saved successfully";      
        }
        else
        {
           foreach( $notification_arr as $key => $val)
           {
            if(isset($key) && !empty($val))
            {
             $res=DB::table('dod_notification_settting')
              ->insert(['user_id'=>$this->user_id,'notification'=>$key,'status'=>$val]); 
            }   
           }

           if($res)
           {
            $arr_response['msg'] = "Notification setting saved successfully";
           }
           else
           {
            $arr_response['msg'] ="Something went to wrong";
           } 
        }

        $count   =   $this->UserTimezonesModel->where('user_id',$this->user_id)->count();

        if($count>0)
        {
         $this->UserTimezonesModel->where('user_id',$this->user_id)
         ->update(['timezone'=>$request->user_timezone,'timezone_id'=>$request->user_timezone_id]);               
        }
        else
        {
          
          $this->UserTimezonesModel->user_id=$this->user_id;
          $this->UserTimezonesModel->timezone=$request->user_timezone;
          $this->UserTimezonesModel->timezone_id=$request->user_timezone_id;
          $this->UserTimezonesModel->save();
        }

        return response()->json($arr_response);     
    }

      /*--------------------------------------------------------------------------
                    INVOICE AND CODES - PAGE
      -----------------------------------------------------------------------------*/
      public function invoice()
      {
        $coupon_details = $this->ShareDiscountCodeModel->with('coupondetails','doctorinfo')
                                                       ->where('patient_id',$this->user_id)
                                                       ->orderBy('created_at','DESC')
                                                       ->get();
        if($coupon_details)
        {
          $this->arr_view_data['coupon_arr'] = $coupon_details->toArray();
        }

        /*$consultation_arr = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                  ->where('booking_status','Completed')
                                                                  ->orderBy('id', 'desc')
                                                                  ->paginate(10);
        if(isset($consultation_arr) && !empty($consultation_arr))
        {
          $this->arr_view_data['paginate']          = clone $consultation_arr;
          $this->arr_view_data['consultation_arr']  = $consultation_arr->toArray();
        }*/

        $get_invoice_data = $this->PatientConsultationPaymentModel->with('consultation_details')
                                                                  ->where('patient_id', $this->user_id)
                                                                  ->groupBy('booking_id')
                                                                  ->orderBy('id', 'DESC')
                                                                  ->paginate(10);
        if($get_invoice_data)
        {
          $this->arr_view_data['paginate']      = clone $get_invoice_data;
          $this->arr_view_data['invoice_data']  = $get_invoice_data->toArray();
        }

        $this->arr_view_data['module_url_path']  =$this->module_url_path;
        return view($this->module_view_folder.'.invoice')->with($this->arr_view_data);
      }

      /*--------------------------------------------------------------------------
                    DISPUTES - PAGE 
      -----------------------------------------------------------------------------*/

      /*
      | Function  : Show all the new disputes
      | Author    : Deepak Arvind Salunke
      | Date      : 17/10/2017
      | Output    : array list
      */

      public function disputes()
      {
        $get_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
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
            $this->arr_view_data['paginate']    = $paginate;
            $this->arr_view_data['dispute_arr'] = $dispute_arr->toArray();
        }

        $this->arr_view_data['current_user_id']  = $this->user_id;
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
        return view($this->module_view_folder.'.disputes.new')->with($this->arr_view_data);
      } // end disputes

      public function disputes_open()
      {
        $dispute_arr = $this->DisputeModel->where('status', 'opened')
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
            $this->arr_view_data['paginate']    = $paginate;
            $this->arr_view_data['dispute_arr'] = $dispute_arr->toArray();
        }


        $this->arr_view_data['current_user_id']  = $this->user_id;
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
        return view($this->module_view_folder.'.disputes.open')->with($this->arr_view_data);
      } // end disputes

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
            $this->arr_view_data['paginate']    = $paginate;
            $this->arr_view_data['dispute_arr'] = $dispute_arr->toArray();
        } 
        $this->arr_view_data['current_user_id']  = $this->user_id;
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
        return view($this->module_view_folder.'.disputes.closed')->with($this->arr_view_data);
      } // end disputes


      /*
      | Function  : 
      | Author    : Deepak Arvind Salunke
      | Date      : 17/10/2017
      | Output    : Success or Error
      */

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

          $admin_notif['message'] = "Patient - New dispute added by - ".$this->user_first_name.' '.$this->user_last_name;
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

      } // end disputes_store


      /*--------------------------------------------------------------------------
                    PREFERENCE - STORE 
      -----------------------------------------------------------------------------*/

      public function preference_store(Request $request)
      {
         if($request->hasFile('file_affected_area'))
        { 
          $data_affect = $this->UserPreferencesModel->where('user_id',$this->user_id)->first(['id','affected_area']);     

          if($data_affect)
          {
            $arr_affect = $data_affect->toArray();   
          }

          $path=$this->patient_uploads_url;

          if(isset($arr_affect) && sizeof($arr_affect)>0)
          {
            if(File::exists($path.$arr_affect['affected_area']))
              {
                  @unlink($path.$arr_affect['affected_area']);
              }
          }

          $fileExtension = strtolower($request->file('file_affected_area')->getClientOriginalExtension()); 

          $path=$this->patient_uploads_url;
          $affected_file_name      = $request->input('file_affected_area');
          $file_extension = strtolower($request->file('file_affected_area')->getClientOriginalExtension()); 
          $affected_file_name      = sha1(uniqid().$affected_file_name.uniqid()).'.'.$file_extension;
          $request->file('file_affected_area')->move($path, $affected_file_name);
          
          $upd_data['affected_area'] = $affected_file_name;

          $this->UserPreferencesModel->affected_area=$affected_file_name;    
        }

        $count = $this->UserPreferencesModel->where('user_id',$this->user_id)->count();
        if($count>0)
        {
          $upd_data['entitlement_id'] = $request->entitlement;
          $upd_data['brand'] = $request->brand;
          $upd_data['card_no'] = $request->card_no;

          $res = $this->UserPreferencesModel->where('user_id',$this->user_id)
                                            ->update($upd_data);
          if($res)
          {
            $arr_response['msg']='Preference saved successfully';
          }
         else
         {
            $arr_response['msg']="Something went to wrong or no changes found";
         }                                         
        }
        else
        {
         $this->UserPreferencesModel->user_id=$this->user_id; 
         $this->UserPreferencesModel->entitlement_id=$request->entitlement; 
         $this->UserPreferencesModel->brand=$request->brand; 
         $this->UserPreferencesModel->card_no=$request->card_no; 

         $res=$this->UserPreferencesModel->save(); 

         if($res)
         {
          $arr_response['msg']='Preference saved successfully';
         }
         else
         {
          $arr_response['msg']="Something went to wrong";
         }

        }

         return response()->json($arr_response);
      }

      public function dispute_against_user(Request $request)
      {
          $consultation_id = $request->consultation_id;

          $user_obj = $this->PatientConsultationBookingModel->where('id', $consultation_id)
                                                       ->with('doctor_user_details')
                                                       ->first();

          if(isset($user_obj) && !empty($user_obj))
          {
            $user_arr = $user_obj->toArray();

            $title = isset($user_arr['doctor_user_details']['title']) ? $user_arr['doctor_user_details']['title'] : '';
            $first_name = isset($user_arr['doctor_user_details']['first_name']) ? $user_arr['doctor_user_details']['first_name'] : '';
            $last_name = isset($user_arr['doctor_user_details']['last_name']) ? $user_arr['doctor_user_details']['last_name'] : '';
            $arr_response['status'] = 'success';
            $arr_response['against_user_name'] = $title.' '.$first_name.' '.$last_name;
            $arr_response['against_user_id'] = isset($user_arr['doctor_user_details']['id']) ? $user_arr['doctor_user_details']['id'] : '';
            return response()->json($arr_response);
          }
          else
          {
            $arr_response['status'] = 'error';
            $arr_response['against_user_name'] = '';
            $arr_response['against_user_id']   = '';
            return response()->json($arr_response);
          }                                                       
      }


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

    /*--------------------------------------------------------------------------
                    ENTITLEMENT - GET DETAILS
      -----------------------------------------------------------------------------*/

    public function get_entitlement_details(Request $request)
    {
      $entitlement_id = $request->id;
      $entitle_arr = $this->UserEntitlementModel->where('entitlement_id', $entitlement_id)
                                                ->where('user_id' , $this->user_id)
                                                ->first(); 
      $arr_response = array();                                                
      
      if($entitle_arr)
      {
         $arr_response = $entitle_arr->toArray();
         $arr_json['status'] = 'success';
         $arr_json['card_no'] = isset($arr_response['card_no']) ? $arr_response['card_no'] : '';

         if($arr_response['affect_area_img'] !='' && File::exists($this->patient_uploads_url.$arr_response['affect_area_img']))
         {
            $arr_json['affected_area_photo'] = isset($arr_response['affect_area_img']) ? $arr_response['affect_area_img'] : ''; 
         }
         else
         {
            $arr_json['affected_area_photo'] = ''; 
         }
      }
      else
      {
        $arr_json['status'] = 'error'; 
      }

      return response()->json($arr_json);
    }

    /*--------------------------------------------------------------------------
                    ENTITLEMENT - STORE
      -----------------------------------------------------------------------------*/

    public function store_entitlement_details(Request $request)
    {


      $exist_img_arr = explode(',',$request->existing_images);
      $affected_area_img = $this->UserEntitlementModel->where('user_id' , $this->user_id)
                                                      ->where('entitlement_id' , $request->entitlement_id)
                                                      ->select('affect_area_img')
                                                      ->get();
      if(isset($affected_area_img) && !empty($affected_area_img))
      {
          $affected_area_img_arr = $affected_area_img->toArray();     
          $img_arr=[];
          foreach($affected_area_img_arr as $img)
          {
              if(!empty($img['affect_area_img']))
              {
                  array_push($img_arr, $img['affect_area_img']);
              }
          }

          $before = $img_arr;
          $after =  $exist_img_arr;

          $delete_array = array_diff($img_arr,$exist_img_arr);

          foreach($delete_array as $val)
          {
              $this->UserEntitlementModel->where('affect_area_img',$val)
                                             ->delete();
               if($val!='' && File::exists($this->patient_uploads_url.$val))                                
               {
                  unlink($this->patient_uploads_url.$val);
               }
          }
      }
      
      if($request->hasFile('affected_area'))
      { 
         $file   =   $request->file('affected_area');
/*          if(isset($medical_file) && sizeof($medical_file)>0)
          {
            foreach($medical_file as $file)
            {*/
               $img_delete = $this->UserEntitlementModel->where('user_id' , $this->user_id)
                                                              ->where('entitlement_id' , $request->entitlement_id)
                                                              ->select('affect_area_img')
                                                              ->first();
                if($img_delete)
                {
                  $img = $img_delete->toArray();

                  $delete_img = isset($img['affect_area_img']) ? $img['affect_area_img'] : '';

                   if($delete_img!='' && File::exists($this->patient_uploads_url.$delete_img))                                
                   {
                      @unlink($this->patient_uploads_url.$delete_img);
                   }

                }                                                                 

              $medical_name           = $file;
              $medical_file_extension = strtolower($file->getClientOriginalExtension()); 
              $medical_file_name      = sha1(uniqid().$medical_name.uniqid()).'.'.$medical_file_extension;
              $medical_upload_result  = $file->move($this->patient_uploads_url, $medical_file_name);

              $entitle_arr['affect_area_img']  = $medical_file_name;    
            /*}
          }*/
      }

      $entitle_arr['card_no']        = $request->input('enc_card_no');
      $count = $this->UserEntitlementModel->where('user_id' , $this->user_id)
                                          ->where('entitlement_id', $request->entitlement_id)
                                          ->count();
      if($count > 0)
      {
        $entitle_res = $this->UserEntitlementModel->where('user_id', $this->user_id)
                                                    ->where('entitlement_id', $request->entitlement_id)
                                                    ->update($entitle_arr);  

           $arr_response['msg'] = 'Entitlement details saved Successfully'; 
      }               
      else
      {
        $entitle_arr['user_id']        = $this->user_id;
        $entitle_arr['entitlement_id'] = $request->entitlement_id;
         
        $entitle_res = $this->UserEntitlementModel->create($entitle_arr);

         if($entitle_res)
          {
             $arr_response['msg'] = 'Entitlement details saved Successfully'; 
          }
          else
          {
             $arr_response['msg'] = 'Something went to wrong ! Please try again later.';
          }

      }

      return response()->json($arr_response);

    }

    /*--------------------------------------------------------------------------
                    ENTITLEMENT - DELETE
      -----------------------------------------------------------------------------*/

    public function delete_entitlement_details(Request $request)
    {
      
      $img_delete = $this->UserEntitlementModel->where('id' , $request->id)
                                                 ->select('affect_area_img')
                                                 ->first();
      
      $res = $this->UserEntitlementModel->where('id',$request->id)
                                        ->delete();
      if($res)
      {

        if($img_delete)
        {
          $img = $img_delete->toArray();

          $delete_img = isset($img['affect_area_img']) ? $img['affect_area_img'] : '';

           if($delete_img!='' && File::exists($this->patient_uploads_url.$delete_img))                                
           {
              @unlink($this->patient_uploads_url.$delete_img);
           }

        }

        $arr_response['msg'] = 'Entitlement deleted successfully';
      }
      else
      {
        $arr_response['msg'] = 'Something went to wrong ! Please try again later.';
      }                                        

      return response()->json($arr_response);

    }

    public function send_otp($otp,$user_details)
    {
        $otp_id = $mob_code = "";

        if($user_details)
        {
            $mobile_code =  $user_details['patientinfo']['mobile_code'];

            $get_mob_data = $this->MobileCountryCodeModel->where('id', $mobile_code)->first();
            if($get_mob_data)
            {
                $mob_data = $get_mob_data->toArray();
                $mob_code = $mob_data['phonecode'];
            }
            $mobile_num =  $user_details['patientinfo']['mobile_no'];
            $mobile_no = '+'.$mob_code.''.$mobile_num;

            $user_id = $user_details['id'];
            $email = $user_details['email'];

            $created_on = date("Y-m-d H:i:s");
            $expired_on = date("Y-m-d H:i:s",strtotime("+10 minutes",strtotime($created_on)));

            $data_arr['user_id']    = $user_id;
            $data_arr['otp']        = $otp;
            $data_arr['mobile_no']  = $mobile_no;
            $data_arr['email']      = $email;
            $data_arr['created_on'] = $created_on;
            $data_arr['expired_on'] = $expired_on;

            if(isset($user_id) && !empty($user_id))
            {
                $this->OtpModel->where('user_id',$user_id)
                               ->delete();    
            }

            Session::put('otp_user_id',$user_id);
            Session::put('otp_mobile_no',$mobile_no);
            
        }

        if(isset($otp) && !empty($otp))
        {
           // $to = "+918149905936";
            $to = $mobile_no;
            $message = $otp." - your doctoroo security login code ";

            $sid        = env('TWILIO_SMS_SID');
            $token      = env('TWILIO_SMS_TOKEN');
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

            $otp_id = $this->OtpModel->insertGetId($data_arr);

            return $otp_id;   
        }        
    }

    public function mobile_no_check(Request $request)
    {
        
      $count = $this->PatientModel->where('mobile_no' ,$request->mobile_no)
                                  ->count();
      if($count == 0)
      {
         $arr_response['status'] = 'success';
         $arr_response['msg'] = '';
      }                            
      else
      {
        $arr_response['status'] = 'error';
        $arr_response['msg'] = 'This mobile number is already registered ! try another';
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

      return view($this->module_view_folder.'.camera_and_internet_test',$this->arr_view_data);

  } // end camera_and_internet_test

}