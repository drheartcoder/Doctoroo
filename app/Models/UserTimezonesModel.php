<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTimezonesModel extends Model
{
    
    public $timestamps =false;
    protected $table      = "dod_user_timezone";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'timezone_id',
                                'timezone'             
                            ];

  	public function timezone_data()
    {
       return $this->belongsTo('App\Models\TimezonesModel','timezone_id','id');  
    }

    public function timezone_arr()
    {
       return $this->belongsTo('App\Models\TimezoneModel','timezone_id','id');  
    }
  
}
