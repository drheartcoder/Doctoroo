<?php
use App\Models\SocialLinksModel;
use App\Models\AdminProfileModel;
use App\Models\ConsultationPriceModel;

function get_social_links()
{
  $obj_social_links = array();
  $obj_social_links = SocialLinksModel::first();
  if($obj_social_links!=FALSE)
  {
    $arr_social_links = $obj_social_links->toArray();
    if(count($arr_social_links)>0)
    {
      return $arr_social_links;
    }
  }
}

function get_admin_details()
{
  $obj_admin_details = array();
  $obj_admin_details = AdminProfileModel::first();
  if($obj_admin_details!=FALSE)
  {
    $arr_admin_details = $obj_admin_details->toArray();
    if(count($arr_admin_details)>0)
    {
      return $arr_admin_details;
    }
  }
}

function convert_12_to_24($input)
{
  return date("H:i", strtotime($input));
}

function convert_24_to_12($input)
{
  return date("g:i a", strtotime($input));
}

function create_time_slots($start_time,$end_time,$day_val,$slot_arr=array())
{

  $time = Date('H:i');
  
  if($day_val=='today')
  {
      if($end_time == '24:00')
      {
          $end_time = '23:50';
      }  
      
      $time_diff =   get_time_difference($start_time,$time);
      $new_time  =  $start_time; 
      
      if($time_diff<"00:10:00")
      {
          $new_time =  date('H:i',strtotime('+10 minutes',strtotime($start_time)));
      }

      if($new_time>$time)
      {
          if(!in_array(convert_24_to_12($new_time), $slot_arr))
          $slot_arr[]=convert_24_to_12($new_time);
          $start_time = $new_time;
      }
      else
      {
        do
        {
          $getslot = date('H:i',strtotime('+5 minutes',strtotime($start_time)));
          $start_time = $getslot;
        }
        while($getslot<$time);
        //dd($start_time);
        $time_diff =   get_time_difference($start_time,$time);
        //dd($start_time,$time,$time_diff);
        if($time_diff<"00:10:00")
        {
            $new_time =  date('H:i',strtotime('+10 minutes',strtotime($start_time)));
        }
        
        if(!in_array(convert_24_to_12($new_time), $slot_arr))
        {    
            $slot_arr[]=convert_24_to_12($new_time);
            $start_time = $new_time;
        }
      }

      $new_slot = date('H:i',strtotime('+5 minutes',strtotime($start_time)));
      //echo $new_slot.' <= '.$time;
      if($new_slot <= $end_time && $new_slot>=$time)
      {
        if(!in_array(convert_24_to_12($start_time), $slot_arr))
        {    
            $slot_arr[]=convert_24_to_12($new_slot);
        }
        return create_time_slots($new_slot,$end_time,$day_val,$slot_arr);
      }    
    }
    else
    {
      $start_time = date('H:i',strtotime($start_time));
      if($end_time == '24:00')
      {
          $end_time = '23:50';
      }  

      if(!in_array(convert_24_to_12($start_time), $slot_arr))
      {    
          $slot_arr[]=convert_24_to_12($start_time);
      }
      
      $new_slot = date('H:i',strtotime('+5 minutes',strtotime($start_time)));

      if($new_slot <= $end_time && $new_slot!='00:00' )
      {
        if(!in_array(convert_24_to_12($new_slot), $slot_arr))
        {    
            $slot_arr[]=convert_24_to_12($new_slot);
        }
        return create_time_slots($new_slot,$end_time,$day_val,$slot_arr);
      } 
    }
  return $slot_arr;
}

function create_time_slots_old($start_time,$end_time,$day_val,$slot_arr=array())
{

  $time = Date('H:i');
  
  if($day_val=='today')
  {
      $time_diff =   get_time_difference($start_time,$time);
      //dd($start_time,$time_diff);
      if($time_diff<"00:10:00")
      {
          $start_time =  date('H:i',strtotime('+15 minutes',strtotime($start_time)));
      }

      if($end_time == '24:00')
      {
          $end_time = '23:50';
      }  

      if($start_time>$time)
      {
          if(!in_array(convert_24_to_12($start_time), $slot_arr))
          $slot_arr[]=convert_24_to_12($start_time);
      }
      else
      {
        do
        {
          $getslot = date('H:i',strtotime('+5 minutes',strtotime($start_time)));
          $start_time = $getslot;
        }
        while($getslot<$time);
        if(!in_array(convert_24_to_12($start_time), $slot_arr))
        {    
            $slot_arr[]=convert_24_to_12($start_time);
        }
      }

      $new_slot = date('H:i',strtotime('+5 minutes',strtotime($start_time)));
      //echo $new_slot.' <= '.$time;
      if($new_slot <= $end_time && $new_slot>=$time)
      {
        if(!in_array(convert_24_to_12($start_time), $slot_arr))
        {    
            $slot_arr[]=convert_24_to_12($new_slot);
        }
        return create_time_slots($new_slot,$end_time,$day_val,$slot_arr);
      }    
    }
    else
    {
      $start_time = date('H:i',strtotime($start_time));
      if($end_time == '24:00')
      {
          $end_time = '23:50';
      }  

      if(!in_array(convert_24_to_12($start_time), $slot_arr))
      {    
          $slot_arr[]=convert_24_to_12($start_time);
      }
      
      $new_slot = date('H:i',strtotime('+5 minutes',strtotime($start_time)));

      if($new_slot <= $end_time && $new_slot!='00:00' )
      {
        if(!in_array(convert_24_to_12($new_slot), $slot_arr))
        {    
            $slot_arr[]=convert_24_to_12($new_slot);
        }
        return create_time_slots($new_slot,$end_time,$day_val,$slot_arr);
      } 
    }
  return $slot_arr;
}

function get_time_difference($time1, $time2) 
{
    $time1 = strtotime("1980-01-01 $time1");
    $time2 = strtotime("1980-01-01 $time2");
    if ($time2 < $time1) 
    {
        $time2 += 86400;
    }
    return date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time1 - $time2));
}

function get_consultation_minute_cost($minutes,$day_night='day')
{
  $day_start_time = '8 AM';
  $day_end_time = '8 PM';
  $night_start_time = '8 PM';
  $night_end_time = '8 AM';
  $curr_time = date('H:i');
  if($minutes!='' && $day_night!='')
  {
    //DB::enableQueryLog();
    $res = ConsultationPriceModel::whereRaw('"'.$minutes.'"  BETWEEN consultation_time_from  AND consultation_time_to')->first();
    if($res)
    {
      $arr = $res->toArray();
      if(count($arr)>0)
      {
        if($curr_time > convert_12_to_24($day_start_time) && $curr_time < convert_12_to_24($day_end_time))
        {
          $res_arr['price'] =  $arr['patient_day_cost'];
          $res_arr['message'] = '';
        }
        else
        {
          $res_arr['price'] =  $arr['patient_night_cost'];
          $res_arr['message'] = '';
        }
      }
      else
      {
        $res_arr['price'] = '0:00';
        $res_arr['message'] = '';
      }
    }
    else
    {
        $res_arr['price'] = '0:00';
        $res_arr['message'] = '';
    }
  }
  else
  {
    $res_arr['price'] = '0:00';
    $res_arr['message'] = '';
  }

  return $res_arr;
}

?>