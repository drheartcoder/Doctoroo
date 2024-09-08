<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\DoctorConsultationPriceModel;
use App\Models\FaqsMembershipModel;
use App\Models\FaqMembershipCategoryModel;
use App\Models\PaymentMethodsModel;
use App\Models\MembershipPaymentModel;
use App\Models\DoctorMembershipModel;
use App\Models\DoctorPremiumRateModel;
use App\Models\DoctroFeesModel;
use App\Models\DoctorPremiumMembershipModel;
use App\Models\StripeCustomerModel;
use App\Models\StripeCardModel;
use App\Models\DoctorFeeModel;
use App\Models\AdminProfileModel;
use App\Models\MembershipDiscountCodeModel;
use App\Models\MembershipUsedDiscountModel;
use App\Models\StaticPagesModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Validator;
use Stripe;
use Session;
use PDF;
use DB;
use Mail;


class MembershipController extends Controller
{
    public function __construct(DoctorConsultationPriceModel  $doctor_consultation_price,
                                FaqsMembershipModel           $faq,
                                FaqMembershipCategoryModel    $faq_membership_catgeory,
                                PaymentMethodsModel           $payment_methods_model,
                                MembershipPaymentModel        $MembershipPaymentModel,
                                DoctorMembershipModel         $DoctorMembershipModel,
                                DoctorPremiumRateModel        $DoctorPremiumRateModel,
                                DoctroFeesModel               $DoctroFeesModel,
                                DoctorPremiumMembershipModel  $DoctorPremiumMembershipModel,
                                StripeCardModel               $StripeCardModel,
                                StripeCustomerModel           $StripeCustomerModel,
                                DoctorFeeModel                $DoctorFeeModel,
                                AdminProfileModel             $AdminProfileModel,
                                MembershipDiscountCodeModel   $MembershipDiscountCodeModel,
                                MembershipUsedDiscountModel   $MembershipUsedDiscountModel,
                                StaticPagesModel              $StaticPagesModel
                                )

    {

        $this->arr_view_data                    = [];
        $this->DoctorConsultationPriceModel     = $doctor_consultation_price;
        $this->FaqsMembershipModel              = $faq;
        $this->FaqMembershipCategoryModel       = $faq_membership_catgeory;
        $this->payment_methods_model            = $payment_methods_model;
        $this->MembershipPaymentModel           = $MembershipPaymentModel;
        $this->DoctorMembershipModel            = $DoctorMembershipModel;
        $this->DoctorPremiumRateModel           = $DoctorPremiumRateModel;
        $this->DoctroFeesModel                  = $DoctroFeesModel;
        $this->DoctorPremiumMembershipModel     = $DoctorPremiumMembershipModel;
        $this->StripeCustomerModel              = $StripeCustomerModel;
        $this->StripeCardModel                  = $StripeCardModel;
        $this->DoctorFeeModel                   = $DoctorFeeModel;
        $this->AdminProfileModel                = $AdminProfileModel;
        $this->MembershipDiscountCodeModel      = $MembershipDiscountCodeModel;
        $this->MembershipUsedDiscountModel      = $MembershipUsedDiscountModel;
        $this->StaticPagesModel                 = $StaticPagesModel;

        $this->module_url_path                  = url('/').'/doctor/membership';
        $this->module_membership_path           = url('/').'/doctor/patients/membersip';
        $this->module_view_folder               = 'front.doctor.membership';

        DB::connection()->enableQueryLog();

        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }
     
