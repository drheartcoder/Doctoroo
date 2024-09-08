<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class ProfileAffectedAreaModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];

    protected $table      = "dod_profile_affected_area";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'patient_id',
                                'entitlement_id',
                                'card_no',
                                'affected_area_photo'
                            ];

   
                              

}