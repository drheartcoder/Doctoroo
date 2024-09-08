<?php 

use App\Models\NotificationModel;
use App\Models\TimezoneModel;
use App\Models\UserModel;
use Carbon\Carbon;

function new_notification_count()
{
    $user   = Sentinel::check();
    
    if($user)
    {
        $new_notifications = NotificationModel::where([
                                                    ['to_user_id',$user->id],
                                                    ['status','unread']
                                                 ])
                                                ->count();
        if($new_notifications != 0 && $new_notifications !='')
        {
            return $new_notifications;                                                        
        }
    }
}

function login_user_info()
{
    $user   = Sentinel::check();
    
    if($user)
    {
        $login_user = UserModel::where('id',$user->id)
                                                ->first();
        if(isset($login_user) && !empty($login_user))
        {
            return $login_user['session_id'];                                                        
        }
    }   
}

/*------------------------------------------------------------------------------
| Decodes bcrypt value
--------------------------------------------------------------------------------*/

  function decrypt_value($value)
  {
    $decrypted = decrypt($value);
    return $decrypted;
  }

/*------------------------------------------------------------------------------
| Encodes bcrypt value
--------------------------------------------------------------------------------*/

    function encrypt_value($value)
    {
        $encrypted = encrypt($value);
        return $encrypted;
    }


    /*
    | Function  : Convert user datetime to utc datetime
    | Author    : Deepak Arvind Salunke
    | Date      : 04/04/2018
    | Output    : UTC DateTime for the given User DateTime Y-m-d H:i:s
    */


    function add_gst($amount)
    {
        // GST is 10% of the total amount
        // calculation for 10/100 is 0.1
        $gst_amount = $amount * 0.10;
        $total = $amount + $gst_amount;
        return $total;
    }



