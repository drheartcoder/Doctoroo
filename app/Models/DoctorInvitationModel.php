<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DoctorInvitationModel extends CartalystUser
{
        use SoftDeletes;
   
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_doctor_invitation";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'first_name',
                                'last_name',
                                'phone',
                                'email',
                                'practice_name',
                                'address',
                                'notify_my_regular_doctor',
                                'invite_this_doctor'
                            ];

    public function userinfo()
    {
        return $this->belongsTo('App\Models\UserModel','user_id','id');
   
    }


   
 }