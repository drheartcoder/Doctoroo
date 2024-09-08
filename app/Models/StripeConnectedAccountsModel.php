<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class StripeConnectedAccountsModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_stripe_connecetd_accounts";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'connect_id',
                                'name',
                                'email',
                                'descriptor',
                                'type',
                                'country',
                                'currency'
                            ];
}