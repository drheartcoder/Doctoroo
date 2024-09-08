<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class LanguageModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_language";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                    'language',
                                    'language_status'                     
                            ];
}