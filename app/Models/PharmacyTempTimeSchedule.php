<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PharmacyTempTimeSchedule extends Model
{
    

    protected $table      = "dod_temp_pharmacy_time_schedule";

    protected $fillable   = [   
                                'application_id',    
                                'main_pharmacy_id',
                                'mon_open',
                                'mon_close',
                                'tue_open',
                                'tue_close',
                                'wed_open',
                                'wed_close',
                                'thu_open',
                                'thu_close',
                                'fri_open',
                                'fri_close',
                                'sat_open',
                                'sat_close',
                                'sun_open',
                                'sun_close',
                                'opening_hour_notes',

                            ];
  
  
}
