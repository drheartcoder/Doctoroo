<?php

use App\Models\PatientConsultationBookingModel;

function change_status_of_booking($booking_id , $status)
{
  if($booking_id!='' && $booking_id!='null' && $status!='' && $status!='null')
  {
    $update_arr = array('booking_status'=>ucfirst($status));
    $res = PatientConsultationBookingModel::where('id',$booking_id)->update($update_arr);
    if($res)
    {
        return true;
    }
    else
    {
       return false;
    }
  }
  return false;
}


function check_expired_booking()
{
  $update_arr = array('booking_status'=>'Expired');
  $curr_time  = date('H:i');
  $curr_date  = date('Y-m-d');
  $res        = PatientConsultationBookingModel::where('booking_status','Pending')
                                              ->where('consultation_time','<=',$curr_time)
                                              ->where('consultation_date','<=',$curr_date)
                                              ->update($update_arr);
  if($res)
  {
      return true;
  }
  else
  {
     return false;
  }
}

?>