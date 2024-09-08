<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MembershipDiscountCodeModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_membership_discount_code";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'code',
                                'percentage',
                                'start_expiry_date',
                                'end_expiry_date',
                                'status'
                            ];

    public function  used_discount()
    {
       return $this->belongsTo('App\Models\MembershipUsedDiscountModel','id','discount_id');
    }

}