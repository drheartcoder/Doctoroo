<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class InvoiceModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_invoices";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'doctor_id',
                                'patient_id',
                                'booking_id',
                                'status',
                                'sub_total',
                                'tax',
                                'grand_total'
                                
                            ];

    public function patientinfo()
    {
        return $this->belongsTo('App\Models\UserModel','patient_id','id');
    }

    public function doctorinfo()
    {
        return $this->belongsTo('App\Models\UserModel','doctor_id','id');
    }

    public function patient_consultation_info()
    {
        return $this->belongsTo('App\Models\PatientConsultationBookingModel','booking_id','id');
    }
    public function patient_address()
    {
        return $this->belongsTo('App\Models\PatientModel','patient_id','user_id');
    }
   /* public function bank_details()
    {
        return $this->belongsTo('App\Models\DoctorModel','doctor_id','user_id');
    }*/
   
 }