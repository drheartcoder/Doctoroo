<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class PatientModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_patient";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'entitlement_id',
                                'gender',
                                'date_of_birth',
                                'mobile_code',
                                'mobile_no',
                                'phone_no',
                                'country',
                                'state',
                                'city',
                                'zipcode',
                                'affected_area',
                                'card_no',
                                'streen_address',
                                'suburb',
                                'timezone',
                                'type',
                                'original_profile_type',
                                'created_by',
                                'card_no',
                                'my_local_pharmacy',
                                'sms_notification',
                                'stop_notification',
                                'stop_marketing_notification',
                                'my_referral_code',
                                'friend_referral_code',
                                'referred_by',
                                'referred_point',
                            ];

   
    public function userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','user_id','id');  
    }       

    public function medicaredetails()
    {
       return $this->belongsTo('App\Models\MedicareDetailsModel','user_id','user_id');
       
    }

    public function regulardoctor()
    {
       return $this->belongsTo('App\Models\RegularDoctorModel','user_id','user_id');
       
    } 
    public function familymember()
    {
       return $this->belongsTo('App\Models\FamilyMemberModel','user_id','user_id');  
    } 
    public function localpharmacy()
    {
       return $this->belongsTo('App\Models\MainPharmaciesModel','my_local_pharmacy','id');
       
    }

    public function memberfamily()
    {
       return $this->hasMany('App\Models\FamilyMemberModel','user_id','user_id');  
    }

    public function familydoctor()
    {
       return $this->hasMany('App\Models\FamilyDoctorsModel','user_id','user_id');  
    }

    public function entitlement()
    {
       return $this->belongsTo('App\Models\EntitlementModel','entitlement_id','id');  
    }

    public function regularfamilydoctor()
    {
       return $this->hasMany('App\Models\PatientsRegularDoctorModel','patient_id','user_id');  
    }

    public function timezone_data()
    {
       return $this->hasOne('App\Models\TimezoneModel','id','timezone');
    }

    public function country_code()
    {
        return $this->hasOne('App\Models\MobileCountryCodeModel','id','mobile_code');
    }


}