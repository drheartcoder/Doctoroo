<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class IllnessAndConditionModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_illness_and_conditions";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'illness_name',
                                'illness_status'
               
                            ];
              

}