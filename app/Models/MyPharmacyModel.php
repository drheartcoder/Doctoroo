<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MyPharmacyModel extends Model
{
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_my_pharmacy";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'patient_id',    
                                'pharmacy_id',
                            ];

    public function patient_user_details()
    {
    	return $this->belongsTo('App\Models\UserModel','patient_id','id');
    }

    public function pharmacy_user_details()
    {
    	return $this->belongsTo('App\Models\UserModel','pharmacy_id','id');
    }

    public function pharmacy_details()
    {
    	return $this->belongsTo('App\Models\PharmacyModel','pharmacy_id','user_id');
    }

    public function pharmacy_list()
    {
        return $this->belongsTo('App\Models\PharmacyListModel','pharmacy_id','id');
    }    

 }
