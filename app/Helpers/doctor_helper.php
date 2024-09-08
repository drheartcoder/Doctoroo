<?php 

use App\Models\UserModel;
use App\Models\MembershipPaymentModel;

function get_doctor_profile_data()
{
    $arr_details = $arr_doctor_data = [];

     $doctor_base_img_path   = public_path().config('app.project.img_path.doctor');
     $doctor_public_img_path = url('/public').config('app.project.img_path.doctor');


    $user   = Sentinel::check();
    if($user)
    {
        $obj_details     =         UserModel::where('id',$user->id)
                                              ->first(['title','email','first_name','last_name','profile_image']);
        if($obj_details)
        {
          $arr_details   = $obj_details->toArray();
        }
        $arr_doctor_data['title']                  = $arr_details['title'];
        $arr_doctor_data['profile_image']          = $arr_details['profile_image'];
        $arr_doctor_data['first_name']             = $arr_details['first_name'];
        $arr_doctor_data['last_name']              = $arr_details['last_name'];
        $arr_doctor_data['doctor_base_img_path']   = $doctor_base_img_path;
        $arr_doctor_data['doctor_public_img_path'] = $doctor_public_img_path;
    }
    return  $arr_doctor_data;
    
}
function create_booking_time_slots($endtime)
{
        $arr_time_slot       = $array_of_time = [];       

        $cur_time   = date("H:i");
        $starttime  = date('H:i', strtotime('+10 minutes', strtotime($cur_time)));

        $duration = '5';  
        $start_time          = strtotime ($starttime); 
        $end_time            = strtotime ($endtime); 

        $add_mins            = $duration * 60;

        while ($start_time <= $end_time) 
        {
           $array_of_time[] = date ("h:i a", $start_time);
           $start_time += $add_mins; 
        }
        return $array_of_time;
     
}

function membership()
{
    $user   = Sentinel::check();
    
    if($user)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $membership_count = MembershipPaymentModel::where('doctor_id' , $user->id)
                                               ->where('end_date' , '>' , $current_datetime)
                                               ->count();
        
        return $membership_count;                                                        
        
    }
}

?>