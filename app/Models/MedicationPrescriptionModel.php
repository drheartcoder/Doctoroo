<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MedicationPrescriptionModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_medication_prescription";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'patient_id',
                                'doctor_id',
                                'medication_id',
                                'prescription_date',
                                'repeats',
                                'directions',
                                'hardcopy_location',
                                'pharmacy_id',
                                'uploaded_file',
                                'file_added_by',
                                'file_added_on'
                            ];

    public function pharmacy_data()
    {
       return $this->belongsTo('App\Models\PharmacyModel','pharmacy_id','user_id');
    } 

    public function  userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','file_added_by','id');  
    }

    public function  doctor_details()
    {
       return $this->belongsTo('App\Models\UserModel','doctor_id','id');  
    }    

    public function pharmacy_list()
    {
       return $this->belongsTo('App\Models\PharmacyListModel','pharmacy_id','id');
    }

}