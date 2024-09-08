<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class ConsultationDocumentsModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_consultation_documents";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'id',
                                'consultation_id',
                                'patient_id',
                                'doctor_id',
                                'document'
                            ];

    public function user_data()
    {
        return $this->belongsTo('App\Models\UserModel','doctor_id','id');
    }

    public function doctor_data()
    {
        return $this->belongsTo('App\Models\DoctorModel','id','doctor_id');
    }

}