<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class HealthGeneralModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps    = false;
    protected $table      = "dod_health_general";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'allergy',
                                'allergy_details',
                                'surgery',
                                'surgery_details',
                                'pregnancy',
                                'pregnancy_details',
                                'family_history',
                                'family_history_details',
                                'other',
                                'other_details',
                                'diabetes',
                                'diabetes_details',
                                'heart_disease',
                                'heart_disease_details',
                                'stroke',
                                'stroke_details',
                                'blood_pressure',
                                'blood_pressure_details',
                                'high_cholesterol',
                                'high_cholesterol_details',
                                'asthma',
                                'asthma_details',
                                'depression',
                                'depression_details',
                                'arthritis',
                                'arthritis_details'
                            ];


}