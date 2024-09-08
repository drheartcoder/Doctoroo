<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MembershipPaymentModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_membership_payment";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'doctor_id',
                                'invoice_no',
                                'transaction_id',
                                'package',
                                'card_no',
                                'card_expiry_month',
                                'card_expiry_year',
                                'amount',
                                'gst',
                                'discount_id',
                                'total_amount',
                                'start_date',
                                'end_date',
                                'status',
                                'next_month_membership'
                            ];

    public function  userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','doctor_id','id');
    }                               

    public function  doctorinfo()
    {
       return $this->belongsTo('App\Models\DoctorModel','doctor_id','user_id');
    }

    public function  discount_data()
    {
       return $this->belongsTo('App\Models\MembershipDiscountCodeModel','discount_id','id');
    }                               

   
}