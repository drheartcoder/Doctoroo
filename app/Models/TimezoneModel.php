<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimezoneModel extends Model
{
    
    
    protected $table      = "dod_timezone";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'area',
                                'standard_time' ,
                                'summer_time',
                                'is_dst'             
                            ];

  	/*public function user_data()
    {
       return $this->belongsTo('App\Models\PatientModel','id','timezone');
    }*/
  
}
