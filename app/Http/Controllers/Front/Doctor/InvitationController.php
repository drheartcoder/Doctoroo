<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\DoctorInvitationModel;
use App\Models\PharmacyInvitationModel;
use App\Models\PatientInvitationModel;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;



class InvitationController extends Controller
{
    public function __construct(DoctorInvitationModel $doctor_invitation_model,
                                PharmacyInvitationModel $pharmacy_invitation_model,
                                PatientInvitationModel  $patient_invitation_model)
    {
        $this->arr_view_data            = [];
        $this->module_title             = "Invitation";
        $this->module_doctor_path       = url('/').'/doctor';
        $this->module_url_path          = url('/').'/doctor/profile';
        $this->module_view_folder       = "front.doctor";
        $this->site_url                 = url('/');

        $this->DoctorInvitationModel    = $doctor_invitation_model;
        $this->PharmacyInvitationModel  = $pharmacy_invitation_model;
        $this->PatientInvitationModel   = $patient_invitation_model;

        $this->arr_month                = [];

        $this->arr_month['1'] = "Jan";
        $this->arr_month['2'] = "Feb";
        $this->arr_month['3'] = "Mar";
        $this->arr_month['4'] = "Apr";
        $this->arr_month['5'] = "May";
        $this->arr_month['6'] = "Jun";
        $this->arr_month['7'] = "Jul";
        $this->arr_month['8'] = "Aug";
        $this->arr_month['9'] = "Sep";
        $this->arr_month['10'] = "Oct";
        $this->arr_month['11'] = "Nov";
        $this->arr_month['12'] = "Dec";

        $user = Sentinel::check();

        if($user!=false)
        {
           $this->user_id  = $user->id;
           $this->user     = $user;
        }

    }
    /*
      Rohini Jagtap
      date:23 march 2017
      load page for invitation 
    */
    public function index()
    {
          $arr_invitation = $arr_month = [];
          $arr_month      = $this->arr_month;  
          if($this->user)
          {
            $arr_invitation['first_name'] = $this->user->first_name;
            $arr_invitation['last_name']  = $this->user->last_name;
          }  
          $this->arr_view_data['arr_month']              = $arr_month;
          $this->arr_view_data['arr_invitation']         = $arr_invitation;
          $this->arr_view_data['page_title']             = 'Invitation';
          $this->arr_view_data['module_url_path']        =  $this->module_url_path;
          $this->arr_view_data['module_doctor_path']     =  $this->module_doctor_path;
          return view($this->module_view_folder.'.invitation',$this->arr_view_data);
    }
    /*
        store doctor invitaion
    */
    public function store_doctor_invitation(Request $request)
    {
        $create_status = $update_status = '';
        $form_data                               = $arr_invitation = [];
        $arr_rules['first_name']                 = "required";
        $arr_rules['last_name']                  = "required";
        $arr_rules['phone']                      = "required|max:10|min:10";
        $arr_rules['email_id']                   = "required|email";
        $arr_rules['medical_practice_name']      = "required";
        $arr_rules['address']                    = "required";


        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $form_data     = $request->all();

        
        $arr_invitation['first_name']       = $form_data['first_name'];
        $arr_invitation['last_name']        = $form_data['last_name'];
        $arr_invitation['phone']            = $form_data['phone'];
        $arr_invitation['email']            = $form_data['email_id'];
        $arr_invitation['practice_name']    = $form_data['medical_practice_name'];
        $arr_invitation['address']          = $form_data['address'];

        $obj_invitation                     =  $this->DoctorInvitationModel;
        if($obj_invitation)
        {

            $arr_invitation['user_id']    =  $this->user_id;
            $create_status                = $obj_invitation->create($arr_invitation);

        }

        if($create_status || $update_status)
        {
            Flash::success('Doctor invitation is sent successfully.');
        } 
        else
        {
            Flash::error('Error occure while sending an invitation.');
        }
        return redirect()->back();
        

    }
    /*
        store pharmacy invitaion
    */
    public function store_pharmacy_invitation(Request $request)
    {
        $create_status = '';
        $form_data                               = $arr_invitation = $arr_rules = [];
        $arr_rules['pharmacy_name']              = "required";
        $arr_rules['phone']                      = "required|max:10|min:10";
        $arr_rules['email_id']                   = "required|email";
        $arr_rules['address']                    = "required";


        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $form_data     = $request->all();

        $arr_invitation['pharmacy_name']         = $form_data['pharmacy_name'];
        $arr_invitation['phone']                 = $form_data['phone'];
        $arr_invitation['email']                 = $form_data['email_id'];
        $arr_invitation['address']               = $form_data['address'];

        $obj_invitation                          = $this->PharmacyInvitationModel;
        if($obj_invitation)
        {

            $arr_invitation['user_id']           = $this->user_id;
            $create_status                       = $obj_invitation->create($arr_invitation);

        }

        if($create_status)
        {
            Flash::success('Pharmacy invitation is sent successfully.');
        } 
        else
        {
            Flash::error('Error occure while sending an invitation.');
        }
        return redirect()->back();
        
    }
    public function store_patient_invitation(Request $request)
    {

        $arr_invitation                          = [];
        $birth_date                              = $birth_year= $birth_month = $birth_day ='';
        $arr_rules['first_name']                 = "required";
        $arr_rules['last_name']                  = "required";
        $arr_rules['phone']                      = "required|max:10|min:10";
        $arr_rules['address']                    = "required";


        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $form_data     = $request->all();   


        $arr_invitation['first_name']                = $form_data['first_name'];
        $arr_invitation['last_name']                 = $form_data['last_name'];
        $arr_invitation['gender']                    = isset($form_data['gender'])?$form_data['gender']:'';
        $birth_day                                   = isset($form_data['birth_day'])?$form_data['birth_day']:'';
        $birth_month                                 = isset($form_data['birth_month'])?$form_data['birth_month']:'';
        $birth_year                                  = isset($form_data['birth_year'])?$form_data['birth_year']:'';
        $arr_invitation['phone']                     = $form_data['phone'];
        $arr_invitation['email_id']                  = $form_data['email_id'];
        $arr_invitation['address']                   = $form_data['address'];

        $arr_invitation['is_general_practitioner']         = isset($form_data['is_general_practitioner'])?$form_data['is_general_practitioner']:'';

        $birth_date                                   = $birth_year.'-'.$birth_month.'-'.$birth_day;

        $arr_invitation['date_of_birth']              = $birth_date;
        $obj_invitation                              = $this->PatientInvitationModel;
        if($obj_invitation)
        {
            $arr_invitation['user_id']               = $this->user_id;
            $create_status                           = $obj_invitation->create($arr_invitation);

        }

        if($create_status)
        {
            Flash::success('Patient invitation is sent successfully.');
        } 
        else
        {
            Flash::error('Error occure while sending an invitation.');
        }
        return redirect()->back();

    }
}