/*------------------------------------------------------------------------------
| Timezone Conversion
--------------------------------------------------------------------------------*/

    function convert_timezone($timezone,$datetime)
    {
        $date = new DateTime($datetime, new DateTimeZone($timezone));
        $new_date = $date->format('Y-m-d H:i:s');
        return $new_date;
    }


    /*
    | Function  : Convert user datetime to utc datetime
    | Author    : Deepak Arvind Salunke
    | Date      : 04/04/2018
    | Output    : UTC DateTime for the given User DateTime Y-m-d H:i:s
    */

    function convert_userdatetime_to_utc($user_id, $user_type, $date_time)
    {
        if($user_type == 'patient')
        {
            // get user timezone
            $get_user_data = UserModel::where('id',$user_id)->with('patientinfo', 'patientinfo.timezone_data')->first();
            if($get_user_data)
            {
                $user_data = $get_user_data->toArray();
                $user_timezone_id = $user_data['patientinfo']['timezone'];
                $user_timezone_data = $user_data['patientinfo']['timezone_data'];

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                }
                
                $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('Y-m-d H:i:s');

                return $modified_utc_date_time;
            }
            else
            {
                $set_user_timezone = TimezoneModel::where('id', 362)->first();
                if($set_user_timezone)
                {
                    $user_timezone_data = $set_user_timezone->toArray();

                    $user_offset = $user_timezone_data['utc_offset'];

                    $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                    $offset_hour         = substr($user_offset, 1, 2);
                    $offset_minute       = substr($user_offset, 4, 2);

                    $operation = $sign == ''? 'add': 'sub';
                    $modified_date_time = Carbon::parse($date_time);

                    if($operation=='add')
                    {
                        $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                        $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                    }   
                    elseif($operation=='sub')
                    {
                        $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                        $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                    }
                    
                    $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('Y-m-d H:i:s');

                    return $modified_utc_date_time;
                }
            }
        }
        if($user_type == 'doctor')
        {
            // get user timezone
            $get_user_data = UserModel::where('id',$user_id)->with('doctor_details', 'doctor_details.timezone_data')->first();
            if($get_user_data)
            {
                $user_data = $get_user_data->toArray();
                $user_timezone_id = $user_data['doctor_details']['timezone'];
                $user_timezone_data = $user_data['doctor_details']['timezone_data'];

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                }
                
                $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('Y-m-d H:i:s');

                return $modified_utc_date_time;
            }
            else
            {
                $set_user_timezone = TimezoneModel::where('id', 362)->first();
                if($set_user_timezone)
                {
                    $user_timezone_data = $set_user_timezone->toArray();

                    $user_offset = $user_timezone_data['utc_offset'];

                    $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                    $offset_hour         = substr($user_offset, 1, 2);
                    $offset_minute       = substr($user_offset, 4, 2);

                    $operation = $sign == ''? 'add': 'sub';
                    $modified_date_time = Carbon::parse($date_time);

                    if($operation=='add')
                    {
                        $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                        $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                    }   
                    elseif($operation=='sub')
                    {
                        $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                        $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                    }
                    
                    $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('Y-m-d H:i:s');

                    return $modified_utc_date_time;
                }
            }
        }
        if($user_type == 'admin')
        {
            $set_user_timezone = TimezoneModel::where('id', 362)->first();
            if($set_user_timezone)
            {
                $user_timezone_data = $set_user_timezone->toArray();

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                }
                
                $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('Y-m-d H:i:s');

                return $modified_utc_date_time;
            }
        }
    }

    /*
    | Function  : Convert utc datetime to user datetime
    | Author    : Deepak Arvind Salunke
    | Date      : 04/04/2018
    | Output    : UTC DateTime for the given User DateTime Y-m-d H:i:s
    */

    function convert_utc_to_userdatetime($user_id, $user_type, $date_time)
    {
        if($user_type == 'patient')
        {
            // get user timezone
            $get_user_data = UserModel::where('id',$user_id)->with('patientinfo', 'patientinfo.timezone_data')->first();
            if($get_user_data)
            {
                $user_data = $get_user_data->toArray();
                $user_timezone_id = $user_data['patientinfo']['timezone'];
                $user_timezone_data = $user_data['patientinfo']['timezone_data'];

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                }

                $modified_user_date_time     = Carbon::parse($user_date_time)->format('Y-m-d H:i:s');

                return $modified_user_date_time;
            }
            else
            {
                $set_user_timezone = TimezoneModel::where('id', 362)->first();
                if($set_user_timezone)
                {
                    $user_timezone_data = $set_user_timezone->toArray();

                    $user_offset = $user_timezone_data['utc_offset'];

                    $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                    $offset_hour         = substr($user_offset, 1, 2);
                    $offset_minute       = substr($user_offset, 4, 2);

                    $operation = $sign == ''? 'add': 'sub';
                    $modified_date_time = Carbon::parse($date_time);

                    if($operation=='add')
                    {
                        $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                        $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                    }   
                    elseif($operation=='sub')
                    {
                        $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                        $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                    }

                    $modified_user_date_time     = Carbon::parse($user_date_time)->format('Y-m-d H:i:s');

                    return $modified_user_date_time;
                }
            }
        }
        if($user_type == 'doctor')
        {
            // get user timezone
            $get_user_data = UserModel::where('id',$user_id)->with('doctor_details', 'doctor_details.timezone_data')->first();
            if($get_user_data)
            {
                $user_data = $get_user_data->toArray();
                $user_timezone_id = $user_data['doctor_details']['timezone'];
                $user_timezone_data = $user_data['doctor_details']['timezone_data'];

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                }
                
                $modified_user_date_time     = Carbon::parse($user_date_time)->format('Y-m-d H:i:s');

                return $modified_user_date_time;
            }
            else
            {
                $set_user_timezone = TimezoneModel::where('id', 362)->first();
                if($set_user_timezone)
                {
                    $user_timezone_data = $set_user_timezone->toArray();

                    $user_offset = $user_timezone_data['utc_offset'];

                    $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                    $offset_hour         = substr($user_offset, 1, 2);
                    $offset_minute       = substr($user_offset, 4, 2);

                    $operation = $sign == ''? 'add': 'sub';
                    $modified_date_time = Carbon::parse($date_time);

                    if($operation=='add')
                    {
                        $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                        $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                    }   
                    elseif($operation=='sub')
                    {
                        $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                        $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                    }
                    
                    $modified_user_date_time     = Carbon::parse($user_date_time)->format('Y-m-d H:i:s');

                    return $modified_user_date_time;
                }
            }
        }
        if($user_type == 'admin')
        {
            $set_user_timezone = TimezoneModel::where('id', 362)->first();
            if($set_user_timezone)
            {
                $user_timezone_data = $set_user_timezone->toArray();

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                }

                $modified_user_date_time     = Carbon::parse($user_date_time)->format('Y-m-d H:i:s');

                return $modified_user_date_time;
            }
        }
    }

    /*
    | Function  : Convert user time to utc time
    | Author    : Deepak Arvind Salunke
    | Date      : 04/04/2018
    | Output    : UTC Time for the given User Time H:i:s
    */

    function convert_usertime_to_utc($user_id, $user_type, $date_time)
    {
        if($user_type == 'patient')
        {
            // get user timezone
            $get_user_data = UserModel::where('id',$user_id)->with('patientinfo', 'patientinfo.timezone_data')->first();
            if($get_user_data)
            {
                $user_data = $get_user_data->toArray();
                $user_timezone_id = $user_data['patientinfo']['timezone'];
                $user_timezone_data = $user_data['patientinfo']['timezone_data'];

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                }
                
                $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('H:i:s');

                return $modified_utc_date_time;
            }
            else
            {
                $set_user_timezone = TimezoneModel::where('id', 362)->first();
                if($set_user_timezone)
                {
                    $user_timezone_data = $set_user_timezone->toArray();

                    $user_offset = $user_timezone_data['utc_offset'];

                    $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                    $offset_hour         = substr($user_offset, 1, 2);
                    $offset_minute       = substr($user_offset, 4, 2);

                    $operation = $sign == ''? 'add': 'sub';
                    $modified_date_time = Carbon::parse($date_time);

                    if($operation=='add')
                    {
                        $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                        $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                    }   
                    elseif($operation=='sub')
                    {
                        $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                        $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                    }
                    
                    $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('H:i:s');

                    return $modified_utc_date_time;
                }
            }
        }
        if($user_type == 'doctor')
        {
            // get user timezone
            $get_user_data = UserModel::where('id',$user_id)->with('doctor_details', 'doctor_details.timezone_data')->first();
            if($get_user_data)
            {
                $user_data = $get_user_data->toArray();
                $user_timezone_id = $user_data['doctor_details']['timezone'];
                $user_timezone_data = $user_data['doctor_details']['timezone_data'];

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                }
                
                $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('H:i:s');

                return $modified_utc_date_time;
            }
            else
            {
                $set_user_timezone = TimezoneModel::where('id', 362)->first();
                if($set_user_timezone)
                {
                    $user_timezone_data = $set_user_timezone->toArray();

                    $user_offset = $user_timezone_data['utc_offset'];

                    $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                    $offset_hour         = substr($user_offset, 1, 2);
                    $offset_minute       = substr($user_offset, 4, 2);

                    $operation = $sign == ''? 'add': 'sub';
                    $modified_date_time = Carbon::parse($date_time);

                    if($operation=='add')
                    {
                        $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                        $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                    }   
                    elseif($operation=='sub')
                    {
                        $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                        $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                    }
                    
                    $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('H:i:s');

                    return $modified_utc_date_time;
                }
            }
        }
        if($user_type == 'admin')
        {
            $set_user_timezone = TimezoneModel::where('id', 362)->first();
            if($set_user_timezone)
            {
                $user_timezone_data = $set_user_timezone->toArray();

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->subMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $utc_date_time           = $modified_hour_date_time->addMinute($offset_minute);
                }
                
                $modified_utc_date_time   = Carbon::parse($utc_date_time)->format('H:i:s');

                return $modified_utc_date_time;
            }
        }
    }

    /*
    | Function  : Convert utc time to user time
    | Author    : Deepak Arvind Salunke
    | Date      : 04/04/2018
    | Output    : User Time for the given UTC Time H:i:s
    */

    function convert_utc_to_usertime($user_id, $user_type, $date_time)
    {
        if($user_type == 'patient')
        {
            // get user timezone
            $get_user_data = UserModel::where('id',$user_id)->with('patientinfo', 'patientinfo.timezone_data')->first();
            if($get_user_data)
            {
                $user_data = $get_user_data->toArray();
                $user_timezone_id = $user_data['patientinfo']['timezone'];
                $user_timezone_data = $user_data['patientinfo']['timezone_data'];

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                }

                $modified_user_date_time     = Carbon::parse($user_date_time)->format('H:i:s');

                return $modified_user_date_time;

            }
            else
            {
                $set_user_timezone = TimezoneModel::where('id', 362)->first();
                if($set_user_timezone)
                {
                    $user_timezone_data = $set_user_timezone->toArray();

                    $user_offset = $user_timezone_data['utc_offset'];

                    $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                    $offset_hour         = substr($user_offset, 1, 2);
                    $offset_minute       = substr($user_offset, 4, 2);

                    $operation = $sign == ''? 'add': 'sub';
                    $modified_date_time = Carbon::parse($date_time);

                    if($operation=='add')
                    {
                        $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                        $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                    }   
                    elseif($operation=='sub')
                    {
                        $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                        $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                    }

                    $modified_user_date_time     = Carbon::parse($user_date_time)->format('H:i:s');

                    return $modified_user_date_time;
                }
            }
        }
        if($user_type == 'doctor')
        {
            // get user timezone
            $get_user_data = UserModel::where('id',$user_id)->with('doctor_details', 'doctor_details.timezone_data')->first();
            if($get_user_data)
            {
                $user_data = $get_user_data->toArray();
                $user_timezone_id = $user_data['doctor_details']['timezone'];
                $user_timezone_data = $user_data['doctor_details']['timezone_data'];

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                }
                
                $modified_user_date_time     = Carbon::parse($user_date_time)->format('H:i:s');

                return $modified_user_date_time;
            }
            else
            {
                $set_user_timezone = TimezoneModel::where('id', 362)->first();
                if($set_user_timezone)
                {
                    $user_timezone_data = $set_user_timezone->toArray();

                    $user_offset = $user_timezone_data['utc_offset'];

                    $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                    $offset_hour         = substr($user_offset, 1, 2);
                    $offset_minute       = substr($user_offset, 4, 2);

                    $operation = $sign == ''? 'add': 'sub';
                    $modified_date_time = Carbon::parse($date_time);

                    if($operation=='add')
                    {
                        $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                        $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                    }   
                    elseif($operation=='sub')
                    {
                        $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                        $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                    }
                    
                    $modified_user_date_time     = Carbon::parse($user_date_time)->format('H:i:s');

                    return $modified_user_date_time;
                }
            }
        }
        if($user_type == 'admin')
        {
            $set_user_timezone = TimezoneModel::where('id', 362)->first();
            if($set_user_timezone)
            {
                $user_timezone_data = $set_user_timezone->toArray();

                $user_offset = $user_timezone_data['utc_offset'];

                $sign                = substr($user_offset, 0, 1) == '+'? '': '-';
                $offset_hour         = substr($user_offset, 1, 2);
                $offset_minute       = substr($user_offset, 4, 2);

                $operation = $sign == ''? 'add': 'sub';
                $modified_date_time = Carbon::parse($date_time);

                if($operation=='add')
                {
                    $modified_hour_date_time = $modified_date_time->addHour($offset_hour);
                    $user_date_time          = $modified_hour_date_time->addMinute($offset_minute);
                }   
                elseif($operation=='sub')
                {
                    $modified_hour_date_time = $modified_date_time->subHours($offset_hour);
                    $user_date_time          = $modified_hour_date_time->subMinute($offset_minute);
                }

                $modified_user_date_time     = Carbon::parse($user_date_time)->format('H:i:s');

                return $modified_user_date_time;
            }
        }
    }

?>