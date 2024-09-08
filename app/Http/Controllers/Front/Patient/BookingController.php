<?php
namespace App\Http\Controllers\Front\Patient;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PatientConsultationBookingModel;
use App\Models\ReminderModel;
use App\Models\FamilyMemberModel;
use App\Models\AvailabilityModel;
use App\Models\UserModel;
use App\Models\DoctorModel;
use App\Models\SpecialityModel;
use App\Models\LanguageModel;
use App\Models\ConsultationPriceModel;
use App\Models\PaymentMethodsModel;
use App\Models\PatientConsultationStatusModel;
use App\Models\NotificationModel;
use App\Models\DoctorTimeIntervalModel;
use App\Models\PatientConsultationImagesModel;
use App\Models\DoctroFeesModel;
use App\Models\DoctorPremiumRateModel;
use App\Models\StripeCustomerModel;
use App\Models\StripeCardModel;
use App\Models\EntitlementModel;
use App\Models\DoctorFeeModel;
use App\Models\PatientConsultationPaymentModel;
use App\Models\StripeConnectedAccountsModel;
use App\Models\AdminProfileModel;

use PDO;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;
use Session;
use DB;
use Cookie;
use File;
use Stripe;
use Mail;
use DateTimeZone;

class BookingController extends Controller
{
    public function __construct(PatientConsultationBookingModel   $consultation_model,
                                ReminderModel                     $reminder_model,
                                FamilyMemberModel                 $family_member_model,
                                AvailabilityModel                 $availability_model,
                                UserModel                         $user_model,
                                DoctorModel                       $doctor_model,
                                SpecialityModel                   $speciality_model,
                                LanguageModel                     $language_model,
                                ConsultationPriceModel            $consultation_price_model,
                                PaymentMethodsModel               $payment_methods_model,
                                PatientConsultationStatusModel    $consultation_status_model,
                                NotificationModel                 $NotificationModel,
                                DoctorTimeIntervalModel           $DoctorTimeIntervalModel,
                                PatientConsultationImagesModel    $PatientConsultationImagesModel,
                                DoctroFeesModel                   $DoctroFeesModel,
                                DoctorPremiumRateModel            $DoctorPremiumRateModel,
                                StripeCustomerModel               $StripeCustomerModel,
                                StripeCardModel                   $StripeCardModel,
                                EntitlementModel                  $entitlement_model,
                                DoctorFeeModel                    $DoctorFeeModel,
                                PatientConsultationPaymentModel   $PatientConsultationPaymentModel,
                                StripeConnectedAccountsModel      $StripeConnectedAccountsModel,
                                AdminProfileModel                 $AdminProfileModel)
    {
        $this->arr_view_data                        = [];
        $this->module_title                         = "Booking";
        $this->module_url_path                      = url('/').'/patient/booking';
        $this->doctor_image_url                     = url('/public').config('app.project.img_path.doctor_image');
        $this->module_view_folder                   = "front.patient.booking";

        $this->PatientConsultationBookingModel      = $consultation_model;
        $this->PatientConsultationStatusModel       = $consultation_status_model;
        $this->ReminderModel                        = $reminder_model;
        $this->FamilyMemberModel                    = $family_member_model;
        $this->AvailabilityModel                    = $availability_model;
        $this->UserModel                            = $user_model;
        $this->DoctorModel                          = $doctor_model;
        $this->SpecialityModel                      = $speciality_model;
        $this->LanguageModel                        = $language_model;
        $this->ReminderModel                        = $reminder_model;
        $this->NotificationModel                    = $NotificationModel;
        $this->ConsultationPriceModel               = $consultation_price_model;
        $this->PaymentMethodsModel                  = $payment_methods_model;
        $this->DoctorTimeIntervalModel              = $DoctorTimeIntervalModel;
        $this->PatientConsultationImagesModel       = $PatientConsultationImagesModel;
        $this->DoctroFeesModel                      = $DoctroFeesModel;
        $this->DoctorPremiumRateModel               = $DoctorPremiumRateModel;
        $this->StripeCustomerModel                  = $StripeCustomerModel;
        $this->StripeCardModel                      = $StripeCardModel;
        $this->entitlement_model                    = $entitlement_model;
        $this->DoctorFeeModel                       = $DoctorFeeModel;
        $this->PatientConsultationPaymentModel      = $PatientConsultationPaymentModel;
        $this->StripeConnectedAccountsModel         = $StripeConnectedAccountsModel;
        $this->AdminProfileModel                    = $AdminProfileModel;

        $this->patient_uploads_url                  = url('/public').config('app.project.img_path.patient_uploads');
        $this->profile_uploads_base_url             = public_path().config('app.project.img_path.patient_uploads');
        $this->doc_video_public                     = public_path().config('app.project.img_path.doctor_video');
        $this->doc_video                            = url('/public').config('app.project.img_path.doctor_video');

        $user                                       = Sentinel::check();
        $this->user_id                              = '';

        if($user!=false)
        {
           $this->user_id                           = $user->id;
        }

        DB::connection()->enableQueryLog();
        //$queries = DB::getQueryLog();

    }

    /*
    | Function  : Fetch family maembers details of user
    | Author    : Deepak Arvind Salunke
    | Date      : 29/06/2017
    | Output    : Display family members and other options for booking
    */

    public function book_a_doctor()
    {
      if(!empty(Session::get('inserted_family_member_id')) && Session::get('inserted_family_member_id') != null)
      {
        $this->arr_view_data['inserted_family_member_id'] = Session::get('inserted_family_member_id');
      }

      $current_date = date("Y-m-d");

      $check_booking_limit = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                   ->where('consultation_date', '>=', $current_date)
                                                                   ->count();
      if($check_booking_limit >= 3)
      {
        $this->arr_view_data['user_booking_limit'] = 'No';
      }
      else
      {
        $this->arr_view_data['user_booking_limit'] = 'No';
      }

       $arr_personal_details = [];

        $obj_personal_details = $this->UserModel->where('id',$this->user_id)
                                                ->with('patientinfo')
                                                ->first();

        $email = $first_name = $last_name = $gender = $mobile_code = $mobile_no = $date_of_birth = $suburb = $entitlement_id = $card_no = "";                                          
      
        if($obj_personal_details)
        {
           $arr_personal_details = $obj_personal_details->toArray();

           $email           = $arr_personal_details['email'];
           $first_name      = $arr_personal_details['first_name'];
           $last_name       = $arr_personal_details['last_name'];
           $gender          = $arr_personal_details['patientinfo']['gender'];
           $date_of_birth   = $arr_personal_details['patientinfo']['date_of_birth'];
           $mobile_code     = $arr_personal_details['patientinfo']['mobile_code'];
           $mobile_no       = $arr_personal_details['patientinfo']['mobile_no'];
           $suburb          = $arr_personal_details['patientinfo']['suburb'];
           $entitlement_id  = $arr_personal_details['patientinfo']['entitlement_id'];
           $card_no         = $arr_personal_details['patientinfo']['card_no'];
        }

        if($email == ''  ||  $first_name == '' || $last_name == '' || $gender == '' || $date_of_birth == '' || $mobile_code == '' || $mobile_no == '' || $suburb =='')
        {
          Session::set('profile_status_msg', 'Note: Please complete your profile before booking new consultation');
           return redirect(url('').'/patient/setting/edit_personal_details');
        }
        

      
      
      $arr_family_members = $this->arr_view_data['family_members'] = $this->arr_view_data['user_details'] = [];

      $arr_family_members = $this->FamilyMemberModel->where('user_id', $this->user_id)
                                                    ->where('member_status','link')
                                                    ->get();
      if($arr_family_members)
      {
        $this->arr_view_data['family_members'] = $arr_family_members->toArray();
      }

      $this->arr_view_data['user_details']    = Sentinel::check();

      $this->arr_view_data['page_title']      = str_singular($this->module_title);
      $this->arr_view_data['module_url_path'] = $this->module_url_path;

      Session::forget('booking');
      Session::forget('Consultation_id');
      return view($this->module_view_folder.'.book_a_doctor',$this->arr_view_data);
    } // end book_a_doctor


    /*
    | Function  : get the doctor id and store it to session
    | Author    : Deepak Arvind Salunke
    | Date      : 27/09/2017
    | Output    : redirect to book a doctor page
    */

    public function select_doctor_for_booking($enc_id)
    {
        if(!empty(Session::get('selected_doctor_for_booking')) && Session::get('selected_doctor_for_booking') != null)
        {
            Session::forget('selected_doctor_for_booking');
        }

        if($enc_id != '')
        {
            $doctor_id = base64_decode($enc_id);
            Session::put('selected_doctor_for_booking',$doctor_id);

            return redirect(url('/').'/patient/booking');
        }
        else
        {
            return redirect()->back();
        }
    } // end select_doctor_for_booking


