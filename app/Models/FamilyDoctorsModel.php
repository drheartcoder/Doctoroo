<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class FamilyDoctorsModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $timestamps = false;
    protected $dates = ['created_at'];
    protected $table      = "dod_family_doctors";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'first_name',
                                'last_name',
                                'phone_no',
                                'mobile_no',
                                'email',
                                'practice_name',
                                'practice_address',
                                'consultation_details',
                                'status',
                                'patient_action',
                                'invitation'
                            ];

    public function  userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','user_id','id');
       
    }

}