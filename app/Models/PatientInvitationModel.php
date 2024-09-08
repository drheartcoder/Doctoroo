<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class PatientInvitationModel extends CartalystUser
{
   
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_patient_invitation";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'first_name',
                                'last_name',
                                'phone',
                                'email_id',
                                'address'
                            ];

    public function userinfo()
    {
        return $this->belongsTo('App\Models\UserModel','user_id','id');
    }
    public function doctor_info()
    {
         return $this->belongsTo('App\Models\DoctorModel','user_id','user_id');
    }

   
 }