    /*
    | Function  : Get Doctors which are available today and tomorrow
    | Author    : Deepak Arvind Salunke
    | Date      : 29/06/2017
    | Output    : Display all the available doctors 
    */
    public function show_available_doctors(Request $request)
    {
      $redirectTo = url('/').'/patient/booking';

      $this->arr_view_data['available_doctor_today'] = $this->arr_view_data['available_doctor_tomorrow'] = [];

      $current_date = date("Y-m-d");
      $current_time = date("H:i:s");

      if(!empty(Session::get('inserted_family_member_id')) && Session::get('inserted_family_member_id') != null)
      {
        Session::forget('inserted_family_member_id');
      }

      if($request->ajax())
      {
        if(!empty(Session::get('medical_files')) && Session::get('medical_files') != null)
        {
           Session::forget('medical_files');
        }
      }

      // upload medical images
      if($request->hasFile('enc_imgs'))
      {
          $medical_file   =   $request->file('enc_imgs');
          if(isset($medical_file) && sizeof($medical_file)>0)
          {
              $cnt = 1;

              foreach($medical_file as $file)
              {
                $extention  =   strtolower($file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('medical_img_error','Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                    return response()->json(['redirectTo'=>$redirectTo]);
                    //return redirect()->back()->withInput($request->all());
                }
                else if($file->getClientSize() > 5000000)
                {
                    Session::flash('medical_img_error','Please upload image with small size. Max size allowed is 5mb');
                    return response()->json(['redirectTo'=>$redirectTo]);
                    //return redirect()->back()->withInput($request->all());
                }
                else
                {
                    @unlink($this->patient_uploads_url.$request->input('old_img'));
                    $medical_name           = $file;
                    $medical_file_extension = strtolower($file->getClientOriginalExtension()); 
                    $medical_file_name      = sha1(uniqid().$medical_name.uniqid()).'.'.$medical_file_extension;
                    $medical_upload_result  = $file->move($this->profile_uploads_base_url, $medical_file_name);

                    if($request->ajax())
                    {
                      if(!empty(Session::get('medical_files')) && Session::get('medical_files') != null)
                      {
                        Session::put('medical_files', array_add($medical_files = Session::get('medical_files'), 'file'.$cnt, $medical_file_name));
                      }
                      else
                      {
                        Session::put(array('medical_files' => array('file'.$cnt => $medical_file_name) ));
                      }
                    }

                    $cnt++;
                    
                }
              }
          }
          else
          {
              Session::flash('medical_img_error','Please upload valid image.');
              return response()->json(['redirectTo'=>$redirectTo]);
              //return redirect()->back()->withInput($request->all());
          }

         // dd(Session::get('medical_files'));  
      }
      
      
      if(empty(Session::get('booking')))
      {
          if($request->ajax())
          {
            Session::put(array('booking' => array(
                                     'patient'               => $request->input('patient'),
                                     'user_type'             => $request->input('user_type'),
                                     'advice_treatment'      => $request->input('advice_treatment'),
                                     'prescriptions_repeats' => $request->input('prescriptions_repeats'),
                                     'medical_cetificate'    => $request->input('medical_cetificate'),
                                     'other'                 => $request->input('other'),
                                     'symptoms'              => $request->input('symptoms'),
            )      )                 );
          }

      }
      if(!empty(Session::get('selected_doctor_for_booking')) && Session::get('selected_doctor_for_booking') != null)
      {
        $doc_id = Session::get('selected_doctor_for_booking');

        $get_doc = $this->UserModel->where('id', $doc_id)->count();
        if($get_doc > 0)
        {
          $redirectTo = url('/').'/patient/booking/available_doctor/'.base64_encode($doc_id).'/'.base64_encode($current_date);
          return response()->json(['redirectTo'=>$redirectTo]);
        }
      }

      Session::forget('search_doctor');

      $date         = date('Y-m-d');
      $tomorrow     = date("Y-m-d",strtotime('+1 day'));
      $current_time = date("Y-m-d H:i:s");

      $current_day  = strtolower(date("D"));
      $tomorrow_day = strtolower(date("D",strtotime('+1 day')));

      // for today
      $get_available_doctor_today = DB::table('dod_availability')
                                      ->select('dod_availability.*', 'dod_doctor.*', 'users.*', 'doctor_fees.*','users.id as doctor_user_id', 'doctor_fees.start_time as fee_start_time', 'doctor_fees.end_time as fee_end_time')
                                      ->join('dod_doctor', 'dod_doctor.user_id', '=', 'dod_availability.user_id')
                                      ->join('users', 'users.id', '=', 'dod_doctor.user_id')
                                      ->leftjoin('doctor_fees', 'doctor_fees.doctor_id', '=', 'dod_availability.user_id')
                                      ->where('dod_availability.date', $date)
                                      //->where('dod_availability.end_time', '>=', $current_time)
                                      ->where('users.verification_status',1)
                                      ->where('dod_doctor.doctor_status','live')
                                      ->where('users.deleted_status',0)
                                      ->where('users.user_status','Active')
                                      ->where('users.deleted_at',null)
                                      ->where('doctor_fees.day',$current_day)
                                      /*->where('doctor_fees.start_time', '<=',$current_time)
                                      ->where('doctor_fees.end_time', '>=',$current_time)*/
                                      ->groupBy('dod_availability.user_id')
                                      ->get();
      if($get_available_doctor_today)
      {
        $this->arr_view_data['available_doctor_today'] = $get_available_doctor_today;
      }

      // for tomorrow
      $get_available_doctor_tomorrow = DB::table('dod_availability')
                                         ->select('dod_availability.*', 'dod_doctor.*', 'users.*', 'doctor_fees.*','users.id as doctor_user_id')
                                         ->join('dod_doctor', 'dod_doctor.user_id', '=', 'dod_availability.user_id')
                                         ->join('users', 'users.id', '=', 'dod_doctor.user_id')
                                         ->leftjoin('doctor_fees', 'doctor_fees.doctor_id', '=', 'dod_availability.user_id')
                                         //->where('dod_availability.date', $tomorrow)
                                         ->where('dod_doctor.doctor_status','live')
                                         ->where('users.verification_status',1)
                                         ->where('users.deleted_status',0)
                                         ->where('users.user_status','Active')
                                         ->where('users.deleted_at',null)
                                         ->where('doctor_fees.day',$tomorrow_day)
                                         /*->where('doctor_fees.start_time', '<=',$current_time)
                                         ->where('doctor_fees.end_time', '>=',$current_time)*/
                                         ->groupBy('dod_availability.user_id')
                                         ->get();
      if($get_available_doctor_tomorrow)
      {
        $this->arr_view_data['available_doctor_tomorrow'] = $get_available_doctor_tomorrow;
      }


      $language_arr = $this->LanguageModel->where('language_status','1')->orderBy('language','ASC')->get();
      if($language_arr)
      {
          $this->arr_view_data['language'] = $language_arr->toArray();
      }

      $speciality_arr = $this->SpecialityModel->where('speciality_status','Active')->get();
      if($speciality_arr)
      {
          $this->arr_view_data['speciality'] = $speciality_arr->toArray();
      }

      //$queries = DB::getQueryLog();
      $this->arr_view_data['show_records']              = '5';
      $this->arr_view_data['today_date']                = $date;
      $this->arr_view_data['tomorrow_date']             = $tomorrow;

      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      if($request->ajax())
      {
        $redirectTo = url('/')."/patient/booking/show_available_doctors";
        return response()->json(['redirectTo'=>$redirectTo]);
      }
      return view($this->module_view_folder.'.show_available_doctors',$this->arr_view_data);
    } // end show_available_doctors


    public function show_available_doctors_all_records(Request $request,$day=false)
    {
      $current_date = date("Y-m-d");
      $current_time = date("H:i:s");

      if(!empty(Session::get('inserted_family_member_id')) && Session::get('inserted_family_member_id') != null)
      {
        Session::forget('inserted_family_member_id');
      }

      if(!empty(Session::get('medical_files')) && Session::get('medical_files') != null)
      {
        Session::forget('medical_files');
      }

      $date         = date('Y-m-d');
      $tomorrow     = date("Y-m-d",strtotime('+1 day'));
      $current_time = date("Y-m-d H:i:s");

      $current_day  = strtolower(date("D"));
      $tomorrow_day = strtolower(date("D",strtotime('+1 day')));

      if(isset($day) && $day == 'today')
      {

            $get_available_doctor_today = DB::table('dod_availability')
                                            ->select('dod_availability.*', 'dod_doctor.*', 'users.*', 'doctor_fees.*','users.id as doctor_user_id')
                                            ->join('dod_doctor', 'dod_doctor.user_id', '=', 'dod_availability.user_id')
                                            ->join('users', 'users.id', '=', 'dod_doctor.user_id')
                                            ->join('doctor_fees', 'doctor_fees.doctor_id', '=', 'dod_availability.user_id')
                                            ->where('dod_availability.date', $date)
                                            ->where('dod_availability.end_time', '>=', $current_time)
                                            ->where('users.verification_status',1)
                                            ->where('dod_doctor.doctor_status','live')
                                            ->where('users.deleted_status',0)
                                            ->where('users.user_status','Active')
                                            ->where('users.deleted_at',null)
                                            ->where('doctor_fees.day',$current_day)
                                            /*->where('doctor_fees.start_time', '<=',$current_time)
                                            ->where('doctor_fees.end_time', '>=',$current_time)*/
                                            ->groupBy('dod_availability.user_id')
                                            ->paginate(10);

        if($get_available_doctor_today)
        {
          $this->arr_view_data['paginate']               = clone $get_available_doctor_today;
          $this->arr_view_data['available_doctor_today'] = $get_available_doctor_today;
        }

      }
      else if(isset($day) && $day == 'tomorrow')
      {
          $get_available_doctor_tomorrow = DB::table('dod_availability')
                                              ->select('dod_availability.*', 'dod_doctor.*', 'users.*', 'doctor_fees.*','users.id as doctor_user_id')
                                              ->join('dod_doctor', 'dod_doctor.user_id', '=', 'dod_availability.user_id')
                                              ->join('users', 'users.id', '=', 'dod_doctor.user_id')
                                              ->join('doctor_fees', 'doctor_fees.doctor_id', '=', 'dod_availability.user_id')
                                              ->where('dod_availability.date', $tomorrow)
                                              ->where('users.verification_status',1)
                                              ->where('dod_doctor.doctor_status','live')
                                              ->where('users.deleted_status',0)
                                              ->where('users.user_status','Active')
                                              ->where('users.deleted_at',null)
                                              ->where('doctor_fees.day',$tomorrow_day)
                                              /*->where('doctor_fees.start_time', '<=',$current_time)
                                              ->where('doctor_fees.end_time', '>=',$current_time)*/
                                              ->groupBy('dod_availability.user_id')
                                              ->paginate(10);

        if($get_available_doctor_tomorrow)
        {
          $this->arr_view_data['paginate']                  = clone $get_available_doctor_tomorrow;
          $this->arr_view_data['available_doctor_tomorrow'] = $get_available_doctor_tomorrow;
        }

      }
      

      $language_arr = $this->LanguageModel->where('language_status','1')->orderBy('language','ASC')->get();
      if($language_arr)
      {
          $this->arr_view_data['language'] = $language_arr->toArray();
      }

      $speciality_arr = $this->SpecialityModel->where('speciality_status','Active')->get();
      if($speciality_arr)
      {
          $this->arr_view_data['speciality'] = $speciality_arr->toArray();
      }

      //$queries = DB::getQueryLog();
      $this->arr_view_data['day']                       = isset($day) ? $day : '';
      $this->arr_view_data['show_records']              = '5';
      $this->arr_view_data['today_date']                = $date;
      $this->arr_view_data['tomorrow_date']             = $tomorrow;

      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.show_available_doctors_all_records',$this->arr_view_data);
    }

    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 04/12/2017
    | Output    : 
    */    

    public function get_doctor_fee_prices($doc_id)
    {
        $doctor_fee_prices = '';

        $current_day  = strtolower(date("D"));
        $get_doctor_fee_prices = $this->DoctorFeeModel->where('doctor_id', $doc_id)
                                                      ->where('day', $current_day)
                                                      ->orderBy('total_patient_fee_for_four_min', 'DESC')
                                                      ->get();
        if($get_doctor_fee_prices)
        {
          $doctor_fee_prices = $get_doctor_fee_prices->toArray();
        }
        return $doctor_fee_prices;
    } // end get_booking_pricing

    /*
    | Function  : Get available Doctor time details
    | Author    : Deepak Arvind Salunke
    | Date      : 30/06/2017
    | Output    : Display all the available doctors 
    */

    public function available_doctor(Request $request, $enc_id, $enc_date)
    {
      $arr_doc_time_slot = [];

      if(!empty(Session::get('selected_doctor_for_booking')) && Session::get('selected_doctor_for_booking') != null)
      {
          Session::forget('selected_doctor_for_booking');
      }

      $doctor_id  = base64_decode($enc_id);
      $get_date   = base64_decode($enc_date);

      if(!empty(Session::get('search_doctor.selected_date')))
      {
        $selected_date = Session::get('search_doctor.selected_date');
      }
      else
      {
        $selected_date = $get_date;
      }
      
      if(!empty(Session::get('booking.doctor_id')))
      {
        Session::forget('booking.doctor_id');
        Session::put('booking', array_add(Session::get('booking'), 'doctor_id', $doctor_id));
      }
      else
      {
        // to add doctor_id in booking array
        Session::put('booking', array_add(Session::get('booking'), 'doctor_id', $doctor_id));
      }

      if(!empty(Session::get('last_payment_method_id')))
      {
        Session::forget('last_payment_method_id');
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

      $current_datetime = convert_utc_to_userdatetime($this->user_id, "patient", date("Y-m-d H:i:s"));
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
          // convert doctor aviliable time to patient timezone
          $start_time = convert_utc_to_userdatetime($this->user_id, "patient", $doc_avail['start_time']);
          $end_time = convert_utc_to_userdatetime($this->user_id, "patient", $doc_avail['end_time']);

          // get patient current time
          $current_time = convert_utc_to_userdatetime($this->user_id, "patient", date("Y-m-d H:i:s"));

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
                          $fee_doc_start = convert_utc_to_userdatetime($this->user_id, "patient", $doc_fee['start_time']);
                          $fee_start = substr($fee_doc_start, 11);

                          $fee_doc_end = convert_utc_to_userdatetime($this->user_id, "patient", $doc_fee['end_time']);
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
      
      $this->arr_view_data['doc_fee_time_slot']         = $arr_doc_time_slot;
      $this->arr_view_data['patient_id']                = $this->user_id;
      $this->arr_view_data['doctor_id']                 = $doctor_id;
      $this->arr_view_data['doctor_pricing_fees']       = $this->get_doctor_fee_prices($doctor_id);
      $this->arr_view_data['get_selected_date']         = $get_date;
      $this->arr_view_data['doctor_video_url']          = $this->doc_video;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;
      
      return view($this->module_view_folder.'.profile_availibility',$this->arr_view_data);
    } // end available_doctor


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

      $selected_datetime = convert_utc_to_userdatetime($this->user_id, "patient", $selected_date);
      $selected_day = strtolower(date('D', strtotime($selected_datetime)));

      $doctor_id = Session::get('booking.doctor_id');

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
            $start_time = convert_utc_to_userdatetime($this->user_id, "patient", $doc_avail['start_time']);
            $end_time = convert_utc_to_userdatetime($this->user_id, "patient", $doc_avail['end_time']);

            // get patient current time
            $current_time = convert_utc_to_userdatetime($this->user_id, "patient", date("Y-m-d H:i:s"));

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
                            $fee_doc_start = convert_utc_to_userdatetime($this->user_id, "patient", $doc_fee['start_time']);
                            $fee_start = substr($fee_doc_start, 11);

                            $fee_doc_end = convert_utc_to_userdatetime($this->user_id, "patient", $doc_fee['end_time']);
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
    | Function  : Get Doctors details from the user and match it to database
    | Author    : Deepak Arvind Salunke
    | Date      : 29/06/2017
    | Output    : Fetch doctor data as per conditions
    */

    public function search_available_doctors(Request $request)
    {
      DB::setFetchMode(PDO::FETCH_ASSOC);

      Session::forget('search_doctor');

      $doctor_name = $speciality = $selected_date = $selected_time = $language = $gender = "";
      
      $doctor_name        = $request->input('doctor_name');
      $speciality         = $request->input('speciality');
      $selected_date      = $request->input('date_submit');
      $selected_time      = $request->input('selected_time');
      $language           = $request->input('language');
      $gender             = $request->input('gender');
      $consult_fee        = $request->input('consult_fee');

      $doc_name_arr = explode(' ', $doctor_name);

      $sort_by = '';
      
      Session::put(array('search_doctor' => array(
                                             'doctor_name'               => $doctor_name,
                                             'speciality'                => $speciality,
                                             'selected_date'             => $selected_date,
                                             'selected_time'             => $selected_time,
                                             'language'                  => $language,
                                             'gender'                    => $gender,
                  )      )                 );

      if(!empty($doctor_name)){     $this->arr_view_data['selected_doctor_name']   = $doctor_name; }
      if(!empty($speciality)){      $this->arr_view_data['selected_speciality']    = $speciality; }
      if(!empty($selected_date)){   $this->arr_view_data['selected_date']          = $selected_date; }
      if(!empty($selected_time)){   $this->arr_view_data['selected_time']          = $selected_time; }
      if(!empty($language)){        $this->arr_view_data['selected_language']      = $language; }
      if(!empty($gender)){          $this->arr_view_data['selected_gender']        = $gender; }

      if(!empty($speciality)){
        $speciality_arr = $this->SpecialityModel->where('speciality_status','Active')->where('id',$speciality)->first();
        if($speciality_arr)
        {
            $arr_speciality = $speciality_arr->toArray();
        }
        $speciality = $arr_speciality['speciality'];
      }

      $current_date = date("Y-m-d");
      $current_time = date("H:i:s");

      $current_day  = strtolower(date("D"));
      $tomorrow_day = strtolower(date("D",strtotime('+1 day')));

      $get_available_doctor_today = '';

      if(empty($selected_date))
      {

          $get_available_doctor_today_query = DB::table('dod_availability')
                                                ->select('dod_availability.*', 'dod_doctor.*', 'users.*', 'doctor_fees.*','users.id as doctor_user_id')
                                                ->join('dod_doctor', 'dod_doctor.user_id', '=', 'dod_availability.user_id')
                                                ->join('users', 'users.id', '=', 'dod_doctor.user_id')
                                                ->join('doctor_fees', 'doctor_fees.doctor_id', '=', 'dod_availability.user_id')
                                                ->where('dod_availability.date' , $current_date)
                                                ->where('dod_availability.end_time', '>=', $current_time)
                                                ->where('users.verification_status',1)
                                                ->where('dod_doctor.doctor_status','live')
                                                ->where('users.deleted_status',0)
                                                ->where('users.user_status','Active')
                                                ->where('users.deleted_at',null)
                                                ->where('doctor_fees.day',$current_day)
                                                /*->where('doctor_fees.start_time', '<=',$current_time)
                                                ->where('doctor_fees.end_time', '>=',$current_time)*/
                                                ->groupBy('dod_availability.user_id');


          // Search by Title, First Name, Last Name
          if(!empty($doctor_name))
          {
            if(sizeof($doc_name_arr) == 3)
            {
              $get_available_doctor_today_query->where('title','like','%'.$doc_name_arr[0].'%');
              $get_available_doctor_today_query->where('first_name','like','%'.$doc_name_arr[1].'%');
              $get_available_doctor_today_query->where('last_name','like','%'.$doc_name_arr[2].'%');
            }
            else if(strstr($doctor_name, ' '))
            {
              list($fname,$lname) = explode(' ', $doctor_name);

              if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                {
                   if(isset($fname) && isset($lname))
                    {
                      $get_available_doctor_today_query->where('title','like','%'.$fname.'%');
                      $get_available_doctor_today_query->where('first_name','like','%'.$lname.'%');
                    } 
                }
                else
                { 
                   if(isset($fname) && isset($lname))
                    {
                      $get_available_doctor_today_query->where('first_name','like','%'.$fname.'%');
                      $get_available_doctor_today_query->where('last_name','like','%'.$lname.'%');
                    } 
                }
            }
            else
            {
              $get_available_doctor_today_query->where(function ($query) use($doctor_name){
                    $query->where('first_name','like','%'.$doctor_name.'%')
                          ->orWhere('last_name','like','%'.$doctor_name.'%');
              });
            }
          }

          // Search by Date
          if(!empty($selected_date)){ $get_available_doctor_today_query->where('date', '=', $selected_date); }

          // Search by Time
          if(!empty($selected_time))
          {
              $time = date('H:i:s', strtotime($selected_time));
              $get_available_doctor_today_query->where('dod_availability.start_time', '<=', $time);
              $get_available_doctor_today_query->where('dod_availability.end_time', '>=', $time);
          }

          // Search by Lanaguage
          if(!empty($language)){ $get_available_doctor_today_query->whereRaw('find_in_set(?, language)', [$language]); }

          // Search by Gender
          if(!empty($gender)){ $get_available_doctor_today_query->where('gender',$gender); }

          // Sort by Doctor Consult Fees
          if(!empty($consult_fee))
          {
              if($consult_fee == 'low')
              {
                  $sort_by = 'low_to_high';
                  $get_available_doctor_today_query->orderBy('total_patient_fee_for_four_min','ASC');
              }
              else
              {
                  $sort_by = 'high_to_low';
                  $get_available_doctor_today_query->orderBy('total_patient_fee_for_four_min','DESC');
              }
          }

          $get_available_doctor_today = $get_available_doctor_today_query->get();

          if($get_available_doctor_today)
          {
            $this->arr_view_data['available_doctor_today'] = $get_available_doctor_today;
          }
      }

        $tomorrow = date("Y-m-d",strtotime('+1 day'));

        if(empty($selected_date))
        {
           
            $get_available_doctor_tomorrow_query = DB::table('dod_availability')
                                                      ->select('dod_availability.*', 'dod_doctor.*', 'users.*', 'doctor_fees.*','users.id as doctor_user_id')
                                                      ->join('dod_doctor', 'dod_doctor.user_id', '=', 'dod_availability.user_id')
                                                      ->join('users', 'users.id', '=', 'dod_doctor.user_id')
                                                      ->join('doctor_fees', 'doctor_fees.doctor_id', '=', 'dod_availability.user_id')
                                                      ->where('dod_availability.date', $tomorrow)
                                                      ->where('dod_doctor.doctor_status','live')
                                                      ->where('users.verification_status',1)
                                                      ->where('users.deleted_status',0)
                                                      ->where('users.user_status','Active')
                                                      ->where('users.deleted_at',null)
                                                      ->where('doctor_fees.day',$tomorrow_day)
                                                      /*->where('doctor_fees.start_time', '<=',$current_time)
                                                      ->where('doctor_fees.end_time', '>=',$current_time)*/
                                                      ->groupBy('dod_availability.user_id');

                // Search by Title, First Name, Last Name


            if(!empty($doctor_name))
            {
              if(sizeof($doc_name_arr) == 3)
              {
                $get_available_doctor_tomorrow_query->where('title','like','%'.$doc_name_arr[0].'%');
                $get_available_doctor_tomorrow_query->where('first_name','like','%'.$doc_name_arr[1].'%');
                $get_available_doctor_tomorrow_query->where('last_name','like','%'.$doc_name_arr[2].'%');
              }
              else if(strstr($doctor_name, ' '))
              {
                list($fname,$lname) = explode(' ', $doctor_name);

                if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                  {
                     if(isset($fname) && isset($lname))
                      {
                        $get_available_doctor_tomorrow_query->where('title','like','%'.$fname.'%');
                        $get_available_doctor_tomorrow_query->where('first_name','like','%'.$lname.'%');
                      } 
                  }
                  else
                  { 
                     if(isset($fname) && isset($lname))
                      {
                        $get_available_doctor_tomorrow_query->where('first_name','like','%'.$fname.'%');
                        $get_available_doctor_tomorrow_query->where('last_name','like','%'.$lname.'%');
                      } 
                  }
              }
              else
              {
                $get_available_doctor_tomorrow_query->where(function ($query) use($doctor_name){
                    $query->where('first_name','like','%'.$doctor_name.'%')
                          ->orWhere('last_name','like','%'.$doctor_name.'%');
                });
              }
            }



            // Search by Date
            if(!empty($selected_date)){ $get_available_doctor_tomorrow_query->where('date', '=', $selected_date); }

            // Search by Time
            if(!empty($selected_time))
            {
                $time = date('H:i', strtotime($selected_time));
                $get_available_doctor_tomorrow_query->where('dod_availability.start_time', '<=', $time);
                $get_available_doctor_tomorrow_query->where('dod_availability.end_time', '>=', $time);
            }

            // Search by Lanaguage
            if(!empty($language)){ $get_available_doctor_tomorrow_query->whereRaw('find_in_set(?, language)', [$language]); }

            // Search by Gender
            if(!empty($gender)){ $get_available_doctor_tomorrow_query->where('gender',$gender); }

            // Sort by Doctor Consult Fees
            if(!empty($consult_fee))
            {
                if($consult_fee == 'low')
                {
                    $sort_by = 'low_to_high';
                    $get_available_doctor_today_query->orderBy('total_patient_fee_for_four_min','ASC');
                }
                else
                {
                    $sort_by = 'high_to_low';
                    $get_available_doctor_today_query->orderBy('total_patient_fee_for_four_min','DESC');
                }
            }

            $get_available_doctor_tomorrow = $get_available_doctor_tomorrow_query->get();

            if($get_available_doctor_tomorrow)
            {
              $this->arr_view_data['available_doctor_tomorrow'] = $get_available_doctor_tomorrow;
            }
        }



        
        $selected_day = strtolower(date('D', strtotime($selected_time)));

        if(isset($selected_date) && !empty($selected_date))
        {          
            
            $get_available_doctor_on_date_query = DB::table('dod_availability')
                                                    ->select('dod_availability.*', 'dod_doctor.*', 'users.*', 'doctor_fees.*','users.id as doctor_user_id')
                                                    ->join('dod_doctor', 'dod_doctor.user_id', '=', 'dod_availability.user_id')
                                                    ->join('users', 'users.id', '=', 'dod_doctor.user_id')
                                                    ->join('doctor_fees', 'doctor_fees.doctor_id', '=', 'dod_availability.user_id')
                                                    ->where('dod_availability.date', $selected_date)
                                                    ->where('users.verification_status',1)
                                                    ->where('dod_doctor.doctor_status','live')
                                                    ->where('users.deleted_status',0)
                                                    ->where('users.user_status','Active')
                                                    ->where('users.deleted_at',null)
                                                    ->where('doctor_fees.day',$selected_day)
                                                    /*->where('doctor_fees.start_time', '<=',$current_time)
                                                    ->where('doctor_fees.end_time', '>=',$current_time)*/
                                                    ->groupBy('dod_availability.user_id');

            // Search by Title, First Name, Last Name
            if(!empty($doctor_name))
            {
              if(sizeof($doc_name_arr) == 3)
              {
                $get_available_doctor_on_date_query->where('title','like','%'.$doc_name_arr[0].'%');
                $get_available_doctor_on_date_query->where('first_name','like','%'.$doc_name_arr[1].'%');
                $get_available_doctor_on_date_query->where('last_name','like','%'.$doc_name_arr[2].'%');
              }
              else if(strstr($doctor_name, ' '))
              {
                list($fname,$lname) = explode(' ', $doctor_name);

                if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                  {
                     if(isset($fname) && isset($lname))
                      {
                        $get_available_doctor_on_date_query->where('title','like','%'.$fname.'%');
                        $get_available_doctor_on_date_query->where('first_name','like','%'.$lname.'%');
                      } 
                  }
                  else
                  { 
                     if(isset($fname) && isset($lname))
                      {
                        $get_available_doctor_on_date_query->where('first_name','like','%'.$fname.'%');
                        $get_available_doctor_on_date_query->where('last_name','like','%'.$lname.'%');
                      } 
                  }
              }
              else
              {
                $get_available_doctor_on_date_query->where(function ($query) use($doctor_name){
                    $query->where('first_name','like','%'.$doctor_name.'%')
                          ->orWhere('last_name','like','%'.$doctor_name.'%');
                });
              }
            }

            // Search by Date
            if(!empty($selected_date)){ $get_available_doctor_on_date_query->where('date', '=', $selected_date); }

            // Search by Time
            if(!empty($selected_time))
            {
                $time = date('H:i', strtotime($selected_time));
                $get_available_doctor_on_date_query->where('dod_availability.start_time', '<=', $time);
                $get_available_doctor_on_date_query->where('dod_availability.end_time', '>=', $time);
            }

            // Search by Lanaguage
            if(!empty($language)){ $get_available_doctor_on_date_query->whereRaw('find_in_set(?, language)', [$language]); }

            // Search by Gender
            if(!empty($gender)){ $get_available_doctor_on_date_query->where('gender',$gender); }

            // Sort by Doctor Consult Fees
            if(!empty($consult_fee))
            {
                if($consult_fee == 'low')
                {
                    $sort_by = 'low_to_high';
                    $get_available_doctor_on_date_query->orderBy('total_patient_fee_for_four_min','ASC');
                }
                else
                {
                    $sort_by = 'high_to_low';
                    $get_available_doctor_on_date_query->orderBy('total_patient_fee_for_four_min','DESC');
                }
            }

            $get_available_doctor_on_date = $get_available_doctor_on_date_query->get();

            if($get_available_doctor_on_date)
            {
              $this->arr_view_data['get_available_doctor_on_date'] = $get_available_doctor_on_date;
            }
        }
                                                                 
        $language_arr = $this->LanguageModel->where('language_status','1')->get();
        if($language_arr)
        {
            $this->arr_view_data['language'] = $language_arr->toArray();
        }

        $speciality_arr = $this->SpecialityModel->where('speciality_status','Active')->get();
        if($speciality_arr)
        {
            $this->arr_view_data['speciality'] = $speciality_arr->toArray();
        }


        $queries = DB::getQueryLog();
        $this->arr_view_data['sort_by']                   = $sort_by;
        $this->arr_view_data['selected_doctor_date']      = $selected_date;
        $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
        $this->arr_view_data['page_title']                = str_singular($this->module_title);
        $this->arr_view_data['module_url_path']           = $this->module_url_path;

        return view($this->module_view_folder.'.search_available_doctors',$this->arr_view_data);
    } // end search_available_doctors

    
    /*
    | Function  : Get available Doctor time details
    | Author    : Deepak Arvind Salunke
    | Date      : 04/07/2017
    | Output    : Display all the available doctors 
    */

    public function review_booking(Request $request)
    {
      $booking_time               = $request->input('booking_time');
      $booking_fee                = $request->input('booking_fee');
      $booking_fee_per_min        = $request->input('booking_fee_per_min');
      $booking_earning_for_4_min  = $request->input('booking_earning_for_4_min');

      $this->arr_view_data['booking_fee']               = $booking_fee;
      $this->arr_view_data['booking_fee_per_min']       = $booking_fee_per_min;
      $this->arr_view_data['booking_earning_for_4_min'] = $booking_earning_for_4_min;

      if(empty($booking_fee) && $booking_fee == 0 || empty($booking_fee_per_min) && $booking_fee_per_min == 0 || empty($booking_earning_for_4_min) && $booking_earning_for_4_min == 0)
      {
         Session::flash('error','Your booking session has expire please try again.');
         return redirect(url('/')."/patient/booking");
      }

      if(!empty($booking_time) && isset($booking_time))
      {
        Session::forget('booking.booking_time');

        // update session booking array
        Session::put('booking', array_add(Session::get('booking'), 'booking_time', $booking_time));
      }

      if(!empty($booking_fee) && isset($booking_fee))
      {
        Session::forget('booking.booking_fee');

        // update session booking array
        Session::put('booking', array_add(Session::get('booking'), 'booking_fee', $booking_fee));
      }

      if(!empty($booking_fee_per_min) && isset($booking_fee_per_min))
      {
        Session::forget('booking.booking_fee_per_min');

        // update session booking array
        Session::put('booking', array_add(Session::get('booking'), 'booking_fee_per_min', $booking_fee_per_min));
      }


      if(!empty(Session::get('booking.doctor_id')))
      {
        // get doctor id
        $doctor_id = Session::get('booking.doctor_id');
      }
      elseif(empty(Session::get('booking.doctor_id')))
      {
        return response()->back(url('/')."/patient/booking")->with('error', 'Your Consultation session has expire please try again.');
      }

      if(empty(Session::get('booking.patient')) || empty(Session::get('booking.symptoms')) || empty(Session::get('booking.user_type')))
      {
        return response()->back(url('/')."/patient/booking")->with('error', 'Your Consultation session has expire please try again.');
      }

      // get user type
      $user_type      = Session::get('booking.user_type');

      // check user type
      if($user_type == 'user')
      {
        $arr_patient_details = $this->UserModel->where('id', $this->user_id)->first();
        if($arr_patient_details)
        {
          $this->arr_view_data['patient_details'] = $arr_patient_details->toArray();
        }
      }
      else if($user_type == 'family')
      {
        $family_user_id = Session::get('booking.patient');
        $arr_patient_details = $this->FamilyMemberModel->where('id',$family_user_id)->where('user_id', $this->user_id)->first();
        if($arr_patient_details)
        {
          $this->arr_view_data['patient_details'] = $arr_patient_details->toArray();
        }
      }

      $get_doctor = $this->AvailabilityModel->with(['user_details' => function($user){
                                                      $user->where('verification_status',1);
                                                      $user->where('deleted_status',0);
                                                      $user->where('user_status','Active');
                                                      $user->where('deleted_at',null);
                                                  }])
                                            ->with('doctor_details')
                                            ->where('user_id', $doctor_id)
                                            ->orderBy('id','DESC')
                                            ->first();
      if($get_doctor)
      {
        $this->arr_view_data['doctor_details'] = $get_doctor->toArray();
      }

      $this->arr_view_data['payment_details'] = $this->get_card_listing();
      
      $admin_fees_arr = $this->DoctroFeesModel->where('id','1')->first();      
      
      if($admin_fees_arr)
      {
        $this->arr_view_data['admin_fees_arr'] = $admin_fees_arr->toArray();
      }

      /*--------------------------------------------- Stripe Payment Start ---------------------------------------------*/

      $this->arr_view_data['stripeKey']                 = config('services.stripe.STRIPE_KEY');
      $this->arr_view_data['formAction']                = url('/').'/patient/booking/payment/stripe/makePayment/';
      $this->arr_view_data['cancelUrl']                 = url('/').'/patient/booking/payment/cancel/';
      $this->arr_view_data['errorUrl']                  = url('/').'/patient/booking/payment/error/';

      $this->arr_view_data['boxName']                   = "doctoroo";
      $this->arr_view_data['boxDesc']                   = 'Payment for Doctor Booking (AUD $24)';
      $this->arr_view_data['boxPrice']                  = $booking_fee;
      $this->arr_view_data['boxEmail']                  = 'deepak@webwingtechnologies.com';

      /*--------------------------------------------- Stripe Payment End ---------------------------------------------*/


      $this->arr_view_data['doctor_pricing_fees']       = $this->get_doctor_fee_prices($doctor_id);
      $this->arr_view_data['booking_time']              = $booking_time;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      //dump(Session::get('booking'));
      return view($this->module_view_folder.'.review_booking',$this->arr_view_data);
    } // end review_booking



    /*
    | Function  : Get customer id and by using it get all the card details from stripe account
    | Author    : Deepak Arvind Salunke
    | Date      : 17/10/2017
    | Output    : return array list
    */

    public function get_card_listing()
    {
        $get_customer_id = $this->StripeCardModel->where('user_id',$this->user_id)
                                                 ->get();
        if($get_customer_id)
        {
          $customer_list = $get_customer_id->toArray();
        }

        $new_card_details = [];

        foreach($customer_list as $cust_list)
        {
          \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
          $customer = \Stripe\Customer::retrieve($cust_list['customer_id']);
          $card = $customer->sources->retrieve($cust_list['card_id']);

          $card_details['id']         = $cust_list['id'];
          $card_details['customer_id']= $customer->id;
          $card_details['customer_id']= $customer->id;
          $card_details['card_type']  = $card->brand;
          $card_details['card_no']    = $card->last4;

          $month  = str_pad($card->exp_month, 2, "0", STR_PAD_LEFT);
          $year   = substr($card->exp_year, -2);

          $card_details['card_expiry_date'] = $month.'/'.$year;
          $card_details['cvv']  = '';

          $new_card_details[] = $card_details;
        }

        return $new_card_details;

    } // end get_card_listing



    /*
    | Function  : Get all the data for Doctor Booking Prices for Patient
    | Author    : Deepak Arvind Salunke
    | Date      : 07/07/2017
    | Output    : Display all the data for Doctor Booking Prices for Patient
    */

    public function pricing_details(Request $request)
    {
      
      $consultation_prices = $this->ConsultationPriceModel->where('doctor_day_fee', 0)
                                                          ->where('day_profit', 0)
                                                          ->where('day_profit', 0)
                                                          ->where('doctor_night_fee', 0)
                                                          ->where('night_profit', 0)
                                                          ->get();
      if($consultation_prices)
      {
        $this->arr_view_data['arr_consultation_prices'] = $consultation_prices->toArray();
      }

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.pricing_details',$this->arr_view_data);
    } // end pricing_details


    /*
    | Function  : After successful payment, Store all the Doctor booking data in database, get user and doctor details.
    | Author    : Deepak Arvind Salunke
    | Date      : 10/07/2017
    | Output    : Show Doctor, Patient details and Time & Date of Doctor appointment
    */

    public function booking_request_confirmation(Request $request, $enc_id = false)
    {
      $get_user_id  = $this->user_id;
      $current_date = date("Y-m-d");

      if($enc_id == false)
      {
        $patient_id       = Session::get('booking.patient');
        $user_type        = Session::get('booking.user_type');
        $doctor_id        = Session::get('booking.doctor_id');
        $booking_id       = Session::get('booking_id');

        $get_consult_data = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                                  ->where('patient_user_id', $this->user_id)
                                                                  ->where('doctor_user_id', $doctor_id)
                                                                  ->first();
                                                                
        if($get_consult_data)
        {
          $consult_data = $get_consult_data->toArray();
        }
      }
      else
      {
        $booking_id = base64_decode($enc_id);
        $get_consult_data = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                  ->where('id', $booking_id)
                                                                  ->with('booking_status_data')
                                                                  ->first();
        if($get_consult_data)
        {
          $consult_data = $get_consult_data->toArray();
        }

        $patient_id       = $consult_data['patient_user_id'];
        $doctor_id        = $consult_data['doctor_user_id'];
        $family_member_id = $consult_data['family_member_id'];

        if($family_member_id == 0)
        {
          $user_type      = "user";
        }
        else if($family_member_id != 0)
        {
          $user_type      = "family";
          $patient_id     = $family_member_id;
        }

        $this->arr_view_data['enc_booking_id'] = $enc_id;
      }

      // get doctor details
      $get_doctor_data = $this->DoctorModel->where('user_id', $doctor_id)
                                           ->with('userinfo')
                                           ->first();
      if($get_doctor_data)
      {
        $this->arr_view_data['doctor_details'] = $get_doctor_data->toArray();
      }

      if($user_type == 'user')
      {
        $user                               = Sentinel::check();
        $this->arr_view_data['user_name']   = $user->title.' '.$user->first_name.' '.$user->last_name;
        $this->arr_view_data['first_name']  = $user->first_name;
        $this->arr_view_data['last_name']   = $user->last_name;
        $this->arr_view_data['title']       = $user->title;
        $this->arr_view_data['patient_id']  = $user->id;
      }
      else if($user_type == 'family')
      {
        $arr_family_members = $this->FamilyMemberModel->where('id', $patient_id)
                                                      ->where('user_id', $this->user_id)
                                                      ->select('first_name','last_name')
                                                      ->first();
        if($arr_family_members)
        {
          $user                               = Sentinel::check();
          $family_data = $arr_family_members->toArray();
          $this->arr_view_data['user_name']   = $family_data['first_name'].' '.$family_data['last_name'];
          $this->arr_view_data['first_name']  = $family_data['first_name'];
          $this->arr_view_data['last_name']   = $family_data['last_name'];
          $this->arr_view_data['title']       = '';
          $this->arr_view_data['patient_id']  = $user->id;
        }
      }

      $this->arr_view_data['doctor_pricing_fees']       = $this->get_doctor_fee_prices($doctor_id);
      $this->arr_view_data['booking_time']              = Session::get('booking.booking_time');
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.booking_request_confirmation',$this->arr_view_data);
    } // end booking_request_confirmation


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 10/07/2017
    | Output    : Show booking cancellation information
    */

    public function cancellation_refunds(Request $request)
    {
      
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.cancellation_refunds',$this->arr_view_data);
    } // end cancellation_refunds


    /*
    | Function  : Display emergencies warning page
    | Author    : Deepak Arvind Salunke
    | Date      : 11/07/2017
    | Output    : Show emergencies warning information
    */

    public function emergencies_warning(Request $request)
    {
      
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.emergencies_warning',$this->arr_view_data);
    } // end emergencies_warning


    /*
    | Function  : Get all the Consultations data according to the given id or while booking
    | Author    : Deepak Arvind Salunke
    | Date      : 11/07/2017
    | Output    : Show data for the given Consultations 
    */

    public function online_waiting_room(Request $request, $enc_id = false)
    {
      $current_datetime = date('Y-m-d H:i:s');
      $current_date     = date('Y-m-d');
      $current_time     = date('H:i:s');

      // Consultations details
      if($enc_id == false)
      {
        $get_consult_data = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                  ->orderBy('id', 'DESC')
                                                                  ->first();
      }
      else
      {
        $booking_id = base64_decode($enc_id);
        $get_consult_data = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                  ->where('id', $booking_id)
                                                                  ->with('booking_status_data')
                                                                  ->first();
      }

      if($get_consult_data)
      {
        $consultation_data       = $get_consult_data->toArray();
      }
      else
      {
        return redirect(url('/')."/patient/dashboard");
      }

      if($enc_id == false)
      {
        $booking_id = $consultation_data['id'];
      }

      $startdate = $current_datetime;
      $enddate   = $consultation_data['consultation_datetime'];

      $this->arr_view_data['diff_time'] = Self::difference_bet_time($startdate,$enddate);
      
      // get doctor details
      $get_doctor_data = $this->DoctorModel->where('user_id', $consultation_data['doctor_user_id'])
                                           ->with('userinfo')
                                           ->first();
      if($get_doctor_data)
      {
        $this->arr_view_data['doctor_details'] = $get_doctor_data->toArray();
      }

      // Track all the action for the selected Consultation
      $booking_track = $this->PatientConsultationStatusModel->where('user_id', $this->user_id)
                                                            ->where('booking_id',$booking_id)
                                                            ->where('doctor_id' ,$consultation_data['doctor_user_id'])
                                                            ->with('userinfo')
                                                            ->get();
      if($booking_track)
      {
        $this->arr_view_data['booking_status'] = $booking_track->toArray();
      }
      //dd($consultation_data);

      $this->arr_view_data['patient_id']                = $this->user_id;
      $this->arr_view_data['enc_booking_id']            = base64_encode($booking_id);
      $this->arr_view_data['current_login_user']        = $this->user_id;
      $this->arr_view_data['current_datetime']          = $current_datetime;
      $this->arr_view_data['consultation_datetime']     = $enddate;
      $this->arr_view_data['consultation_data']         = $consultation_data;

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.online_waiting_room',$this->arr_view_data);
    } // end online_waiting_room


    /*
    | Function  : Get two different start and end time, to get difference between them
    | Author    : Deepak Arvind Salunke
    | Date      : 17/07/2017
    | Output    : Return the output
    */

    public function difference_bet_time($startdate, $enddate)
    {
      $diff=strtotime($enddate)-strtotime($startdate); 

      // immediately convert to days 
      $temp=$diff/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day 

      // days 
      $days=floor($temp);
      $temp=24*($temp-$days);
      
      // hours 
      $hours=floor($temp);
      $temp=60*($temp-$hours); 

      // minutes 
      $minutes=floor($temp);
      $temp=60*($temp-$minutes); 
      
      // seconds 
      $seconds=floor($temp);

      if($days > 0)
      {
        $days = $days.' days';
      }
      else
      {
        $days ="";
      }

      if($hours > 0)
      {
        $hours = $hours.' hrs';
      }
      else
      {
        $hours ="";
      }

      if($minutes > 0)
      {
        $minutes = $minutes.' mins';
      }
      else
      {
        $minutes ="";
      }

      //Format "{$days}days {$hours}hrs {$minutes}mins {$seconds}secs";
      return "{$days} {$hours} {$minutes} {$seconds} secs";
    } // end difference_bet_time


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 10/07/2017
    | Output    : Show booking cancellation information
    */

    public function stripe_payment(Request $request)
    {
      
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.stripe_payment',$this->arr_view_data);
    } // end stripe_payment


    /*
    | Function  : get selected doctor personal information
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Show doctor profile
    */

    public function profile_about(Request $request, $enc_id, $enc_date)
    {
      $doctor_id  = base64_decode($enc_id);
      $get_date   = base64_decode($enc_date);

      $doctor_data = $this->DoctorModel->where('user_id', $doctor_id)
                                       ->with('userinfo')
                                       ->first();
      if($doctor_data)
      {
        $this->arr_view_data['doctor_arr'] = $doctor_data->toArray();
        
        if(isset($this->arr_view_data['doctor_arr']['language']) && !empty($this->arr_view_data['doctor_arr']['language']))
        {
          $language_id_arr = explode(',', $this->arr_view_data['doctor_arr']['language']);

            $languages = $this->LanguageModel->whereIn('id', $language_id_arr)
                                             ->get();
            if(isset($languages) && !empty($languages))
            {
              $this->arr_view_data['languages_arr'] = $languages->toArray();
            }                                             
        }
      }
      
      $getDoctorFees =\DB::table('doctor_fees')->where('doctor_id' , $doctor_id)->get();
      if(isset($getDoctorFees) && count($getDoctorFees)>0)
      {
        $this->arr_view_data['getDoctorFees']       = $getDoctorFees;
      }

      $this->arr_view_data['doctor_pricing_fees']       = $this->get_doctor_fee_prices($doctor_id);
      $this->arr_view_data['get_selected_date']         = $get_date;
      $this->arr_view_data['doctor_video_url']          = $this->doc_video;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;
      return view($this->module_view_folder.'.profile_about',$this->arr_view_data);
    } // end profile_about


    /*
    | Function  : get all the consultation details
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : Show Confirm booking details
    */

    public function confirm_booking(Request $request, $enc_id = false)
    {
      $booking_id = base64_decode($enc_id);

      if($enc_id == false)
      {
        return redirect()->back();
      }
      else
      {
        $booking_id = base64_decode($enc_id);
        $get_consult_data = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                  ->with('patient_user_details')
                                                                  ->with('doctor_user_details')
                                                                  ->where('id', $booking_id)
                                                                  ->first();
      }

      if($get_consult_data)
      {
        $consult_data = $get_consult_data->toArray();
      }
      //dd($consult_data);

      $this->arr_view_data['consult_data']              = $consult_data;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.confirm_booking',$this->arr_view_data);
    } // end confirm_booking


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 01/09/2017
    | Output    : 
    */

    public function consultation_details($enc_id = false)
    {
      // Consultations details
      if($enc_id == false)
      {
        return redirect()->back();
      }
      else
      {
        $booking_id = base64_decode($enc_id);
        $get_consult_data = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                  ->with('patient_user_details')
                                                                  ->with('doctor_user_details')
                                                                  ->with('booking_status_data')
                                                                  ->where('id', $booking_id)
                                                                  ->first();
      }

      if($get_consult_data)
      {
        $consultation_data       = $get_consult_data->toArray();
      }
      else
      {
        return redirect(url('/')."/patient/dashboard");
      }

      if($enc_id == false)
      {
        $booking_id = $consultation_data['id'];
      }

      $this->arr_view_data['consult_data']              = $consultation_data;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.consultation_details',$this->arr_view_data);
    } // end consultation_details


    /*
    | Function  : Get the key word to search doctor
    | Author    : Deepak Arvind Salunke
    | Date      : 01/08/2017
    | Output    : Success or error and doctor details
    */

    public function search_doctor_name(Request $request)
    {
      $doc_keyword = $request->doc_keyword;

      $date         = date('Y-m-d');
      $tomorrow     = date("Y-m-d",strtotime('+1 day'));
      $current_time = date("H:i");

      $doc_name_arr = explode(' ', $doc_keyword);

      $doctor_name = $this->DoctorModel->with(['userinfo' => function($user) use($doc_keyword) {
                                            $user->where('verification_status',1);
                                            $user->where('deleted_status',0);
                                            $user->where('user_status','Active');
                                            $user->where('deleted_at',null);
                                         }])
                                        ->whereHas('userinfo', function($user_details) use($doc_keyword,$doc_name_arr) {
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
                                              list($fname,$lname) = explode(' ', $doc_keyword);
                                              if($fname == 'Capt' || $fname =='Dean' || $fname =='Dr' || $fname =='Father' || $fname =='Gen' || $fname =='Gov' || $fname =='Hon' || $fname =='Maj' || $fname =='Mr' || $fname =='Mrs' || $fname =='Prince' || $fname =='Prof' || $fname =='RabbiRev' || $fname =='Rev' || $fname =='Sister' || $fname =='Ms' || $fname == 'capt' || $fname =='dean' || $fname =='dr' || $fname =='father' || $fname =='gen' || $fname =='gov' || $fname =='hon' || $fname =='maj' || $fname =='mr' || $fname =='mrs' || $fname =='prince' || $fname =='prof' || $fname =='rabbiRev' || $fname =='rev' || $fname =='sister' || $fname =='ms')
                                              {
                                                $user_details->where('title','like','%'.$fname.'%');  
                                                $user_details->Where('first_name','like','%'.$lname.'%');   
                                              }
                                              else
                                              {
                                                $user_details->where('first_name','like','%'.$fname.'%');
                                                $user_details->Where('last_name','like','%'.$lname.'%');   
                                              }
                                              
                                              
                                            }
                                            else
                                            {
                                              $user_details->where('first_name','like','%'.$doc_keyword.'%');
                                              $user_details->orWhere('last_name','like','%'.$doc_keyword.'%');  
                                              $user_details->orWhere('title','like','%'.$doc_keyword.'%');  
                                            }
                                            
                                        })
                                        ->whereHas('doctor_premium_rates', function($premium_details) {

                                          })
                                        ->whereHas('doctor_available',function($avail) use($date,$current_time){
                                              //$avail->where('date', $date);
                                              //$avail->where('end_time', '>=', $current_time);
                                        })
                                        ->get();

      $newdoctor_arr = [];
      if(sizeof($doc_name_arr) <= 3 )
      {
        if($doctor_name)
      {
        $doctor_arr = $doctor_name->toArray();

        foreach ($doctor_arr as $key => $value) {

        if($doctor_arr[$key]['userinfo'] != '') 
         $newdoctor_arr[] = $value;
        }
        
        $arr_json['status'] = 'success';
        $arr_json['data']   = $newdoctor_arr;
      }
      else
      {
        $arr_json['status'] = 'error';        
      }
  
      }
      else
      {
        $arr_json['data']   = []; 
        $arr_json['status'] = 'error';        
      }
      
      

      return response()->json($arr_json);
    } // end search_doctor_name


    /*
    | Function  : Store all the booking data
    | Author    : Deepak Arvind Salunke
    | Date      : 02/08/2017
    | Output    : Success or Error and redirect to booking request confirmation page
    */


    public function store_booking()
    {
      $patient_id = $user_type = $doctor_id = $advice_treatment = $prescriptions_repeats = $medical_cetificate = $other = $other_reason = $symptoms = $medical_files = $get_user_id = "";
      $patient_data = [];

      if(!empty(Session::get('last_payment_method_id')))
      {
        Session::forget('last_payment_method_id');
      }

      //count total no of consultation booking
      $count_consultation = $this->PatientConsultationBookingModel->count();
      if($count_consultation <= 0)
      {
        $patient_data['consultation_id'] = "C00401";
      }
      else
      {
        //get the last consultation_id
        $get_id  = $this->PatientConsultationBookingModel->latest()->first();
        if($get_id)
        {
          $new_id = substr($get_id->consultation_id, 1);
          $patient_data['consultation_id'] = "C".str_pad($new_id+1, 5, '0', STR_PAD_LEFT);
        }
      }

      $patient_id       = Session::get('booking.patient');
      $user_type        = Session::get('booking.user_type');
      $doctor_id        = Session::get('booking.doctor_id');
      $symptoms         = Session::get('booking.symptoms');

      $booking_fee      = Session::get('booking.booking_fee');
      $booking_fee_per_min = Session::get('booking.booking_fee_per_min');

      $session_time     = Session::get('booking.booking_time');
      $booking_date     = date("Y-m-d", strtotime(substr($session_time,10)));
      $booking_time     = date("H:i:s", strtotime(substr($session_time,0,8)));
      $booking_datetime = $booking_date.' '.$booking_time;
      $new_datetime     = date("Y-m-d H:i:s", strtotime($booking_datetime));
      $utc_booking_datetime = convert_userdatetime_to_utc($this->user_id, "patient", $new_datetime);

      $patient_data['consultation_date']      = date("Y-m-d",strtotime($utc_booking_datetime));
      $patient_data['consultation_time']      = date("H:i",strtotime($utc_booking_datetime));
      $patient_data['consultation_datetime']  = date("Y-m-d",strtotime($utc_booking_datetime)).' '.date("H:i",strtotime($utc_booking_datetime));


      // Reason for seeing doctor
      if(Session::get('booking.advice_treatment') != null  && !empty(Session::get('booking.advice_treatment')))
      {
        $advice_treatment                     = Session::get('booking.advice_treatment');
      }
      if(Session::get('booking.prescriptions_repeats') != null && !empty(Session::get('booking.prescriptions_repeats')))
      {
        $prescriptions_repeats                = Session::get('booking.prescriptions_repeats');
      }
      if(Session::get('booking.medical_cetificate') != null && !empty(Session::get('booking.medical_cetificate')))
      {
        $medical_cetificate                   = Session::get('booking.medical_cetificate');
      }
      if(Session::get('booking.other') != null && !empty(Session::get('booking.other')))
      {
        $other                                = Session::get('booking.other');
      }
      if(Session::get('booking.medical_files') != null && !empty(Session::get('booking.medical_files')))
      {
        $medical_files                        = Session::get('booking.medical_files');
      }
      if(Session::get('booking.transaction_id') != null && !empty(Session::get('booking.transaction_id')))
      {
        $transaction_id                       = Session::get('booking.transaction_id');
      }

      // check if patient is user or his family members

      $family_member_id = '';
      $patient_user_id = '';

      $added_on = date('Y-m-d H:i');

      if($user_type == 'user')
      {
        $patient_data['patient_user_id']       = $patient_id;
        $patient_user_id                       = $patient_id;
      }
      if($user_type == 'family')
      {
        $patient_data['family_member_id']      = $patient_id;
        $patient_data['patient_user_id']       = $this->user_id;
        $family_member_id                      = $patient_id;
      }

      $patient_data['symptoms']                = $symptoms;
      $patient_data['health_image']            = $medical_files;
      $patient_data['doctor_user_id']          = $doctor_id;
      $patient_data['consultation_for']        = $advice_treatment.','.$prescriptions_repeats.','.$medical_cetificate.','.$other.','.$other_reason;
      $patient_data['transaction_id']          = $transaction_id;
      //$patient_data['card_number']             = $card_no;
      $patient_data['consultation_charge']     = $booking_fee;
      $patient_data['consultation_charge_per_min'] = $booking_fee_per_min;
      $patient_data['added_on']                = $added_on;
      /*$patient_data['card_exp_month']          = $expire_month;
      $patient_data['card_exp_year']           = $expire_year;*/
      
      // Store Booking details
      $booking_id     = $this->PatientConsultationBookingModel->insertGetId($patient_data);
      

      if(Session::has('medical_files'))
      {
        if(!empty(Session::get('medical_files')))
        {
            $file_arr = Session::get('medical_files');

            foreach($file_arr as $file)
            {
              if(!empty($file))
              {
                 $data_arr['user_id'] = $this->user_id;
                 $data_arr['family_member_id'] = $family_member_id;
                 $data_arr['booking_id'] = $booking_id;
                 $data_arr['health_image'] = $file;
                 $this->PatientConsultationImagesModel->create($data_arr);
              }
            }
            
        }
      }
       
      $booking_data['booking_id']   = $booking_id;
      $booking_data['user_id']      = $this->user_id;
      $booking_data['doctor_id']    = $doctor_id;
      $booking_data['performed_by'] = $this->user_id;
      $booking_data['status']       = 'Pending';

      $booking_status = $this->PatientConsultationStatusModel->create($booking_data);
      
      /* -- send mail to client -- */
        /* content variables in view */
            $user = Sentinel::findById($this->user_id);
            $content['first_name']                  = $user->first_name;
            $content['last_name']                   = $user->last_name;
            $content['email']                       = $user->email;
            $content['consultation_id']             = $patient_data['consultation_id'];
            $content['consultation_charge']         = (float) $booking_fee;
            $content['consultation_charge_per_min'] = (float) $booking_fee_per_min;
        /* end content variables in view */


        /* built content variables in view */
            $content =  view('front.email.pre_consult_payment',compact('content'))->render();
            $content =  html_entity_decode($content);
        /* end built content variables in view */
       
        $to_email_id  = $user->email;
        $project_name = config('app.project.name');
        $mail_subject = 'Consultation request is send and payment is pre-auth';

        /* get admin email */
            $get_admin = $this->AdminProfileModel->first();
            $get_admin = $get_admin->toArray();
            $mail_form = $get_admin['contact_email'];
        /* end get admin email */    

        if(!empty($mail_form))
        {
            $mail_form = $mail_form;
        }
        else
        {
            $mail_form = config('app.project.admin_email');
        }
        $mail_form     = $mail_form;

        $send_mail = Mail::send(array(), array(), function ($message) use ($to_email_id, $mail_form, $project_name, $mail_subject, $content) {
              $message->from($mail_form, $project_name);
              $message->to($to_email_id)
              ->subject($mail_subject)
              ->setBody($content, 'text/html');
        });
      /* -- end  mail to client-- */

      //$this->NotificationModel->from_user_id =  $this->user_id;
      $this->NotificationModel->from_user_id =  '';
      $this->NotificationModel->to_user_id   =  $doctor_id;
      $this->NotificationModel->booking_id   =  $booking_id;
      $this->NotificationModel->message      =  "Patient has requested a new consultation";
      $this->NotificationModel->save();

      if(Session::get('booking_id') != null && !empty(Session::get('booking_id')))
      {
        Session::forget('booking_id');
      }
      Session::put(array('booking_id' => $booking_id));

      if($booking_id && $booking_status)
      {
        return redirect(url('').'/patient/booking/booking_request_confirmation');
      }
      else
      {
        return redirect(url('').'/patient/booking/review_booking');
      }

    } // end store_booking

    /*
    | Function  : Reschedule consultation and store timing
    | Author    : Deepak Arvind Salunke
    | Date      : 02/08/2017
    | Output    : Success or Error and redirect to booking request confirmation page
    */

    public function reschedule_consultation($enc_id = false)
    {
      if($enc_id == false)
      {
        $booking_id = Session::get('booking_id');
      }
      else
      {
        $booking_id = base64_decode($enc_id);
      }

      $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                                ->where('patient_user_id', $this->user_id)
                                                                ->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
      }

      $doctor_id      = $booking_data['doctor_user_id'];
      $selected_date  = $booking_data['consultation_date'];

      /*$admin_fees_arr = $this->DoctroFeesModel->where('id','1')->first();      
      if($admin_fees_arr)
      {
        $this->arr_view_data['admin_fees_arr'] = $admin_fees_arr->toArray();
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
      }
      
      $time_interval = $this->DoctorTimeIntervalModel->select('time_interval')->first();

      if(isset($time_interval))
      {
        $this->arr_view_data['time_interval'] = $time_interval->time_interval;
      }

      $consultation_prices = $this->ConsultationPriceModel->where('doctor_day_fee', 0)
                                                          ->where('day_profit', 0)
                                                          ->where('day_profit', 0)
                                                          ->where('doctor_night_fee', 0)
                                                          ->where('night_profit', 0)
                                                          ->get();
      if($consultation_prices)
      {
        $this->arr_view_data['arr_consultation_prices'] = $consultation_prices->toArray();
      }

      $current_day  = strtolower(date("D"));
      $fees_arr = $this->DoctorFeeModel->where('doctor_id',$doctor_id)->where('day', $current_day)->get();
      if($fees_arr)
      {
        $this->arr_view_data['fees_arr'] = $fees_arr->toArray();
      }

      $get_highest_fees_arr = $this->DoctorFeeModel->where('doctor_id',$doctor_id)->orderBy('total_patient_fee_for_four_min', 'DESC')->first();
      if($get_highest_fees_arr)
      {
        $this->arr_view_data['highest_fees'] = $get_highest_fees_arr->toArray();
      }*/


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

      $current_datetime = convert_utc_to_userdatetime($this->user_id, "patient", date("Y-m-d H:i:s"));
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
          // convert doctor aviliable time to patient timezone
          $start_time = convert_utc_to_userdatetime($this->user_id, "patient", $doc_avail['start_time']);
          $end_time = convert_utc_to_userdatetime($this->user_id, "patient", $doc_avail['end_time']);

          // get patient current time
          $current_time = convert_utc_to_userdatetime($this->user_id, "patient", date("Y-m-d H:i:s"));

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
                          $fee_doc_start = convert_utc_to_userdatetime($this->user_id, "patient", $doc_fee['start_time']);
                          $fee_start = substr($fee_doc_start, 11);

                          $fee_doc_end = convert_utc_to_userdatetime($this->user_id, "patient", $doc_fee['end_time']);
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
      
      $this->arr_view_data['doc_fee_time_slot']         = $arr_doc_time_slot;      
      $this->arr_view_data['enc_doctor_id']             = base64_encode($doctor_id);
      $this->arr_view_data['enc_booking_id']            = $enc_id;
      $this->arr_view_data['get_selected_date']         = $selected_date;
      $this->arr_view_data['doctor_video_url']          = $this->doc_video;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.reschedule_profile_availibility',$this->arr_view_data);

    } // end reschedule_consultation


