<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class ShareDiscountCodeModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_share_discount_code";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'coupon_id',
                                'doctor_id',
                                'patient_id',
                                'status'
                            ];

   public function userinfo()
   {
     return $this->belongsTo('App\Models\UserModel','patient_id','id');
   }
   public function doctorinfo()
   {
     return $this->belongsTo('App\Models\UserModel','doctor_id','id');
   }

   public function coupondetails()
   {
     return $this->belongsTo('App\Models\DoctorCouponModel','coupon_id','id');
   }   


}