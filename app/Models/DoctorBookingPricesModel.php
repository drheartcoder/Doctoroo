<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorBookingPricesModel extends Model
{
	use SoftDeletes;

    protected $dates 		= ['created_at','updated_at','deleted_at'];
    protected $table  		= 'dod_doctor_booking_prices';
    protected $primaryKey 	= "id";
    protected $fillable 	= [		
    							 'shift',
    							 'call_length',
    							 'cost',
    							 'status'
    						];		

}
