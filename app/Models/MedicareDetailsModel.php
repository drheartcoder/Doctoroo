<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MedicareDetailsModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_patient_medicare_details";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'medicare_type',
                                'medicare_card_no',
                                'individual_card_no',
                                'medicare_card_expiry_month',
                                'medicare_card_expiry_year',
                                'card_image'
                            ];
              

}