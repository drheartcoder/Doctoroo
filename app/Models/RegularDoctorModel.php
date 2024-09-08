<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class RegularDoctorModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_patient_regular_doctor";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'reg_doctor_name',
                                'reg_practice_name',
                                'reg_doctor_phone',
                                'reg_doctor_address',
                                'notify_my_regular_doctor',
                                'invite_this_doctor'
                            ];

    public function userinfo()
    {
        return $this->belongsTo('App\Models\UserModel','user_id','id');
   
    }


   
 }