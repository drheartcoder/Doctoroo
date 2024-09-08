<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientConsultationBookingModel extends Model
{
    

    protected $table      = "dod_patient_consultation_booking";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                    'consultation_id',
                                    'family_member_id',
                                    'patient_user_id',
                                    'doctor_user_id',
                                    'visitor_id',
                                    'health_issue',
                                    'symptoms',
                                    'health_image',
                                    'consultation_for',
                                    'consultation_date',
                                    'consultation_time',
                                    'consultation_datetime',
                                    'reschedule_date_time',
                                    'consultation_charge',
                                    'consultation_charge_per_min',
                                    'card_paid_by',
                                    'eway_transaction_id',
                                    'transaction_id',
                                    'booking_status',
                                    'refund_date',
                                    'refind_amount',
                                    'refund_fee',
                                    'refund_status',
                                    'signup_type',
                                    'card_name',
                                    'card_number',
                                    'card_exp_month',
                                    'card_exp_year',
                                    'card_start_month',
                                    'card_start_year',
                                    'patient_is_ready',
                                    'patient_active_video_call',
                                    'doctor_is_ready',
                                    'doctor_active_video_call'
                            ];

        public function doctor_user_details()
        {
            return $this->belongsTo('App\Models\UserModel','doctor_user_id','id');      
        }   
        public function patient_user_details()
        {
            return $this->belongsTo('App\Models\UserModel','patient_user_id','id');      
        } 
        public function patient_info()
        {
            return $this->belongsTo('App\Models\PatientModel','patient_user_id','user_id');        
        } 
        public function familiy_member_info()
        {
            return $this->belongsTo('App\Models\FamilyMemberModel','family_member_id','id');        
        }    
        public function regular_doctor_info()
        {
            return $this->belongsTo('App\Models\RegularDoctorModel','patient_user_id','user_id');
        }  
        public function health_images()
        {
            return $this->hasMany('App\Models\PatientConsultationImagesModel','user_id','patient_user_id');
        }
        public function health_precription()
        {
            return $this->belongsTo('App\Models\PatientPrescriptionQuestionsModel','patient_user_id','user_id');
        } 
        public function medical_question()
        {
            return $this->belongsTo('App\Models\PatientMedicationQuestionsModel','patient_user_id','user_id');
        }     
        public function reminder_info()
        {   
            return $this->hasMany('App\Models\ReminderModel','booking_id','id');  
        }
        public function doctor_availability()
        {   
            return $this->hasMany('App\Models\AvailabilityModel','user_id','doctor_user_id');  
        }  
        public function booking_status_data()
        {
           return $this->hasMany('App\Models\PatientConsultationStatusModel','booking_id','id');  
        }
        public function doctor_info()
        {
            return $this->belongsTo('App\Models\DoctorModel','doctor_user_id','user_id');        
        }
        public function consultation_documents()
        {
            return $this->hasMany('App\Models\ConsultationDocumentsModel','consultation_id','id');        
        }
        public function consultation_notes()
        {
            return $this->belongsTo('App\Models\ConsultationNotesModel','id','consultation_id');        
        } 
        public function disputes()
        {
            return $this->hasMany('App\Models\DisputeModel','consultation_id','id');        
        }
        public function invoice_info()
        {
            return $this->hasMany('App\Models\PatientConsultationPaymentModel','booking_id','id');
        }

}
?>