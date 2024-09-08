<?php
namespace App\Http\Controllers\Front\Doctor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AvailabilityModel;
use App\Models\PatientConsultationBookingModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
Use Validator;
use DB;
use Session;
use File;
use Stripe;


class AvailabilityController extends Controller
{
      public function __construct(AvailabilityModel                 $availability_model,
                                  PatientConsultationBookingModel   $consultation_model)
      {
        $this->arr_view_data                    = [];
         
        $this->AvailabilityModel                = $availability_model;
        $this->PatientConsultationBookingModel  = $consultation_model;

        $this->module_title                     = "Availability"
;      	$this->module_view_folder               = 'front.doctor.availability';
        $this->module_url_path                  = url('/').'/doctor/availability';
        $this->profile_img_base_path            = public_path().config('app.project.img_path.patient');
        $this->profile_img_public_path          = url('/public').config('app.project.img_path.patient');

        $user = Sentinel::check();
        if($user)
        {
          $this->user_id = $user->id;
        }
        else
        {
          $this->user_id = null;
        }

        DB::connection()->enableQueryLog();
    }

    public function index()
    {
      $date = date('Y-m-d'); 

      $get_available_time = $this->AvailabilityModel->where('user_id',$this->user_id)
                                                    ->where('date', $date)
                                                    ->get();

      $this->arr_view_data['current_day']   = date('j');                                                    
      $this->arr_view_data['current_month'] = date('M');                                                    

      if(isset($get_available_time) && !empty($get_available_time))
      {
        $this->arr_view_data['get_available_time_arr'] = $get_available_time->toArray();
      }

      $get_booking_time = $this->PatientConsultationBookingModel->where('doctor_user_id',$this->user_id)
                                                                ->where('consultation_date', $date)
                                                                ->where('booking_status','Confirmed')
                                                                ->with('patient_user_details','familiy_member_info')
                                                                ->get();
      if(isset($get_booking_time) && !empty($get_booking_time))
      {
        $this->arr_view_data['get_booking_time_arr'] = $get_booking_time->toArray();
      }
      
      $this->arr_view_data['doctor_id']              = $this->user_id;
      $this->arr_view_data['page_title']             = 'Doctor Availability';
      $this->arr_view_data['module_url_path']        =  $this->module_url_path;
      return view($this->module_view_folder.'.index',$this->arr_view_data);
    }


    public function get_available_time(Request $request)
    {
      $date1 = strtr($request->selected_date, '/', '-');
      $date  = date('Y-m-d', strtotime($date1)); 

      $arr_json[] ='';
      $get_available_time = $this->AvailabilityModel->where('user_id',$this->user_id)
                                                      ->where('date', $date)
                                                      ->get();
      if(isset($get_available_time) && !empty($get_available_time))
      {
        $get_available_time_arr = $get_available_time->toArray();

        foreach ($get_available_time_arr as $key => $value) {
          $arr_json[$key]['id']             = $value['id'];
          $arr_json[$key]['user_id']        = $value['user_id'];
          $arr_json[$key]['patient_name']   = $value['patient_name'];
          $arr_json[$key]['date']           = $value['date'];
          $arr_json[$key]['start_time']     = convert_utc_to_userdatetime($this->user_id, "doctor", $value['start_time']);
          $arr_json[$key]['end_time']       = convert_utc_to_userdatetime($this->user_id, "doctor", $value['end_time']);
          $arr_json[$key]['repeat_status']  = $value['repeat_status'];
          $arr_json[$key]['frequency']      = $value['frequency'];
          $arr_json[$key]['weekly_day']     = $value['weekly_day'];
          $arr_json[$key]['after_occurence']= $value['after_occurence'];
          $arr_json[$key]['time_slot']      = $value['time_slot'];
          $arr_json[$key]['created_at']     = $value['created_at'];
          $arr_json[$key]['updated_at']     = $value['updated_at'];
        }
      }
      
      return response()->json($arr_json);
    }


    public function get_booking_time(Request $request)
    {
      $date1 = strtr($request->selected_date, '/', '-');
      $date = date('Y-m-d', strtotime($date1)); 

      $arr_json[] ='';
      $get_booking_time = $this->PatientConsultationBookingModel->where('doctor_user_id',$this->user_id)
                                                      ->where('consultation_date', $date)
                                                      ->where('booking_status','Confirmed')
                                                      ->with('patient_user_details','familiy_member_info')
                                                      ->get();
      if(isset($get_booking_time) && !empty($get_booking_time))
      {
        $get_booking_time_arr = $get_booking_time->toArray();

        $arr_json = $get_booking_time_arr;
      }
      
      return response()->json($arr_json);
    }


