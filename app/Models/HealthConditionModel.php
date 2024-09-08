<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class HealthConditionModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps    = false;
    protected $table      = "dod_health_condition";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'diabetes',
                                'heart_desease',
                                'heart_desease_detail',
                                'stroke',
                                'blood_pressure',
                                'high_cholestrol',
                                'asthma',
                                'depression',
                                'arthrits',
                            ];


}