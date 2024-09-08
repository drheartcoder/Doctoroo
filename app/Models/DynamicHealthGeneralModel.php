<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DynamicHealthGeneralModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_dynamic_health_general";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'patient_id',
                                'doctor_id',
                                'general_id',
                                'title',
                                'description',
                                'status'
                            ];


}