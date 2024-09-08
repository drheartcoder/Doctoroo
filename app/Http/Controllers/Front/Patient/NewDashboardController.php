<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Common\Services\EmailService;

use Validator;
use Flash;
use Sentinel;
use Activation;
use Reminder;
use URL;
use Session;


class NewDashboardController extends Controller
{

    public function __construct(UserModel $UserModel,PatientModel $PatientModel,EmailService $EmailService)
    {	
    	$this->arr_view_data[]    = [];
    	$this->UserModel	      =	$UserModel;
        $this->PatientModel       = $PatientModel;
        $this->module_title       = "Dashboard";
        $this->module_view_folder = 'front.patient.new';
        $this->module_url_path    = url('/').'/patient/dashboard';
        
    }	

    public function dashboard()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.dashboard',$this->arr_view_data);
    }

    public function book_a_doctor()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.book_a_doctor',$this->arr_view_data);
    }

    public function profile_availibility()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.profile_availibility',$this->arr_view_data);
    }

    public function profile_about()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.profile_about',$this->arr_view_data);
    }

    public function consultation_details()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.consultation_details',$this->arr_view_data);
    }

    public function consultation_invoice()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.consultation_invoice',$this->arr_view_data);
    }

    public function disputes()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.disputes',$this->arr_view_data);
    }

    public function feedback()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.feedback',$this->arr_view_data);
    }

    public function search_available_doctors()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.search_available_doctors',$this->arr_view_data);
    }

    public function review_booking()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.review_booking',$this->arr_view_data);
    }

    public function booking_request_confirmation()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.booking_request_confirmation',$this->arr_view_data);
    }

    public function cancellation_refunds()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.cancellation_refunds',$this->arr_view_data);
    }

    public function online_waiting_room()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.online_waiting_room',$this->arr_view_data);
    }

    public function my_shop()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.my_shop',$this->arr_view_data);
    }

    public function messages_list()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.messages_list',$this->arr_view_data);
    }

    public function notification()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.notification',$this->arr_view_data);
    }

    public function settings()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.settings',$this->arr_view_data);
    }

    public function my_health()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.my_health',$this->arr_view_data);
    }

   /* public function my_health_specific($page_name)
    {
        $this->arr_view_data['page_name'] = $page_name;
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.my_health',$this->arr_view_data);
    }
*/
    public function my_health_conditions()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.my_health_conditions',$this->arr_view_data);
    }

    public function my_consulations()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.my_consulations',$this->arr_view_data);
    }

    public function my_orders()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.my_orders',$this->arr_view_data);
    }

    public function faq()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.faq',$this->arr_view_data);
    }

    public function faq_settings()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.faq_settings',$this->arr_view_data);
    }
   
   public function add_pharmacy_order()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.add_pharmacy_order',$this->arr_view_data);
    }

    public function pharmacy_details()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.pharmacy_details',$this->arr_view_data);
    }

    public function add_medication()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.add_medication',$this->arr_view_data);
    }

    public function question_for_free()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.question_for_free',$this->arr_view_data);
    }

    public function my_consulations_1()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.my_consulations_1',$this->arr_view_data);
    }

    public function personal_details()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.personal_details',$this->arr_view_data);
    }

    public function edit_personal_detail()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.edit_personal_detail',$this->arr_view_data);
    }

    public function family_member()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.family_member',$this->arr_view_data);
    }

    public function family_doctor()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.family_doctor',$this->arr_view_data);
    }

    public function my_pharmacy()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.my_pharmacy',$this->arr_view_data);
    }

    public function email_password()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.email_password',$this->arr_view_data);
    }
    
    public function notification_settings()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.notification_settings',$this->arr_view_data);
    }

    public function payment_method_settings()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.payment_method_settings',$this->arr_view_data);
    }

    public function payment_method()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.payment_method',$this->arr_view_data);
    }

    public function invoice()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.invoice',$this->arr_view_data);
    }

    public function invitation()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.invitation',$this->arr_view_data);
    }
    
    public function open_disputes()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.open_disputes',$this->arr_view_data);
    }

    public function legal()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.legal',$this->arr_view_data);
    }

    public function mission()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.mission',$this->arr_view_data);
    }

    public function privacy()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.privacy',$this->arr_view_data);
    }

    public function conditions()
    {
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.conditions',$this->arr_view_data);
    }

}