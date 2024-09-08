<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class EntitlementModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_entitlement";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'id',
                                'entitlement'
                            ];


    public function userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','user_id','id');
       
    }
    public function doctor_refernces()
    {
       return $this->hasMany('App\Models\DoctorReferencesModel','user_id','user_id');
    }
    
    public function doctor_preferences()
    {
        return $this->belongsTo('App\Models\DoctorPreferencesModel','user_id','user_id');
    }

    public function available_doctor()
    {
        return $this->belongsTo('App\Models\AvailabilityModel','user_id','id');
    }

}