    /*
    | Function  : Cancel the consultation and store the reason
    | Author    : Deepak Arvind Salunke
    | Date      : 02/08/2017
    | Output    : Success or Error and redirect to online waiting room
    */

    public function cancel_consultation(Request $request, $enc_id = false)
    {
      if($enc_id == false)
      {
        $booking_id = Session::get('booking_id');
      }
      else
      {
        $booking_id = base64_decode($enc_id);
      }

      $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                                ->where('patient_user_id', $this->user_id)
                                                                ->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
      }

      $booking_cancel_reason      = $request->input('booking_cancel_reason');

      if($booking_cancel_reason == 'Other')
      {
        $other_reason             = $request->input('other_reason');
        $cancel_data['comment']   = $other_reason;
      }
      else
      {
        $cancel_data['comment']   = $booking_cancel_reason;
      }

      $cancel_data['booking_id']    = $booking_id;
      $cancel_data['user_id']       = $this->user_id;
      $cancel_data['doctor_id']     = $booking_data['doctor_user_id'];
      $cancel_data['performed_by']  = $this->user_id;
      $cancel_data['status']        = 'Cancelled';

      $get_count = $this->PatientConsultationStatusModel->where('booking_id', $booking_id)
                                                        ->where('user_id', $this->user_id)
                                                        ->where('doctor_id', $booking_data['doctor_user_id'])
                                                        ->where('status', 'Cancelled')
                                                        ->count();
      if($get_count > 0)
      {
        Session::set('message', 'Consultation has already been cancelled');
        if($enc_id == false)
        {
          return redirect(url('').'/patient/booking/online_waiting_room');
        }
        else
        {
          return redirect()->back();
        }
      }

