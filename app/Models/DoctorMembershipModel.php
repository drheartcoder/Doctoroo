<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DoctorMembershipModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_doctor_membership";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'call_time',
                                'day_patient_charge',
                                'day_doctor_earning',
                                'day_pro_rata_hourly_rate',
                                'night_patient_charge',
                                'night_doctor_earning',
                                'night_pro_rata_hourly_rate',
                            ];

   
}