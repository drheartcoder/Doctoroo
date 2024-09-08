<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DoctorModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_doctor";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'referral_by',
                                'gender',
                                'dob',
                                'citizenship',
                                'contact_no',
                                'mobile_code',
                                'mobile_no',
                                'address',
                                'timezone',
                                'clinic_name',
                                'clinic_address',
                                'clinic_email',
                                'clinic_contact_no',
                                'clinic_mobile_no_code',
                                'clinic_mobile_no',
                                'experience',
                                'language',
                                'medical_qualification',
                                'medical_school',
                                'year_obtained',
                                'country_obtained',
                                'other_qualifications',
                                'bank_account_name',
                                'bsb',
                                'account_number',
                                'id_proof_file',
                                'medical_registration_no',
                                'medical_registration_certificate',
                                'medicare_provider_no',
                                'prescriber_no',
                                'ahpra_registration_no',
                                'abn',
                                'pi_insurance_policy',
                                'cyber_liability_insurance_policy',
                                'about_me',
                                'profile_video',
                                'provider_no',
                                'speciality',
                                'legally_telemedicine',
                                'ABN_invited',
                                'profile_complete',
                                'doctor_status',
                                'register_ahpra'
                            ];


    public function userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','user_id','id');
       
    }
    public function doctor_refernces()
    {
       return $this->hasMany('App\Models\DoctorReferencesModel','user_id','user_id');
    }
    
    public function doctor_preferences()
    {
        return $this->belongsTo('App\Models\DoctorPreferencesModel','user_id','user_id');
    }

    public function available_doctor()
    {
        return $this->belongsTo('App\Models\AvailabilityModel','user_id','id');
    }
    public function mobile_country_code()
    {
        return $this->belongsTo('App\Models\MobileCountryCodeModel','mobile_code','id');
    }
    public function doctor_available()
    {
        return $this->belongsTo('App\Models\AvailabilityModel','user_id','user_id');
    }
    public function doctor_premium_rates()
    {
       return $this->belongsTo('App\Models\DoctorPremiumRateModel','user_id','doctor_id');   
    }
    public function stripe_connect()
    {
       return $this->belongsTo('App\Models\StripeConnectedAccountsModel','user_id','user_id');   
    }
    public function doctor_timezone()
    {
       return $this->belongsTo('App\Models\TimezoneModel','timezone','id');   
    }

    public function timezone_data()
    {
       return $this->hasOne('App\Models\TimezoneModel','id','timezone');
    }

}