<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class DoctroFeesModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_doctor_fees";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'doctor_id',
                                'fee',
                                'doctoroo_commission',
                                'doctoroo_fee',
                                'total_fee'
                            ];

   
                              

}