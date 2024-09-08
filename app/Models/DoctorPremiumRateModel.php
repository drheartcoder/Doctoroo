<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DoctorPremiumRateModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_doctor_premium_rate";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'doctor_id',
                                'day_rate',
                                'night_rate',
                                'day_total_rate',
                                'night_total_rate'
                            ];

    public function  userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','doctor_id','id');
       
    }
    public function  membership_payment()
    {
       return $this->belongsTo('App\Models\MembershipPaymentModel','doctor_id','doctor_id');
       
    }                            

   
}