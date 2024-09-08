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
                                'prefernces',           
                            ];

}
