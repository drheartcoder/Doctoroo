<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MedicalHistoryUpdatesModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_medical_history_updates";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'patient_id',
                                'updated_by'
                            ];

    public function user_info()
    {
       return $this->belongsTo('App\Models\UserModel','updated_by','id');
       
    }
}