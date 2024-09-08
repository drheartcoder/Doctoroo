<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MembershipUsedDiscountModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_membership_used_discount";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'discount_id',
                                'doctor_id'
                            ];

    public function discount_code()
    {
        return $this->belongsTo('App\Models\MembershipDiscountCodeModel','discount_id','id');
    }

    public function user_details()
    {
        return $this->belongsTo('App\Models\UserModel','doctor_id','id');
    }

}