<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    

    protected $table      = "dod_notification";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'from_user_id',
                                'to_user_id',
                                'booking_id',
                                'message',
                                'status',
                                'reminder_status',
                                'type'
                                
                            ];

    public function user_details()
    {
       return $this->belongsTo('App\Models\UserModel','from_user_id','id');
       
    }  
    public function booking_details()
    {
       return $this->belongsTo('App\Models\PatientConsultationBookingModel','booking_id','id');
       
    }         
  
 }
