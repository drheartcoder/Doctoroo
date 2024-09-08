<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class UserPreferencesModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps    = false;
    protected $table      = "dod_user_preferences";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'entitlement_id',
                                'brand',
                                'card_no',
                                'affected_area'
                            ];


}