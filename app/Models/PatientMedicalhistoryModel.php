<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class PatientMedicalhistoryModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_medical_history_medications";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'family_member_id',
                                'medication_name',
                                'precription_file',
                                'date_started',
                                'm_number',
                                'frequency',
                                'm_use',
                                'm_type'

                            ];


    public function medicalhistory()
    {
       return $this->belongsTo('App\Models\MedicalhistoryModel','user_id','user_id');
       
    }                
              

}