<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class LifeStylelModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps    = false;
    protected $table      = "dod_lifestyle";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'physical_activity',
                                'food_habit',
                                'smoking',
                                'alcohol',
                                'stress_level',
                                'average_sleep',
                                'other_lifestyle'
                            ];


}