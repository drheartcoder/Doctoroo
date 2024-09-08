<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AvailabilityModel extends Model
{
    

    protected $table      = "dod_availability";
    protected $primaryKey = "id";
    protected $fillable   = [   
    							'user_id',
                                'patient_name',
                                'date',
                                'start_time',
                                'end_time',
                                'repeat_status',
                                'weekly_day',
                                'frequency',
                                'ends_on',
                                'after_occurence',
                            ];

    public function user_details()
    {
       return $this->belongsTo('App\Models\UserModel','user_id','id');   
    }

    public function doctor_details()
    {
       return $this->belongsTo('App\Models\DoctorModel','user_id','user_id');   
    }
    public function doctor_premium_rates()
    {
       return $this->belongsTo('App\Models\DoctorPremiumRateModel','user_id','doctor_id');   
    }
    public function doctor_fee()
    {
        return $this->belongsTo('App\Models\DoctorFeeModel','user_id','doctor_id');   
    }
    

 }
