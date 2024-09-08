<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class PatientIllnessAndConditionModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_illness_and_conditions";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',    
                                'family_member_id',
                                'illness_id',

               
                            ];

   public function setIllnessIdAttribute($value) 
   {
        $this->attributes['illness_id'] = json_encode($value);
   }
   public function getIllnessIdAttribute($value) 
   {
        return json_decode($value,TRUE);
   }   

   public function medial_history()
   {
       return $this->belongsTo('App\Models\MedicalhistoryModel','user_id','user_id');
       
   } 
              
            
}