<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientConsultationStatusModel extends Model
{
    
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_consultation_status";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                    'booking_id',
                                    'user_id',
                                    'doctor_id',
                                    'status',
                                    'performed_by',
                                    'comment'
                            ];

    public function doc_booking_info()
    {
       return $this->belongsTo('App\Models\PatientConsultationBookingModel','booking_id','id');  
    }
    public function userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','performed_by','id');  
    }
}
?>