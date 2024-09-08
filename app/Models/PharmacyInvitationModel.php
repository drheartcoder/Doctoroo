<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class PharmacyInvitationModel extends CartalystUser
{
        use SoftDeletes;
        protected $dates      = ['created_at','updated_at'];
        protected $table      = "dod_pharmacy_invitation";
        protected $primaryKey = "id";

        protected $fillable   = [   
                                    'user_id',
                                    'pharmacy_name',
                                    'pharmacy_no',
                                    'contact_person',
                                    'address',
                                    'phone',
                                    'email',
                                 
                                ];

        public function userinfo()
        {
            return $this->belongsTo('App\Models\UserModel','user_id','id');
       
        }


   
 }