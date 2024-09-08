<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DoctorPremiumMembershipModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_doctor_premium_membership";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'monthly_amount',
                                'monthly_gst',
                                'monthly_discount',
                                'annually_amount',
                                'annually_gst',
                                'annually_discount',
                                'total_monthly_amount',
                                'total_annually_amount'
                            ];
                         

}