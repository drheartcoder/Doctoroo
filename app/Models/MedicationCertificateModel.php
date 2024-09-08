<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MedicationCertificateModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_medical_certificate";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'created_by',
                                'patient_id',
                                'family_member_id',
                                'start_date',
                                'end_date',
                                'activity',
                                'reason_for_absent'
                            ];

    public function  userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','created_by','id');  
    }
}