<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TempPatientMedicationQuestionsModel extends Model
{
    

    protected $table      = "dod_patient_temporary_medical_history_questions";
    protected $primaryKey = "id";
    protected $fillable   = [   
    							 'user_id',
    							 'family_member_id',
    							 'temp_booking_id',
    							 'who_is_patient',
    							 'symptoms',
    							 'symptoms_from',
    							 'certificate_from_date',
    							 'certificate_to_date' 
                            ];  
}