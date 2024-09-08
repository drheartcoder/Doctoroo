<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ReminderModel extends Model
{
    

    protected $table      = "dod_reminders";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'patient_user_id',
                                'doctor_user_id',
                                'booking_id',
                                'reminder_minute',
                                'reminder_hour',
                                'reminder_date_before',
                                'reminder_status'
                                
                            ];

   
  
 }
