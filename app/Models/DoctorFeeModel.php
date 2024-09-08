<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorFeeModel extends Model
{
   
    protected $dates      = ['created_at','updated_at', 'deleted_at'];
    protected $table      = "doctor_fees";
    protected $primaryKey = "id";

    protected $fillable   = [
                            'doctor_id',
                            'day',
                            'start_time',
                            'start_time_to_str',
                            'end_time',
                            'end_time_to_str',
                            'dr_fee_per_min',
                            'dr_fee_per_hr',
                            'earning_for_4_min',
                            'earning_per_min',
                            'doctoroo_fee',
                            'total_patient_fee_for_four_min',
                            'total_patient_fee_of_additional_afer_four_min'
                            ];
}