    public function store(Request $request)
    {
      $start_date = strtr($request->date, '/', '-');
      $start_date = date('Y-m-d', strtotime($start_date));

      $start_time = convert_userdatetime_to_utc($this->user_id, "doctor", $request->from_time);
      $end_time   = convert_userdatetime_to_utc($this->user_id, "doctor", $request->to_time);

      $query = $this->AvailabilityModel;
      
      $arr_data['user_id']          = $this->user_id;
      $arr_data['date']             = $start_date;
      //$arr_data['start_time']       = $start_time;
      //$arr_data['end_time']         = $end_time;
      
      $end_date = strtr($request->ends_on, '/', '-');
      $ends_on  = date('Y-m-d', strtotime($end_date));
      $arr_data['ends_on'] = $ends_on;

      if($request->advance_options == 'true')
      {
        $repeats = $request->repeat;
        if($repeats == 'daily')
        {
                $difference = strtotime($ends_on) - strtotime($start_date);
                $no_of_days = $difference/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
                $arr_data['ends_on'] = $arr_data['date'] = $start_date;
                
                $arr_data['start_time']  = $start_time;
                $arr_data['end_time']    = $end_time;

                for($i = 0; $i <= $no_of_days; $i++)
                {
                    $res = $this->AvailabilityModel->create($arr_data);
                    
                    $temp_date = strtotime("+1 day", strtotime($arr_data['ends_on']));

                    $arr_data['date']    = date("Y-m-d", $temp_date);
                    $arr_data['ends_on'] = date("Y-m-d", $temp_date);

                    $temp_start = strtotime("+1 day", strtotime($arr_data['start_time']));
                    $temp_end = strtotime("+1 day", strtotime($arr_data['end_time']));

                    $arr_data['start_time'] = date('Y-m-d H:i:s', $temp_start);
                    $arr_data['end_time'] = date('Y-m-d H:i:s', $temp_end);
                }
            
        }
        if($repeats == 'weekly')
        {   
            $weekly_day_count = 0;
            $difference = strtotime($ends_on) - strtotime($start_date);
            $no_of_days = $difference/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
            $arr_data['ends_on'] = $arr_data['date'] = $start_date;

            $arr_data['start_time']  = $start_time;
            $arr_data['end_time']    = $end_time;

            $i = 0;
            for($i = 0; $i <= $no_of_days; $i++)
            {
              $temp_date = strtotime("+1 day", strtotime($arr_data['ends_on']));
              $date = date("Y-m-d", $temp_date);

              $arr_data['date']    = date("Y-m-d", $temp_date);
              $arr_data['ends_on'] = date("Y-m-d", $temp_date);

              $temp_start = strtotime("+1 day", strtotime($arr_data['start_time']));
              $temp_end = strtotime("+1 day", strtotime($arr_data['end_time']));

              $arr_data['start_time'] = date('Y-m-d H:i:s', $temp_start);
              $arr_data['end_time'] = date('Y-m-d H:i:s', $temp_end);

              $get_day = date("l", strtotime($arr_data['date']));
              
              if(in_array($get_day, $request->days))
              {
                  $weekly_day_count +=1;
                  $res = $this->AvailabilityModel->create($arr_data);
              }
            }
            if($weekly_day_count == 0)
            {
              $arr_response['msg'] = 'No day found in between start and end date. Please check dates ';
              return response()->json($arr_response);
            }

        }
      }
      
      if($request->advance_options == 'false')
      {
          $query = $query->where('date', $start_date)
                          ->where('user_id',$this->user_id)
                          ->where(function($avai) use($start_time,$end_time){
                     $avai->whereRaw('? between start_time and end_time', [$start_time]);
                     $avai->orwhereRaw('? between start_time and end_time', [$end_time]);
                  })->get();

      if(isset($query) && !empty($query) && sizeof($query) > 0)
      {
          $get_avail_time_arr = $query->toArray();
          foreach ($get_avail_time_arr as $value) {
              
              if($start_time < date('H:i',strtotime($value['start_time'])))
              {
                  $res = $this->AvailabilityModel->where('id',$value['id'])->update(['start_time' => $start_time]);
              }
              if($end_time > date('H:i',strtotime($value['end_time'])))
              {
                  $res = $this->AvailabilityModel->where('id',$value['id'])->update(['end_time' => $end_time]);
              }
              else if($start_time < date('H:i',strtotime($value['start_time'])) == false && $end_time > date('H:i',strtotime($value['end_time'])) == false)
              {
                 $arr_response['msg'] = 'The time you\'ve selected has already been stored';
                return response()->json($arr_response);
              }
          }
      }
      else
      {
        $res = $this->AvailabilityModel->create($arr_data);
      }                

          
      }

      if(isset($res))
      {
        //$arr_response['msg'] = 'Availability Added Successfully.';
        $arr_response['msg'] = 'Details Successfully Saved';
      }
      else
      {
        $arr_response['msg'] = 'Something went to wrong.'; 
      }

      return response()->json($arr_response);
      
    }

