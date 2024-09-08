<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class PaymentMethodsModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    protected $dates = [];
    protected $table      = "dod_payment_methods";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'card_no',
                                'card_type',
                                'card_expiry_date',
                                'cvv'
                            ];

   
    public function userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','user_id','id');
       
    }       

    public function medicaredetails()
    {
       return $this->belongsTo('App\Models\MedicareDetailsModel','user_id','user_id');
       
    }      

    public function regulardoctor()
    {
       return $this->belongsTo('App\Models\RegularDoctorModel','user_id','user_id');
       
    } 
     public function familymember()
    {
       return $this->belongsTo('App\Models\FamilyMemberModel','user_id','user_id');
       
    } 
    public function localpharmacy()
    {
       return $this->belongsTo('App\Models\MainPharmaciesModel','my_local_pharmacy','id');
       
    }                           

}