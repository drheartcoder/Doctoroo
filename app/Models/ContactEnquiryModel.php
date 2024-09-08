<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiryModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at','deleted_at'];
    protected $table      = "dod_contact_enquiry";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'name',
                                'phone_no',
                                'email',
                                'message'
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
