<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientPrescriptionModel extends Model
{
   
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_prescription";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'patient_id',
                                'file_code',
                                'file_name'
                            ];
}
