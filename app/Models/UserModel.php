<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserModel extends CartalystUser
{
   
    use SoftDeletes;
   
    protected $dates = ['created_at','updated_at'];
    protected $table      = "users";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'email',
                                'title',
                                'password',
                                'permissions',
                                'last_login',
                                'first_name',
                                'profile_image',
                                'user_status',
                                'last_name',
                                'token',
                                'verification_status',
                                'admin_verification_status_mini',
                                'admin_verification_status_main',
                                'is_online',
                                'active_video_call',
                                'dump_id',
                                'dump_session',
                                'login_time',
                                'logout_time'
                            ];

    public function  patientinfo()
    {
       return $this->belongsTo('App\Models\PatientModel','id','user_id');
       
    }       
    public function doctor_details()
    {
        return $this->belongsTo('App\Models\DoctorModel','id','user_id');
    }

    public function doctor_preferences()
    {
        return $this->hasMany('App\Models\DoctorPreferencesModel','user_id','id');
    }

    public function admin_details()
    {
        return $this->BelongsTo('App\Models\AdminProfileModel','id','user_id');
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
