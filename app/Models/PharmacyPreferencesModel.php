<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyPreferencesModel extends Model
{
    
    
    protected $table      = "dod_pharmacy_preferences";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'day' ,
                                'from_time',
                                'to_time',
                                'status',          
                            ];


 	function pharmacy_details()
    {
        return $this->belongsTo('App\Models\PharmacyModel','user_id','user_id');
    }


        

}