        $this->arr_view_data['page_title']      = "Membership";
    }
    
    public function standard()
    {  
        $arr_standard = [];

        $obj_standard = $this->DoctorConsultationPriceModel->get();

        if($obj_standard)
        {
            $arr_standard = $obj_standard->toArray();
        }

       $arr_standard_faq = [];
       $obj_faq = $this->FaqsMembershipModel->whereHas('faq_membership_catgeory', function($cat){
                                                        $cat->where('id',1);
                                                        $cat->orWhere('id',3);
                                                        
                                                    })->where('status','=','Active')->get();
       if($obj_faq)
       {
            $arr_standard_faq = $obj_faq->toArray();
       }
        
        $this->arr_view_data['arr_standard_faq'] = $arr_standard_faq;
        $this->arr_view_data['arr_standard']  = $arr_standard;
        return view($this->module_view_folder.'.standard_membership',$this->arr_view_data);
    }


    public function premium()
    {   
        if(!empty(Session::get('last_payment_method_id')))
        {
          Session::forget('last_payment_method_id');
        }
        
        $arr_premium = [];

        //$obj_premium = $this->DoctorConsultationPriceModel->get();
        $obj_premium = $this->DoctorMembershipModel->get();
        if($obj_premium)
        {
            $arr_premium = $obj_premium->toArray();
        }

       $arr_premium_faq = [];
       $obj_faq = $this->FaqsMembershipModel->whereHas('faq_membership_catgeory', function($cat){
                                                        $cat->where('id',2);
                                                        $cat->orWhere('id',3);
                                                    })->where('status','=','Active')->get();
        if($obj_faq)
        {
            $arr_premium_faq = $obj_faq->toArray();
        }


        $get_rate = $this->DoctorPremiumRateModel->where('doctor_id', $this->user_id)->first();
        if($get_rate)
        {
          $arr_rates = $get_rate->toArray();
          $this->arr_view_data['arr_premium_rates'] = $arr_rates;
        }

        $membership_plan_arr = $this->DoctorPremiumMembershipModel->first();

        if(isset($membership_plan_arr) && !empty($membership_plan_arr))
        {
          $this->arr_view_data['membership_plan_arr'] = $membership_plan_arr->toArray();
        }


        $doctoroo_fee = $this->DoctroFeesModel->first();
        $doctoroo_fee->toArray();
        if(isset($doctoroo_fee['doctoroo_commission']) && $doctoroo_fee['doctoroo_commission'] != ''){ $doctoroo_commission =  $doctoroo_fee['doctoroo_commission']; } else { $doctoroo_commission = '0'; }
        if(isset($doctoroo_fee['doctoroo_fee']) && $doctoroo_fee['doctoroo_fee'] != ''){ $doctoroo_fee =  $doctoroo_fee['doctoroo_fee']; } else { $doctoroo_fee = '0'; }


        $this->arr_view_data['doctoroo_commission'] = $doctoroo_commission;
        $this->arr_view_data['doctoroo_fee']        = $doctoroo_fee;


        $getDoctorFees =\DB::table('doctor_fees')->where('doctor_id' , $this->user_id)->orderBy('id' ,'desc')->get();
        $this->arr_view_data['getDoctorFees']       = $this->make_pagination_links($getDoctorFees,14);
        $this->arr_view_data['obj_pagination']      = $this->arr_view_data['getDoctorFees'];
        $this->arr_view_data['arr_getDoctorFees']   = $this->arr_view_data['getDoctorFees']->toArray();


        $this->arr_view_data['doctor_id']         = $this->user_id;
        $this->arr_view_data['arr_premium_faq']   = $arr_premium_faq;
        $this->arr_view_data['arr_premium']       = $arr_premium;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        
        return view($this->module_view_folder.'.premium_membership',$this->arr_view_data);
    }


    public function select_membership()
    {    
        return view($this->module_view_folder.'.select_membership',$this->arr_view_data);
    }

    public function payment()
    {
        $get_card_id = $this->StripeCardModel->where('user_id',$this->user_id)->get();
        if($get_card_id)
        {
          $card_list = $get_card_id->toArray();
        }

        $new_card_details = [];

        foreach($card_list as $list)
        {
          \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
          $customer = \Stripe\Customer::retrieve($list['customer_id']);
          $card = $customer->sources->retrieve($list['card_id']);
          
          $card_details['id']          = $card->id;
          $card_details['customer_id'] = $customer->id;
          $card_details['card_type']   = $card->brand;
          $card_details['card_no']     = $card->last4;
          $card_details['exp_month']   = $card->exp_month;
          $card_details['exp_year']    = $card->exp_year;

          $new_card_details[] = $card_details;
        }

        $current_datetime = date('Y-m-d H:i:s');

        $membership_arr = [];
        $membership_arr = $this->MembershipPaymentModel->where('doctor_id' , $this->user_id)
                                                       ->where('end_date' , '>' , $current_datetime)
                                                       ->first();

        if(isset($membership_arr) && !empty($membership_arr))
        {
            $this->arr_view_data['membership_arr'] = $membership_arr->toArray();
        }

        $membership_plan_arr = $this->DoctorPremiumMembershipModel->first();

        if(isset($membership_plan_arr) && !empty($membership_plan_arr))
        {
          $this->arr_view_data['membership_plan_arr'] = $membership_plan_arr->toArray();
        }
        
        $current_date = date('Y-m-d');
        $get_membership_discount = $this->MembershipDiscountCodeModel->where('start_expiry_date', '>=', $current_date)
                                                                     ->where('end_expiry_date', '>=', $current_date)
                                                                     ->where('status', 'active')
                                                                     ->with('used_discount')
                                                                     ->orderBy('start_expiry_date', 'ASC')
                                                                     ->get();
        if($get_membership_discount)
        {
          $this->arr_view_data['discount_data'] = $get_membership_discount->toArray();
        }
        
        $this->arr_view_data['current_doctor_id'] = $this->user_id;
        $this->arr_view_data['payment_methods']   = $new_card_details;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        return view($this->module_view_folder.'.payment',$this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                     STORE CARD DETAILS
    -----------------------------------------------------------------------------*/

    public function payment_method(Request $request)
    {
      $date = $request->card_expiry_date;

      $arr_data['user_id'] = $this->user_id;
      $arr_data['card_no'] = $request->card_no;
      $arr_data['card_type'] = $request->card_type;
      $arr_data['card_expiry_date'] = $date;
      $arr_data['cvv'] = $request->cvv;

      $last_inserted_id=$this->payment_methods_model->insertGetId($arr_data);

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

     /*
    | Function  : 
    | Author    : Tushar Ahire
    | Date      : 10 - nov - 2017
    | function  : store_membership_ta
    */
    public function store_membership_ta(Request $request)
    {

        /* for edit */
           $doctor_id = $request->input('doctor_id');
           $fees_id   = $request->input('fees_id');
        /* for edit */

        $stime = date("Y-m-d H:i:s", strtotime($request->input('start_time')));
        $etime = date("Y-m-d H:i:s", strtotime($request->input('end_time')));

        $logged_id = $this->user_id;
        $day = $request->input('day');
        $start_time = convert_userdatetime_to_utc($this->user_id, "doctor", $stime);
        $start_time_to_str = strtotime($start_time);
        $end_time   = convert_userdatetime_to_utc($this->user_id, "doctor", $etime);
        $end_time_to_str   = strtotime($end_time);
        $gp_in_min  =  $request->input('gp_in_min');
        $gp_in_hr   =  $request->input('gp_in_hr');
        $earning_of_four_min = $request->input('earning_of_four_min');
        $earning_of_min = $request->input('earning_of_min');
        $doctoroo_fee = $request->input('doctoroo_fee');
        $total_patient_fee_of_four_min = $request->input('total_patient_fee_of_four_min');
        $total_patient_fee_of_additional_afer_four_min = $request->input('total_patient_fee_of_additional_afer_four_min');
        
        if(isset($day) && $day != '') { $day = $day; } else { $day = [] ; } 
        if(isset($start_time) && $start_time != '') { $start_time = $start_time; } else { $start_time = ''; } 
        if(isset($end_time) && $end_time != '') { $end_time = $end_time; } else { $end_time = ''; } 
        if(isset($gp_in_min) && $gp_in_min != '') { $gp_in_min = $gp_in_min; } else { $gp_in_min = '0'; } 
        if(isset($gp_in_hr) && $gp_in_hr != '') { $gp_in_hr = $gp_in_hr; } else { $gp_in_hr = '0'; } 
        if(isset($earning_of_four_min) && $earning_of_four_min != '') { $earning_of_four_min = $earning_of_four_min; } else { $earning_of_four_min = '0'; } 
        if(isset($earning_of_min) && $earning_of_min != '') { $earning_of_min = $earning_of_min; } else { $earning_of_min = '0'; } 
        if(isset($doctoroo_fee) && $doctoroo_fee != '') { $doctoroo_fee = $doctoroo_fee; } else { $doctoroo_fee = '0'; } 
        if(isset($total_patient_fee_of_four_min) && $total_patient_fee_of_four_min != '') { $total_patient_fee_of_four_min = $total_patient_fee_of_four_min; } else { $total_patient_fee_of_four_min = '0'; } 
        if(isset($total_patient_fee_of_additional_afer_four_min) && $total_patient_fee_of_additional_afer_four_min != '') { $total_patient_fee_of_additional_afer_four_min = $total_patient_fee_of_additional_afer_four_min; } else { $total_patient_fee_of_additional_afer_four_min = '0'; } 

        $data =[];
        $store = null;

        foreach ($day as $key => $day) {

            if(isset($doctor_id) && $doctor_id !='' || isset($fees_id) && $fees_id !='' ){
                  $data['day'] = $day;
                  $data['start_time'] = $start_time;
                  $data['start_time_to_str'] = $start_time_to_str;
                  $data['end_time']   = $end_time;
                  $data['end_time_to_str']   = $end_time_to_str;
                  $data['dr_fee_per_min'] = $gp_in_min;
                  $data['dr_fee_per_hr'] = $gp_in_hr;
                  $data['earning_for_4_min'] = $earning_of_four_min;
                  $data['earning_per_min'] = $earning_of_min;
                  $data['doctoroo_fee'] = $doctoroo_fee;
                  $data['total_patient_fee_for_four_min'] = $total_patient_fee_of_four_min;
                  $data['total_patient_fee_of_additional_afer_four_min'] = $total_patient_fee_of_additional_afer_four_min;
                  $store = $this->DoctorFeeModel->where('doctor_id' , $doctor_id)->where('id' , $fees_id)->update($data);
            }
            else{

                $getExistedTimeslot = $this->DoctorFeeModel->where('doctor_id' , $logged_id)->where('day' , $day)->where('start_time', '<=' , $start_time)->where('end_time', '>=', $start_time)->first();

                if($getExistedTimeslot == null){

                  $data['doctor_id'] = $logged_id;
                  $data['day'] = $day;
                  $data['start_time'] = $start_time;
                  $data['start_time_to_str'] = $start_time_to_str;
                  $data['end_time']   = $end_time;
                  $data['end_time_to_str']   = $end_time_to_str;
                  $data['dr_fee_per_min'] = $gp_in_min;
                  $data['dr_fee_per_hr'] = $gp_in_hr;
                  $data['earning_for_4_min'] = $earning_of_four_min;
                  $data['earning_per_min'] = $earning_of_min;
                  $data['doctoroo_fee'] = $doctoroo_fee;
                  $data['total_patient_fee_for_four_min'] = $total_patient_fee_of_four_min;
                  $data['total_patient_fee_of_additional_afer_four_min'] = $total_patient_fee_of_additional_afer_four_min;
                  $store = $this->DoctorFeeModel->insertGetId($data);
                } else {

                  Session::flash('message', 'Error! Selected Time slot already exists.');
                  return redirect()->back();
                }
            }
        } 

        if($store){
          Session::flash('message', 'Details Successfully Saved');
          return redirect()->back();
        }
        else{
          Session::flash('message', 'Error! Something went wrong...');
          return redirect()->back();
        }
    }

    public function store_membership()
    {

      $card_no = $expire_month = $expire_year = $transaction_id=  $data_arr = [];

      $payment_status = $discount_id = "";

      if(!empty(Session::get('last_payment_method_id')))
      {
        Session::forget('last_payment_method_id');
      }

      if(Session::get('membership.transaction_id') != null && !empty(Session::get('membership.transaction_id')))
      {
        $transaction_id = Session::get('membership.transaction_id');
      }

      if(Session::get('membership.membership_price') != null && !empty(Session::get('membership.membership_price')))
      {
        $membership_price = Session::get('membership.membership_price');
      }

      if(Session::get('membership.discount_id') != null && !empty(Session::get('membership.discount_id')))
      {
        $discount_id = Session::get('membership.discount_id');
      }

      if(Session::get('payment_status') != null && !empty(Session::get('payment_status')))
      {
        $payment_status = Session::get('payment_status');
      }

      $membership_amt = '';
      $gst = '';

      $membership_plan_arr = $this->DoctorPremiumMembershipModel->first();

      if(isset($membership_plan_arr) && !empty($membership_plan_arr))
      {
        $membership_plan_arr = $membership_plan_arr->toArray();
      }

      if(Session::get('membership.membership_package') != null && !empty(Session::get('membership.membership_package')))
      {
        $membership_package = Session::get('membership.membership_package');
        if($membership_package == 'monthly')
        {
          $membership_amt =  isset($membership_plan_arr['monthly_amount']) ? $membership_plan_arr['monthly_amount'] : '' ;
          $gst = isset($membership_plan_arr['monthly_gst']) ? $membership_plan_arr['monthly_gst'] : '' ;
        }
        else if($membership_package == 'annually')
        {
          $membership_amt =  isset($membership_plan_arr['annually_amount']) ? $membership_plan_arr['annually_amount'] : '' ;
          $gst = isset($membership_plan_arr['annually_gst']) ? $membership_plan_arr['annually_gst'] : '' ;
        }
      }
      $start_date = date("Y-m-d H:i:s");

      if(isset($membership_package) && !empty($membership_package))
      {
        if($membership_package == 'monthly')
        {
          $end_date = date("Y-m-d H:i:s",strtotime('+1 month'));    
        }
        else if($membership_package == 'annually')
        {
           $end_date = date("Y-m-d H:i:s",strtotime('+6 months')); 
        }
        else
        {
          $end_date = "";
        }
        
      }
      
      $data_arr['doctor_id']          = $this->user_id;
      $data_arr['transaction_id']     = $transaction_id;
      $data_arr['package']            = $membership_package;
      $data_arr['start_date']         = $start_date;
      $data_arr['end_date']           = $end_date;
      $data_arr['amount']             = $membership_amt;
      $data_arr['gst']                = $gst;
      $data_arr['discount_id']        = $discount_id;
      $data_arr['total_amount']       = $membership_price;
      $data_arr['status']             = $payment_status;

      $count_membership = $this->MembershipPaymentModel->count();
      if($count_membership <= 0)
      {
        $data_arr['invoice_no'] = "M00401";
      }
      else
      {
        $get_id  = $this->MembershipPaymentModel->latest()->first();

        if($get_id)
        {
          $new_id = substr($get_id->invoice_no, 2);
          $data_arr['invoice_no'] = "MI".str_pad($new_id+1, 5, '0', STR_PAD_LEFT);
        }
      }

      /* -- send mail to client -- */
        /* content variables in view */
            $user = Sentinel::findById($this->user_id);
            $content['first_name']        = $user->first_name;
            $content['last_name']         = $user->last_name;
            $content['email']             = $user->email;
            $content['transaction_id']    = $transaction_id;
            //$content['membership_price']  = (int) $membership_price;
            $content['membership_price']  = floatval($membership_price);
            $content['invoice_no']        = $data_arr['invoice_no'];
        /* end content variables in view */


        /* built content variables in view */
            $content =  view('front.email.membership_payment',compact('content'))->render();
            $content =  html_entity_decode($content);
        /* end built content variables in view */
       
        $to_email_id  = $user->email;
        $project_name = config('app.project.name');
        $mail_subject = 'Membership Payment Successfully Completed';

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

      $res = $this->MembershipPaymentModel->create($data_arr);

      if($res)
      {
        $data['doctor_id'] = $this->user_id;
        $data['discount_id'] = $discount_id;

        $this->MembershipUsedDiscountModel->create($data);

        Session::flash('message', 'Payment Successfully Processed');
        \Session::forget('mem_package');
        return redirect(url('').'/doctor/membership/payment');
      }
    }
   
    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 21/09/2017
    | Output    : Success or Error
    */

    public function store_day_rate(Request $request)
    {
        
        $arr_rules['edit_day_rate'] = "required";

        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Session::flash('status_msg','Error! All the fields are mandatory.');
            return back()->withInput($request->all())->withErrors($validator);
        }

        $data['day_rate']   = $request->edit_day_rate;
        $data['doctor_id']  = $this->user_id;


        $doctoroo_fee = $this->DoctroFeesModel->first();

        $day_total_rate ="";

        if(isset($doctoroo_fee) && !empty($doctoroo_fee))
        {
            $doctoroo_fee_arr = $doctoroo_fee->toArray();
            $day_rate = $request->edit_day_rate;

            $doctoroo_commission = isset($doctoroo_fee_arr['doctoroo_commission']) ? $doctoroo_fee_arr['doctoroo_commission'] : '';
            $doctoroo_fee = isset($doctoroo_fee_arr['doctoroo_fee']) ? $doctoroo_fee_arr['doctoroo_fee'] : '';

            $commision = $day_rate / $doctoroo_commission;
            $total_commission = $commision + $doctoroo_fee; 
            
            $day_total_rate = $day_rate + $total_commission; 
        } 
        

        $data['day_total_rate']  = $day_total_rate;

        $get_data = $this->DoctorPremiumRateModel->where('doctor_id', $this->user_id)->get();
        if(count($get_data) > 0)
        {
            $store_date = $this->DoctorPremiumRateModel->where('doctor_id', $this->user_id)->update($data);
        }
        else
        {
            $store_date = $this->DoctorPremiumRateModel->create($data);
        }

        if($store_date)
        {
            Session::flash('status_msg','Details Successfully Saved');
        }
        else
        {
            Session::flash('status_msg','Error! Something went wrong.');
        }
        return redirect()->back();

    } // end store_day_rate


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 21/09/2017
    | Output    : Success or Error
    */

    public function store_night_rate(Request $request)
    {
      // dd($request->all());
       
        $arr_rules['edit_night_rate'] = "required";

        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Session::flash('status_msg','Error! Please enter night rate.');
            return back()->withInput($request->all())->withErrors($validator);
        }

        $data['night_rate']   = $request->edit_night_rate;
        $data['doctor_id']  = $this->user_id;


        $doctoroo_fee = $this->DoctroFeesModel->first();

        $night_total_rate ="";

        if(isset($doctoroo_fee) && !empty($doctoroo_fee))
        {
            $doctoroo_fee_arr = $doctoroo_fee->toArray();
            $night_rate = $request->edit_night_rate;

            $doctoroo_commission = isset($doctoroo_fee_arr['doctoroo_commission']) ? $doctoroo_fee_arr['doctoroo_commission'] : '';
            $doctoroo_fee = isset($doctoroo_fee_arr['doctoroo_fee']) ? $doctoroo_fee_arr['doctoroo_fee'] : '';

            $commision = $night_rate / $doctoroo_commission;
            $total_commission = $commision + $doctoroo_fee; 
            
            $night_total_rate = $night_rate + $total_commission; 
        } 
        
        $data['night_total_rate']  = $night_total_rate;

        $get_data = $this->DoctorPremiumRateModel->where('doctor_id', $this->user_id)->get();
        if(count($get_data) > 0)
        {
            $store_date = $this->DoctorPremiumRateModel->where('doctor_id', $this->user_id)->update($data);
        }
        else
        {
            $store_date = $this->DoctorPremiumRateModel->create($data);
        }

        if($store_date)
        {
            Session::flash('status_msg','Details Successfully Saved');
        }
        else
        {
            Session::flash('status_msg','Error! Something went wrong.');
        }
        return redirect()->back();


    } // end store_night_rate

    public function cancel_next_month_membership(Request $request)
    {
        $cancel_arr['next_month_membership'] = 'no'; 
        $cancel_res = $this->MembershipPaymentModel->where('doctor_id', $this->user_id)->update($cancel_arr);
        if($cancel_res)
        {
          $arr_response['msg'] = 'Next month membership payment cancelled successfully';
        }
        else
        {
          $arr_response['msg'] = 'Something went to wrong ! Please try again later.';
        }

        return response()->json($arr_response);
    }

    public function get_next_month_membership(Request $request)
    {
        $cancel_arr['next_month_membership'] = 'yes'; 
        $cancel_res = $this->MembershipPaymentModel->where('doctor_id', $this->user_id)->update($cancel_arr);
        if($cancel_res)
        {
          $arr_response['msg'] = 'Next month membership payment successfully done';
        }
        else
        {
          $arr_response['msg'] = 'Something went to wrong ! Please try again later.';
        }

        return response()->json($arr_response);
    }

    public function make_pagination_links($items,$perPage)
    {
      $pageStart = \Request::get('page', 1);
      // Start displaying items from this number;
      $offSet = ($pageStart * $perPage) - $perPage; 
      // Get only the items you need using array_slice
      $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);
      return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
  }

  public function billing()
  {
      $membership_arr = $this->MembershipPaymentModel->where('doctor_id' , $this->user_id)
                                                     ->orderBy('id' , 'DESC')
                                                     ->paginate(10);

      if($membership_arr)
      {
        $this->arr_view_data['paginate']       = clone $membership_arr; 
        $this->arr_view_data['membership_arr'] = $membership_arr->toArray();
      }

      $this->arr_view_data['module_url_path']  = $this->module_url_path;
      return view($this->module_view_folder.'.membership_billing')->with($this->arr_view_data);
      
  } 

  public function invoice($enc_id = false)
  {
      $membership_id = base64_decode($enc_id);

      $membership_arr = $this->MembershipPaymentModel->where('id' , $membership_id)
                                                     ->with('userinfo')
                                                     ->with('doctorinfo')
                                                     ->with('discount_data')
                                                     ->first();

      if($membership_arr)
      {
        $this->arr_view_data['membership_arr'] = $membership_arr->toArray();
      }

      $admin_obj = $this->AdminProfileModel ->where('user_id', '1')->first();

      if($admin_obj)
      {
         $this->arr_view_data['admin_arr'] = $admin_obj->toArray();
      }

      $this->arr_view_data['enc_id']           = $enc_id;
      $this->arr_view_data['module_url_path']  = $this->module_url_path;
      return view($this->module_view_folder.'.membership_invoice')->with($this->arr_view_data);
  }

  public function invoice_download($enc_id = false)
  {
      $membership_id = base64_decode($enc_id);

      $membership_arr = $this->MembershipPaymentModel->where('id' , $membership_id)
                                                     ->with('userinfo')
                                                     ->with('doctorinfo')
                                                     ->with('discount_data')
                                                     ->first();

      if($membership_arr)
      {
        $this->arr_view_data['membership_arr'] = $membership_arr->toArray();
      }

      $admin_obj = $this->AdminProfileModel ->where('user_id', '1')->first();

      if($admin_obj)
      {
         $this->arr_view_data['admin_arr'] = $admin_obj->toArray();
      }
      
      Session::put("arr_membership_invoice",'');
      return response()->json($this->arr_view_data);
  }

  public function generate_membership_invoice_pdf(Request $request)
  {

    if($request->has('arr_data') && $request->input('arr_data')!='')
      {
        $arr_session_data = $request->input('arr_data');
        Session::put("arr_membership_invoice",$arr_session_data);
        return response()->json(['status'=>'success']);
      }
      $arr_data = Session::get("arr_membership_invoice");
      if(!empty($arr_data))
      {
          PDF::setHeaderCallback(function($pdf){
              $pdf->SetY(15);
              $pdf->SetFont('helvetica', 'B', 20);
              $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);
              $pdf->SetY(40);
          });
        
        PDF::setFooterCallback(function($pdf) {

            $pdf->SetY(-15);
            
            $pdf->SetFont('helvetica', 'I', 8);
            
            $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });

        $file_name="membership_invoice";
      
        PDF::SetTitle('Doctoroo | Membership Invoice');
        PDF::SetMargins(10, 30, 10, 10);
        PDF::SetFontSubsetting(false);
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        PDF::AddPage();
        PDF::writeHTML(view($this->module_view_folder.'.pdf.membership_invoice', $arr_data)->render());
        PDF::Output($file_name.'.pdf');
      }
      return redirect()->back();
  }

  function delete_doctor_fees(Request $request){
    $dr_fees_id = $request->input('id');
    $delete  = $this->DoctorFeeModel->where('id' ,$dr_fees_id)->delete();
    if($delete){
      echo "done";
    }else{
      echo "error";
    }
  }
  function edit_doctor_fees(Request $request){
    $dr_fees_id = $request->input('id');
    $get_data   = \DB::table('doctor_fees')->where('id' ,$dr_fees_id)->get();
    $outputData = ''; 
    $data_array = array($get_data[0]->id , 
                        $get_data[0]->doctor_id ,
                        $get_data[0]->day ,
                        date("h:i a", strtotime(convert_utc_to_userdatetime($this->user_id, "doctor", $get_data[0]->start_time))),
                        date("h:i a", strtotime(convert_utc_to_userdatetime($this->user_id, "doctor", $get_data[0]->end_time))),
                        $get_data[0]->dr_fee_per_min ,
                        $get_data[0]->dr_fee_per_hr ,
                        $get_data[0]->earning_for_4_min , 
                        $get_data[0]->earning_per_min , 
                        $get_data[0]->doctoroo_fee , 
                        $get_data[0]->total_patient_fee_for_four_min , 
                        $get_data[0]->total_patient_fee_of_additional_afer_four_min
                        );

    $outputData=implode('_|_',$data_array);
    echo $outputData;
  }

  function check_voucher_code_available(Request $request){

      $voucher_code   = $request->input('voucher_code');
      $doctor_id      = $this->user_id;
      $outputData     = '';
      $check_voucher  = \DB::table('dod_membership_discount_code')
                         ->where('dod_membership_discount_code.code' ,$voucher_code)
                         ->get();

      if(isset($check_voucher) && !empty($check_voucher) && $check_voucher !=""){
              $check_doctor_already_used   = \DB::table('dod_membership_discount_code')
                         ->join('dod_membership_used_discount' , 'dod_membership_used_discount.discount_id' ,'=','dod_membership_discount_code.id')
                         ->where('dod_membership_discount_code.code' ,$voucher_code)
                         ->where('dod_membership_used_discount.doctor_id' ,$doctor_id)
                         ->get();
              if(isset($check_doctor_already_used) && !empty($check_doctor_already_used) && $check_doctor_already_used !=""){  
                  $data_array = array('error','Voucher code already used');
                  $outputData=implode('_|_',$data_array);
              }else{

                  $end_expiry_date = $check_voucher[0]->end_expiry_date;
                  $status          = $check_voucher[0]->status;
                  $percentage      = $check_voucher[0]->percentage;
                  $discount_id      = $check_voucher[0]->id;

                  if($status == 'block'){
                    $data_array = array('error','Voucher code block by admin');
                    $outputData =implode('_|_',$data_array);
                  }else if($end_expiry_date < date('Y-m-d')){
                    $data_array = array('error','Voucher code is expired');
                    $outputData =implode('_|_',$data_array);
                  }
                  else{

                    $data_array = array('success','Voucher code is applied',$percentage,$discount_id);
                    $outputData=implode('_|_',$data_array);
                  }
              }           
      } 
      else{
        $data_array = array('error','Voucher code is not valid');
        $outputData =implode('_|_',$data_array);
      }                  
    echo $outputData;
  }
}//  end class
?>