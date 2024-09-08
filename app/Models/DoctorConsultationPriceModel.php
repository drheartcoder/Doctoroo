<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorConsultationPriceModel extends Model
{
	protected $dates 		= ['created_at','updated_at'];
    protected $table  		= 'dod_doctor_consultation_price';
    protected $primaryKey 	= "id";
    protected $fillable 	= [		
    							 'time',
    							 'day',
    							 'day_hourly_rate',
    							 'night',
    							 'night_hourly_rate',
                                 'patient_charges'
    						];		

}
