<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MainPharmaciesModel extends Model
{
    

    protected $table      = "dod_main_pharmacies";

    protected $fillable   = [   
                                'pharmacy_name',    
                                'location',
                                'suburb',
                                'phone_no',
                                'latitude',
                                'longitude'
                            ];


    public function pharmacy_applications()
    {
    	return $this->belongsTo('App\Models\PharmacyModel','id','main_pharmacy_id');
    }  
  
  
}
