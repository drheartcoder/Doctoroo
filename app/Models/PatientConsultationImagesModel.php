<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientConsultationImagesModel extends Model
{
    
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_consultation_images";
    protected $primaryKey = "id";

    protected $fillable   = [   
                               'user_id',
                               'family_member_id',
                               'health_image',
                               'booking_id'
                            ];
}