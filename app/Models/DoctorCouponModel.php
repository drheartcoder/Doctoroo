<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DoctorCouponModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_doctor_coupon";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'doc_id',
                                'patient_id',
                                'code',
                                'value',
                                'expiry_date',
                                'status',
                               
                               
                            ];

    public function sharediscountcode()
    {
       return $this->hasMany('App\Models\ShareDiscountCodeModel','coupon_id','id');
    }

    


}