      $update_data['booking_status'] = 'Cancelled';
      $update_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                                   ->where('patient_user_id', $this->user_id)
                                                                   ->where('doctor_user_id', $booking_data['doctor_user_id'])
                                                                   ->update($update_data);

      
      $noti_arr['from_user_id'] = $this->user_id;
      $noti_arr['to_user_id']   = $booking_data['doctor_user_id'];
      $noti_arr['booking_id']   = $booking_id;
      $noti_arr['message']      = "has cancelled consultation";
      
      $notification_res = $this->NotificationModel->create($noti_arr);                                                                   

      $inserted = $this->PatientConsultationStatusModel->create($cancel_data);

      if($notification_res && $inserted)
      {
        Session::set('message', 'Consultation has been cancelled successfully');
      }

      if($inserted)
      {
        if($enc_id == false)
        {
          return redirect(url('').'/patient/booking/online_waiting_room');
        }
        else
        {
          return redirect()->back();
        }
      }
      else
      {
        return redirect()->back();
      }

    } // end cancel_consultation

    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 12/08/2017
    | Output    : 
    */

    public function reschedule_update_consultation(Request $request, $enc_id = false)
    {
      $booking_id                 = base64_decode($enc_id);
      $booking_time               = $request->input('booking_time');
      $booking_fee                = $request->input('booking_fee');
      $booking_fee_per_min        = $request->input('booking_fee_per_min');
      $booking_earning_for_4_min  = $request->input('booking_earning_for_4_min');

      $total_amount = add_gst($booking_fee);

      $time = substr($booking_time, 0, strpos($booking_time, ','));
      $date = substr($booking_time, 10);

      $get_consult_data = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                                ->where('id', $booking_id)
                                                                ->with('booking_status_data')
                                                                ->first();
      if($get_consult_data)
      {
        $consult_data = $get_consult_data->toArray();
      }

      $patient_id       = $consult_data['patient_user_id'];
      $doctor_id        = $consult_data['doctor_user_id'];
      $family_member_id = $consult_data['family_member_id'];
      $charge_id        = $consult_data['transaction_id'];

      // get connected account id
      $get_account_data = $this->StripeConnectedAccountsModel->where('user_id', $doctor_id)->first();
      if($get_account_data)
      {
        $account_data = $get_account_data->toArray();
      }

      // get payment details for new charge
      Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
      $payment = Stripe\Charge::retrieve($charge_id);

      // for Payment
      try{

          // refund capture charge created while booking
          $refund = Stripe\Refund::create(array(
            "charge" => $charge_id
          ));

      }
      catch (\Stripe\Error\RateLimit $ex_refund)
      {
          $refund = $ex_refund->getJsonBody();
          $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
      }
      catch (\Stripe\Error\InvalidRequest $ex_refund)
      {
          // Invalid parameters were supplied to Stripe's API
          $refund = $ex_refund->getJsonBody();
          $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
      }
      catch (\Stripe\Error\Authentication $ex_refund)
      {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
          $refund = $ex_refund->getJsonBody();
          $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
      }
      catch (\Stripe\Error\ApiConnection $ex_refund)
      {
          // Network communication with Stripe failed
          $refund = $ex_refund->getJsonBody();
          $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
      }
      catch (\Stripe\Error\Base $ex_refund)
      {
          // Display a very generic error to the user, and maybe send
          $refund = $ex_refund->getJsonBody();
          $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
          // yourself an email
      }
      catch (Exception $ex_refund)
      {
          // Something else happened, completely unrelated to Stripe
          $refund = $ex_refund->getJsonBody();
          $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
      }

      if(($userMsg != null) && !empty($userMsg))
      {
        Session::flash('message', $userMsg);
        return redirect()->back();
      }

      if($refund['status'] == 'succeeded')
      {
          // for Payment
          try{

              // new charge for payment
              $new_charge = Stripe\Charge::create(array(
                "customer"        => $payment->customer,
                "source"          => $payment->source->id,
                "amount"          => (int) $total_amount * 100,
                "capture"         => false,
                "currency"        => "AUD",
                "destination"     => array(
                      "account"   => $account_data['connect_id'],
                    ),
              ));
          }
          catch (\Stripe\Error\RateLimit $ex_new_charge)
          {
              $new_charge = $ex_new_charge->getJsonBody();
              $userMsg = 'Transaction failed - '.$new_charge['error']['message'].'.';
          }
          catch (\Stripe\Error\InvalidRequest $ex_new_charge)
          {
              // Invalid parameters were supplied to Stripe's API
              $new_charge = $ex_new_charge->getJsonBody();
              $userMsg = 'Transaction failed - '.$new_charge['error']['message'].'.';
          }
          catch (\Stripe\Error\Authentication $ex_new_charge)
          {
              // Authentication with Stripe's API failed
              // (maybe you changed API keys recently)
              $new_charge = $ex_new_charge->getJsonBody();
              $userMsg = 'Transaction failed - '.$new_charge['error']['message'].'.';
          }
          catch (\Stripe\Error\ApiConnection $ex_new_charge)
          {
              // Network communication with Stripe failed
              $new_charge = $ex_new_charge->getJsonBody();
              $userMsg = 'Transaction failed - '.$new_charge['error']['message'].'.';
          }
          catch (\Stripe\Error\Base $ex_new_charge)
          {
              // Display a very generic error to the user, and maybe send
              $new_charge = $ex_new_charge->getJsonBody();
              $userMsg = 'Transaction failed - '.$new_charge['error']['message'].'.';
              // yourself an email
          }
          catch (Exception $ex_new_charge)
          {
              // Something else happened, completely unrelated to Stripe
              $new_charge = $ex_new_charge->getJsonBody();
              $userMsg = 'Transaction failed - '.$new_charge['error']['message'].'.';
          }

          if(($userMsg != null) && !empty($userMsg))
          {
            Session::flash('message', $userMsg);
            return redirect()->back();
          }

      }

      $booking_data['consultation_charge']         = $booking_fee;
      $booking_data['consultation_charge_per_min'] = $booking_fee_per_min;
      $booking_data['transaction_id']              = $new_charge->id;
      $booking_data['consultation_date']           = date("Y-m-d",strtotime($date));
      $booking_data['consultation_time']           = date("H:i",strtotime($time));
      $booking_data['consultation_datetime']       = date("Y-m-d",strtotime($date)).' '.date("H:i",strtotime($time));
      $booking_data['booking_status']              = "Pending";


      $update_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                                   ->where('patient_user_id', $this->user_id)
                                                                   ->update($booking_data);

      if($family_member_id == 0)
      {
        $user_type      = "user";
      }
      else if($family_member_id != 0)
      {
        $user_type      = "family";
        $patient_id     = $family_member_id;
      }

      $this->arr_view_data['enc_booking_id'] = $enc_id;
      

      // get doctor details
      $get_doctor_data = $this->DoctorModel->where('user_id', $doctor_id)
                                           ->with('userinfo')
                                           ->first();
      if($get_doctor_data)
      {
        $this->arr_view_data['doctor_details'] = $get_doctor_data->toArray();
      }
      //dd($this->arr_view_data['doctor_details']);

      if($user_type == 'user')
      {
        $user                               = Sentinel::check();
        $this->arr_view_data['user_name']   = $user->title.' '.$user->first_name.' '.$user->last_name;
        
        
      }
      else if($user_type == 'family')
      {
        $arr_family_members = $this->FamilyMemberModel->where('id', $patient_id)
                                                      ->where('user_id', $this->user_id)
                                                      ->select('first_name','last_name')
                                                      ->first();
        if($arr_family_members)
        {
          $family_data = $arr_family_members->toArray();
          $this->arr_view_data['user_name']   = $family_data['first_name'].' '.$family_data['last_name'];
    
        }
      }

      $consult['booking_id']   = $booking_id;
      $consult['user_id']      = $this->user_id;
      $consult['doctor_id']    = $doctor_id;
      $consult['performed_by'] = $this->user_id;
      $consult['status']       = 'Rescheduled';

      $booking_status = $this->PatientConsultationStatusModel->create($consult);

      $this->NotificationModel->from_user_id =  $this->user_id;
      $this->NotificationModel->to_user_id   =  $consult_data['doctor_user_id'];
      $this->NotificationModel->booking_id   =  $booking_id;
      $this->NotificationModel->message      =  "has reschedule consultation";
      $this->NotificationModel->save();

      $consultation_prices = $this->ConsultationPriceModel->where('doctor_day_fee', 0)
                                                          ->where('day_profit', 0)
                                                          ->where('day_profit', 0)
                                                          ->where('doctor_night_fee', 0)
                                                          ->where('night_profit', 0)
                                                          ->get();
      if($consultation_prices)
      {
        $this->arr_view_data['arr_consultation_prices'] = $consultation_prices->toArray();
      }
      
      $this->arr_view_data['booking_time']              = $booking_time;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      //return view($this->module_view_folder.'.booking_request_confirmation',$this->arr_view_data);
      return redirect(url('').'/patient/booking/booking_request_confirmation/'.$enc_id);

    } // end reschedule_update_consultation

    
    public function reschedule_within_1hr_consultation($enc_id = false)
    {
      $userMsg = '';
      if($enc_id == false)
      {
        $booking_id = Session::get('booking_id');
      }
      else
      {
        $booking_id = base64_decode($enc_id);
      }

      $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                                ->where('patient_user_id', $this->user_id)
                                                                ->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
      }

      $patient_id     = $this->user_id;
      $doctor_id      = $booking_data['doctor_user_id'];
      $charge_id      = $booking_data['transaction_id'];
      $booking_status = $booking_data['booking_status'];
      $doctor_charge_per_4_mins = $booking_data['consultation_charge'];

      $reschedule_data['booking_id']    = $booking_id;
      $reschedule_data['user_id']       = $patient_id;
      $reschedule_data['doctor_id']     = $doctor_id;
      $reschedule_data['performed_by']  = $patient_id;
      $reschedule_data['status']        = 'Rescheduled';
      
      $get_count = $this->PatientConsultationStatusModel->where('booking_id', $booking_id)
                                                        ->where('user_id', $patient_id)
                                                        ->where('doctor_id', $doctor_id)
                                                        ->where('status', 'Rescheduled')
                                                        ->count();
      if($get_count == 0)
      {
        $inserted = $this->PatientConsultationStatusModel->create($reschedule_data);

        $booking_data['booking_status'] = 'Rescheduled';
        $update = $this->PatientConsultationBookingModel->where('id', $booking_id)
                                                        ->where('patient_user_id', $patient_id)
                                                        ->update($booking_data);
      }


      // payment for reschedule consultation within 1hr starts
      if($booking_status == 'Confirmed')
      {
          //count total no of consultation invoice
          $count_invoice = $this->PatientConsultationPaymentModel->count();
          if($count_invoice <= 0)
          {
              $invoice_id = "I00401";
          }
          else
          {
              //get the last invoice_id
              $get_id  = $this->PatientConsultationPaymentModel->latest()->first();
              if($get_id)
              {
                $new_id = substr($get_id->invoice_id, 1);
                $invoice_id = "I".str_pad($new_id+1, 5, '0', STR_PAD_LEFT);
              }
          }

          // capture charge created while booking
          \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
          
          try 
          {
              $charge = Stripe\Charge::retrieve($charge_id);
              $charge->capture();
          }
          catch (\Stripe\Error\RateLimit $excharge)
          {
              $charge = $excharge->getJsonBody();
              $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
          }
          catch (\Stripe\Error\InvalidRequest $excharge)
          {
              // Invalid parameters were supplied to Stripe's API
              $charge = $excharge->getJsonBody();
              $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
          }
          catch (\Stripe\Error\Authentication $excharge)
          {
              // Authentication with Stripe's API failed
              // (maybe you changed API keys recently)
              $charge = $excharge->getJsonBody();
              $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
          }
          catch (\Stripe\Error\ApiConnection $excharge)
          {
              // Network communication with Stripe failed
              $charge = $excharge->getJsonBody();
              $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
          }
          catch (\Stripe\Error\Base $excharge)
          {
              // Display a very generic error to the user, and maybe send
              $charge = $excharge->getJsonBody();
              $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
              // yourself an email
          }
          catch (Exception $excharge)
          {
              // Something else happened, completely unrelated to Stripe
              $charge = $excharge->getJsonBody();
              $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
          }

          if(($userMsg != null) && !empty($userMsg))
          {
            Session::flash('message', $userMsg);
            return redirect()->back();
          }

          if($charge['status'] == 'succeeded')
          {
              $data['invoice_id']     = $invoice_id;
              $data['booking_id']     = $booking_id;
              $data['patient_id']     = $patient_id;
              $data['doctor_id']      = $doctor_id;
              $data['charge_id']      = $charge_id;
              $data['payment_status'] = 'completed';
              $data['payment_amount'] = $doctor_charge_per_4_mins;
              $data['call_time']      = '';

              $store_charge = $this->PatientConsultationPaymentModel->insert($data);
          }

          Session::flash('message', 'Consultation Rescheduled and Payment successfully done');
      }
      else
      {
          // capture charge created while booking
          \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

          try
          {
              $refund = Stripe\Refund::create(array(
                "charge" => $charge_id
              ));
          }
          catch (\Stripe\Error\RateLimit $exrefund)
          {
              $refund = $exrefund->getJsonBody();
              $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
          }
          catch (\Stripe\Error\InvalidRequest $exrefund)
          {
              // Invalid parameters were supplied to Stripe's API
              $refund = $exrefund->getJsonBody();
              $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
          }
          catch (\Stripe\Error\Authentication $exrefund)
          {
              // Authentication with Stripe's API failed
              // (maybe you changed API keys recently)
              $refund = $exrefund->getJsonBody();
              $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
          }
          catch (\Stripe\Error\ApiConnection $exrefund)
          {
              // Network communication with Stripe failed
              $refund = $exrefund->getJsonBody();
              $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
          }
          catch (\Stripe\Error\Base $exrefund)
          {
              // Display a very generic error to the user, and maybe send
              $refund = $exrefund->getJsonBody();
              $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
              // yourself an email
          }
          catch (Exception $exrefund)
          {
              // Something else happened, completely unrelated to Stripe
              $refund = $exrefund->getJsonBody();
              $userMsg = 'Transaction failed - '.$refund['error']['message'].'.';
          }

          if(($userMsg != null) && !empty($userMsg))
          {
            Session::flash('message', $userMsg);
            return redirect()->back();
          }


          if($refund['status'] == 'succeeded')
          {
            Session::flash('message', 'Consultation Rescheduled successfully done');
          }
      }
      return redirect(url('').'/patient/booking');
      // payment for reschedule consultation within 1hr ends

    } // end reschedule_within_1hr_consultation


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 12/08/2017
    | Output    : 
    */
    
    public function rebooking_for_reschedule(Request $request, $id)
    {
      $get_booking_data = $this->PatientConsultationBookingModel->where('id', $id)
                                                                ->where('patient_user_id', $this->user_id)
                                                                ->first();
      if($get_booking_data)
      {
        $booking_data = $get_booking_data->toArray();
      }
      //dd($booking_data);
      //dd($booking_data['family_member_id']);

      if($booking_data['family_member_id'] == 0)
      {
        $user_type = "user";
      }
      else if($booking_data['family_member_id'] != 0)
      {
        $user_type = "family";
      }

      //Session::forget('booking');

      /*if(empty(Session::get('booking')) && Session::get('booking') == null)
      {
        Session::put(array('booking' => array(
                                             'patient'               => $booking_data['patient_user_id'],
                                             'user_type'             => $request->input('user_type'),
                                             'advice_treatment'      => $request->input('advice_treatment'),
                                             'prescriptions_repeats' => $request->input('prescriptions_repeats'),
                                             'medical_cetificate'    => $request->input('medical_cetificate'),
                                             'other'                 => $request->input('other'),
                                             'symptoms'              => $request->input('symptoms'),
                                             'medical_files'         => $file_name,
                    )      )                 );
      }*/

    } // end rebooking_for_reschedule










    public function show_upcoming_booking()
    {
       $arr_upcoming_booking = $arr_pagination = [];
       $obj_booking = $this->get_booking_list('upcoming');   

        if($obj_booking)
        {
            $arr_pagination          = clone $obj_booking;
            $arr_upcoming_booking    = $obj_booking->toArray();
        }
        
        $this->arr_view_data['arr_pagination']             = $arr_pagination;
        $this->arr_view_data['arr_upcoming_booking']       = $arr_upcoming_booking;
        $this->arr_view_data['page_title']                 = 'Upcoming Booking';
        $this->arr_view_data['module_url_path']            = $this->module_url_path;

       return view($this->module_view_folder.'.upcoming',$this->arr_view_data);   
    }

    public function show_past_booking()
    {
        $arr_past_booking = $arr_pagination =[];
        $obj_booking = $this->get_booking_list('past');   

        if($obj_booking)
        {
                $arr_pagination = clone $obj_booking;
                $arr_past_booking    = $obj_booking->toArray();

        }

        $this->arr_view_data['arr_pagination']         = $arr_pagination;
        $this->arr_view_data['arr_past_booking']       = $arr_past_booking;
        $this->arr_view_data['page_title']             = 'Past Booking';
        $this->arr_view_data['module_url_path']        = $this->module_url_path;
        return view($this->module_view_folder.'.past',$this->arr_view_data);   
    }

    public function get_booking_list($status)
    {
        $arr_pagination = $arr_booking = [];
        $current_date   = date('Y-m-d');
        $obj_data       = $this->PatientConsultationBookingModel->where('patient_user_id',$this->user_id)
                                                                ->with(['doctor_user_details'=>function($q){
                                                                    $q->select('id','first_name','last_name');
                                                                  }]);
          if($obj_data)
          {
              if($status=='upcoming')
              {
                  $obj_booking =  $obj_data->where('consultation_date','>=',$current_date)
                                            ->with('reminder_info')
                                            ->orderBy('id','DESC')
                                            ->paginate(3);
              }
              else if($status=='past')
              {
                  $obj_booking =  $obj_data->where('consultation_date','<',$current_date)
                                           ->where('booking_status','=','Completed')
                                           ->orderBy('id','DESC')
                                           ->paginate(3);
                                           
              }
              
              return $obj_booking;
          }
    }

    /*
      Rohini jagtap
      12 APR 2017
      description:create reminder for booking
    */
    public function store_reminder(Request $request)
    {
        $form_data    = $arr_reminder = $arr_reminder_update = [];
        $form_data    = $request->all();
        $obj_reminder = '';
        $consultation_time_date = '';

        $arr_reminder['patient_user_id']       = $this->user_id;
        $arr_reminder['doctor_user_id']        = $form_data['doctor_user_id'];
        $arr_reminder['booking_id']            = $form_data['booking_id'];
        $arr_reminder['reminder_status']       = 'Ongoing';


         $obj_booking = $this->PatientConsultationBookingModel->where('id',$form_data['booking_id'])->first();
         if($obj_booking)
         {
            $consultation_time_date            = $obj_booking->consultation_date.' '.$obj_booking->consultation_time;

         }

         /* update existing reminder*/
         if(isset($form_data['existing_reminder_hour'])  && sizeof($form_data['existing_reminder_hour'])>0 || 
           isset($form_data['existing_reminder_minute'])    && sizeof($form_data['existing_reminder_minute'])>0)
        {
            foreach ($form_data['existing_reminder_hour'] as $key => $value) 
            {
                
              $arr_reminder_update['reminder_hour']    = isset($value)?$value:'';
              $arr_reminder_update['reminder_minute']  = isset($form_data['existing_reminder_minute'][$key])?$form_data['existing_reminder_minute'][$key]:'';

              $arr_reminder_update['reminder_date_before']  = date('Y-m-d H:i',strtotime('-'.$arr_reminder_update['reminder_hour'].' hour - '.$arr_reminder_update['reminder_minute'].' minutes',strtotime($consultation_time_date)));


              $obj_reminder                     = $this->ReminderModel->where('id','=',$key)
                                                                      ->update($arr_reminder_update);
            }

        }

         /*create new reminder*/
        if(isset($form_data['reminder_minute'])  && sizeof($form_data['reminder_minute'])>0 || 
           isset($form_data['reminder_hour'])    && sizeof($form_data['reminder_hour'])>0)
        {
            foreach ($form_data['reminder_hour'] as $key => $value) 
            {
                
              $arr_reminder['reminder_hour']    = isset($value)?$value:'';
              $arr_reminder['reminder_minute']  = isset($form_data['reminder_minute'][$key])?$form_data['reminder_minute'][$key]:'';

              $arr_reminder['reminder_date_before']  = date('Y-m-d H:i',strtotime('-'.$arr_reminder['reminder_hour'].' hour - '.$arr_reminder['reminder_minute'].' minutes',strtotime($consultation_time_date)));


              $obj_reminder                          = $this->ReminderModel->create($arr_reminder);
            }

        }

        if($obj_reminder)
        {
            Flash::success('Reminder created successfully.');
        }
        else
        {
            Flash::error('Error while creating reminder.');
        }
        return redirect()->back();

        
    }
    /*
      Rohini jagtap
      13 APR 2017
      description:delete reminder
    */
    public function delete_reminder($enc_id)
    {
       $arr_json = [];
       if(isset($enc_id) && $enc_id!='')
       {
            $id = base64_decode($enc_id);
            $obj_reminder = $this->ReminderModel->where('id','=',$id)->delete();
            if($obj_reminder)
            {
                $arr_json['status'] = 'success';
            }
            else
            {
                $arr_json['status'] = 'error';
            }
       }
       return response()->json($arr_json);
    }

    public function reschedule_profile_about(Request $request, $enc_id, $enc_doctor_id)
    {
      
      $doctor_id  = base64_decode($enc_doctor_id);
      
      $doctor_data = $this->DoctorModel->where('user_id', $doctor_id)
                                       ->with('userinfo')
                                       ->first();
      if($doctor_data)
      {
        $this->arr_view_data['doctor_arr'] = $doctor_data->toArray();
        if(isset($this->arr_view_data['doctor_arr']['language']) && !empty($this->arr_view_data['doctor_arr']['language']))
        {
          $language_id_arr = explode(',', $this->arr_view_data['doctor_arr']['language']);

            $languages = $this->LanguageModel->whereIn('id', $language_id_arr)
                                             ->get();
            if(isset($languages) && !empty($languages))
            {
              $this->arr_view_data['languages_arr'] = $languages->toArray();
            }                                             
        }
      }

      $fees_arr = $this->DoctorPremiumRateModel->where('doctor_id',$doctor_id)->first();
      if($fees_arr)
      {
        $this->arr_view_data['fees_arr'] = $fees_arr->toArray();
      }      

      $admin_fees_arr = $this->DoctroFeesModel->where('id','1')->first();      
      
      if($admin_fees_arr)
      {
        $this->arr_view_data['admin_fees_arr'] = $admin_fees_arr->toArray();
      }

      $getDoctorFees =\DB::table('doctor_fees')->where('doctor_id' , $doctor_id)->get();
      if(isset($getDoctorFees) && count($getDoctorFees)>0)
      {
        $this->arr_view_data['getDoctorFees']       = $getDoctorFees;
      }
      
      $this->arr_view_data['doctor_pricing_fees']       = $this->get_doctor_fee_prices($doctor_id);
      $this->arr_view_data['enc_doctor_id']             = base64_encode($doctor_id);
      $this->arr_view_data['enc_booking_id']            = $enc_id;
      $this->arr_view_data['doctor_video_url']          = $this->doc_video;
      $this->arr_view_data['doctor_image_url']          = $this->doctor_image_url;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.reschedule_profile_about',$this->arr_view_data);
    }

    function get_fess(Request $request){
         $selected_start_time = date("H:i:s", strtotime($request->input('selected_time')));
         $selected_doctor_id  = $request->input('doctor_id');
         $getDoctorFees =\DB::table('doctor_fees')->where('start_time' , $selected_start_time)->where('doctor_id' , $selected_doctor_id)->get();

         if(isset($getDoctorFees[0]->total_patient_fee_for_four_min) && $getDoctorFees[0]->total_patient_fee_for_four_min != ""){
            echo $getDoctorFees[0]->total_patient_fee_for_four_min;
         }
         else{
            echo '0';
         }
    }

}
?>