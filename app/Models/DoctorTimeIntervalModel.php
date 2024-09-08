<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DoctorTimeIntervalModel extends CartalystUser
{
   
    
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_doctor_time_interval";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'doctor_id',
                                'time_interval'
                            ];

   
}