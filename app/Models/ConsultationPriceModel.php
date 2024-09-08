<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationPriceModel extends Model
{
	protected $dates 		= ['created_at','updated_at','deleted_at'];
    protected $table  		= 'dod_consultation_price';
    protected $primaryKey 	= "price_id";
    protected $fillable 	= [		
    							 'consultation_time_from',
    							 'consultation_time_to',
    							 'patient_day_cost',
    							 'doctor_day_fee',
    							 'day_profit',
    							 'patient_night_cost',
    							 'doctor_night_fee',
    							 'night_profit'
    						];		

}
