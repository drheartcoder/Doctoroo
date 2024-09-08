<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MedicalhistoryModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_medical_history";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'family_member_id',
                                'health_issue',
                                'current_past_treatment',
                                'daily_sleep',
                                'smoking_status',
                                'smoking_frequency',
                                'diet_pattern',
                                'diet_other',
                                'recreational_drug_use',
                                'excersice',
                                'alcohol',
                                'stress_level',
                                'marital_status',
                                'allergies',
                                'surgeries_and_procedures',
                                'had_colonoscopy',
                                'obstetrics',
                                'complications',
                                'family_history',
                                'any_genetic_diseases',
                                'other'

                            ];
    public function illnessinfo()
    {
       return $this->belongsTo('App\Models\PatientIllnessAndConditionModel','user_id','user_id');       
    } 
    public function patient_medical_history()
    {
       return $this->belongsTo('App\Models\PatientMedicalhistoryModel','user_id','user_id');  
    }
    public function get_family_info()
    {
       return $this->hasMany('App\Models\FamilyMemberModel','user_id','id');
    }              
    public function illness()
    {
       return $this->hasMany('App\Models\IllnessAndConditionModel','user_id','id');
    }
    public function patient_details()
    {
       return $this->belongsTo('App\Models\PatientModel','user_id','user_id');
    }
    

}