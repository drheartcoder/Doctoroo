<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientTempPrescriptionQuestionsModel extends Model
{
    

    protected $table      = "dod_patient_temporary_precription_questions";
    protected $primaryKey = "id";
    protected $fillable   = [   
								'user_id',
								'family_member_id',
								'who_is_patient',
								'what_symptoms',
								'currently_taking_medications',
								'what_is_medications',
								'current_prescription_upload',
								'how_long_medications',
								'other_info',
								'temp_booking_id'
                            ];  
}