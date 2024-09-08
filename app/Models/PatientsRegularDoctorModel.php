<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class PatientsRegularDoctorModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_regular_doctor";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'patient_id',
                                'doctor_id',
                                'regular'
                            ];

    
 }