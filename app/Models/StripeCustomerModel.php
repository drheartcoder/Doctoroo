<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class StripeCustomerModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_stripe_customer_id";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'email',
                                'customer_id'
                            ];
}