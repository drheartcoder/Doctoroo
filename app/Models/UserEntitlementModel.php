<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class UserEntitlementModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps=false;
    protected $table      = "dod_user_entitlement";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'entitlement_id',
                                'affect_area_img',
                                'card_no'
                            ];

    
    public function profile_affected_area()
    {
        return $this->hasMany('App\Models\ProfileAffectedAreaModel','patient_id','user_id');
    }  

    public function user_entitlement()
    {
        return $this->belongsTo('App\Models\EntitlementModel','entitlement_id','id');
    }                          

}