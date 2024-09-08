<?php
namespace App\Http\Controllers\Front\Doctor;
use App\Models\UserModel;
use App\Models\AvailabilityModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
Use Validator;

class AppointmentController extends Controller
{
    public function __construct(UserModel        $user_model,
                                AvailabilityModel $availability_model)
    {

        $this->arr_view_data                      = [];

        $this->UserModel                           = $user_model;
        $this->AvailabilityModel                   = $availability_model;
      
      	$this->module_view_folder                 = 'front.doctor.availability';
        $this->module_url_path                    = url('/').'/doctor/profile';
        $this->module_title                       = "Appointment";
    
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }


    }
    /*
        Rohini Jagtap
        load calendar for avilability
        date:29 march 2017
    */
    public function index(Request $request)
    {

        $arr_appoinment_dates = $arr_appoinment = [];
        $obj_appoinment = $this->AvailabilityModel->where('user_id',$this->user_id)->get();
        if(isset($obj_appoinment))
        {

            $arr_appoinment_dates = $obj_appoinment->toArray();
        }
        if(isset($arr_appoinment_dates) && sizeof($arr_appoinment_dates)>0)
        {
            foreach ($arr_appoinment_dates as $key => $value) 
            {

                 $arr_appoinment[$key]['title'] = $value['patient_name'];
                 $arr_appoinment[$key]['start'] = $value['date'].' '.$value['start_time'];
                 $arr_appoinment[$key]['end']   = $value['date'].' '.$value['end_time'];
                 $arr_appoinment[$key]['id']    = $value['id'];
            }

        }
        $current_date   = date('Y-m-d');
    
        $this->arr_view_data['arr_appoinment']       = $arr_appoinment;
        $this->arr_view_data['current_date']         = $current_date;
        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['module_title']         = $this->module_title;
        $this->arr_view_data['page_title']           = 'Calender & Appointment';
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
    /*
        Rohini Jagtap
        create an avilability of doctor
        date:29 march 2017
    */
    public function create(Request $request)
    {
            $start_time =  $end_time = $date = '';
            $form_data  =  $arr_appoinment = $arr_json = [];
            $form_data  = $request->all();

            if(isset($form_data['start_time']) && isset($form_data['end_time']))
            {
                 $start_time = date('H:i',strtotime($form_data['start_time']));
                 $end_time   = date('H:i',strtotime($form_data['end_time']));
                 $date       = date('Y-m-d',strtotime($form_data['start_time']));

            }

            $arr_appoinment['user_id']        = $this->user_id;
            $arr_appoinment['date']           = $date;
            $arr_appoinment['start_time']     = $start_time;
            $arr_appoinment['end_time']       = $end_time;


            $appoinment_status = $this->AvailabilityModel->create($arr_appoinment);
            if($appoinment_status)
            {
                $arr_json['status']     =  "success";
                Flash::success('Appointment created successfully.'); 

            }
            else
            {
                 $arr_json['status']     =  "error";
                Flash::error('Error while creating an appointment.'); 
            }
            return response()->json($arr_json);

    }
    /*
        Rohini Jagtap
        update an avilability of doctor
        date:29 march 2017
    */

    public function update(Request $request)
    {
            $start_time = $end_time = '';
            $form_data  =  $arr_update_appoinment = $arr_json = [];
            $form_data  =  $request->all();

            if(isset($form_data['start_time']) && isset($form_data['end_time']))
            {
                 $start_time = date('H:i',strtotime($form_data['start_time']));
                 $end_time   = date('H:i',strtotime($form_data['end_time']));
                 $date       = date('Y-m-d',strtotime($form_data['start_time']));

            }

            if(isset($form_data['id']) && $form_data['id']!='')
            {
               $arr_update_appoinment['start_time'] = $start_time; 
               $arr_update_appoinment['end_time']   = $end_time; 
               $arr_update_appoinment['date']       = $date;
            }

            $obj_appointment              = $this->AvailabilityModel->where('id',$form_data['id']);
            $appoinment_status            = $obj_appointment->update($arr_update_appoinment);
            if($appoinment_status)
            {

                $arr_json['status']     =  "success";
                $arr_json['msg']        =  "Appointment updated successfully.";
             

            }
            else
            {
                 $arr_json['status']     =  "error";
                 $arr_json['msg']        =  "Error while creating an appointment.";
                 
            }
            return response()->json($arr_json);

    }
}

?>