    public function update(Request $request)
    {
        $id         = $request->id;

        $start_time = convert_usertime_to_utc($this->user_id, "doctor", $request->start_time);
        $end_time   = convert_usertime_to_utc($this->user_id, "doctor", $request->end_time);

        $upd_arr = array(
                'start_time' => $start_time,
                'end_time'   => $end_time
              );
        if(isset($id) && $id != '')
        {
            $res = $this->AvailabilityModel->where('id' ,$id)
                                        ->update($upd_arr);
             if($res)
             {
                //$arr_json['msg'] = 'Availability time updated successfully';
                $arr_json['msg'] = 'Details Successfully Saved';
             }
             else
             {
                $arr_json['msg'] = 'Something went to wrong';
             } 
        }
        else
        {
          $arr_json['msg'] = 'Something went to wrong.';
        }

        return response()->json($arr_json);                                         
    }

    public function delete_available_time(Request $request)
    {
      if($request->id)
      {
        $avail_id = $request->id;
        if($request->action =='check_booking_time')
        {
            $avail_obj = $this->AvailabilityModel->where('id', $avail_id)->first();
            
            if($avail_obj)
            {
              $avail_arr = $avail_obj->toArray();
              $avail_date = isset($avail_arr['date']) ? date('Y-m-d' , strtotime($avail_arr['date'])) : '';
              $avail_start_time = isset($avail_arr['start_time']) ? convert_userdatetime_to_utc($this->user_id, "doctor", $avail_arr['start_time']) : '';
              $avail_end_time = isset($avail_arr['end_time']) ? convert_userdatetime_to_utc($this->user_id, "doctor", $avail_arr['end_time']) : '';
            }
           
            $get_consult = $this->PatientConsultationBookingModel->where('doctor_user_id', $this->user_id)
                                                                 ->where('consultation_date' , $avail_date)
                                                                 ->where('booking_status' , 'Confirmed')
                                                                 ->orWhere('booking_status' , 'Rescheduled')
                                                                 ->whereBetween('consultation_time', array($avail_start_time , $avail_end_time))
                                                                 ->get();

            if(count($get_consult) > 0 )
            {
              $consult_data = $get_consult->toArray();

              foreach($consult_data as $data)
              {
                /*\Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
                $refund = Stripe\Refund::create(array(
                  "charge" => $data['transaction_id'],
                  //"amount" => 1000,
                  "refund_application_fee" => true,
                  "reverse_transfer" => true
                ));

                $update['refund_date']    = date("Y-m-d");
                $update['refind_amount']  = '';
                $update['refund_status']  = 'Completed';*/
                $update['booking_status'] = 'Cancelled';

                $this->PatientConsultationBookingModel->where('id', $data['id'])->update($update);
              }

              $arr_response['status'] = "consultation_booked";
              $arr_response['msg'] = 'A consultation has been booked during this period. Are you sure you want to delete this availability?';
            }
            else
            {
              $arr_response['status'] = "success";
              $arr_response['msg'] ='Availability time has been deleted successfully';
              $res = $this->AvailabilityModel->where('id', $avail_id)
                                             ->delete();
              if($res)
              {
                  //$arr_response['msg']='Availability time has been deleted successfully';
                  $arr_response['msg'] = 'Details Successfully Deleted';
              }
              else
              {
                $arr_response['msg']='Something went to wrong ! Please try again later';
              }                                             
            }
        }
        else if($request->action=='confirm_delete')
        {
            $res = $this->AvailabilityModel->where('id', $avail_id)
                                             ->delete();
              if($res)
              {
                  //$arr_response['msg']='Availability time has been deleted successfully';
                  $arr_response['msg'] = 'Details Successfully Deleted';
              }
              else
              {
                $arr_response['msg']='Something went to wrong ! Please try again later';
              }                                             
        }

        return response()->json($arr_response);                                                      

      }
    }

}
?>