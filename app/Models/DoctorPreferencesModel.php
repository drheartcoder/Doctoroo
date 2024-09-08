<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorPreferencesModel extends Model
{
    
    
    protected $table      = "dod_doctor_preferences";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'day' ,
                                'from_time',
                                'to_time',
                                'status',
                            ];


    function doctor_details()
    {
        return $this->belongsTo('App\Models\DoctorModel','user_id','user_id');
    }

    function user_details()
    {
        return $this->belongsTo('App\Models\UserModel','user_id','id');
    }
}
