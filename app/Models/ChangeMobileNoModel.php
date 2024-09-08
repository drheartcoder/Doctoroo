<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeMobileNoModel extends Model
{
   
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_change_mobile_no";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'patient_id',
                                'doctor_id',
                                'first_name',
                                'last_name',
                                'old_phone_no',
                                'new_country_code',
                                'new_phone_no',
                                'dob',
                                'address',
                                'last_consult_date',
                                'additional_notes'
                            ];
}
