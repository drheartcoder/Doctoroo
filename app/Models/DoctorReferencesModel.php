<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorReferencesModel extends Model
{
  
    
    protected $table      = "dod_doctor_references";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'ref_index',
                                'reference_name' ,
                                'reference_number',
                                'reference_email',
                                'reference_phone'             
                            ];

  
  
}
