<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientConsultationPaymentModel extends Model
{
    
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_consultation_payment";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                    'invoice_id',
                                    'booking_id',
                                    'patient_id',
                                    'doctor_id',
                                    'charge_id',
                                    'payment_status',
                                    'payment_amount',
                                    'call_time'
                            ];

    public function consultation_details()
    {
        return $this->belongsTo('App\Models\PatientConsultationBookingModel','booking_id','id');
    }

    public function user_data()
    {
        return $this->belongsTo('App\Models\UserModel','patient_id','id');
    }

    public function patient_data()
    {
        return $this->belongsTo('App\Models\PatientModel','patient_id','user_id');
    }

    public function doctor_data()
    {
        return $this->belongsTo('App\Models\DoctorModel','doctor_id','user_id');
    }

    public function doctor_user_data()
    {
        return $this->belongsTo('App\Models\UserModel','doctor_id','id');
    }
        
}
?>