<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MedicationModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_medication";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'medication_name',
                                'active_ingredient',
                                'medication_purpose',
                                'medication_duration'
                            ];

    public function medication_img()
    {
       return $this->hasMany('App\Models\MedicationImagesModel','medication_id','id');  
    }

    public function  userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','user_id','id');
       
    }  
}