<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PharmacyModel extends Model
{
    

    protected $table      = "dod_pharmacy";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'user_id',    
                                'main_pharmacy_id',  
                                'token_id',  
                                'contact_role',
                                'other_role',
                                'email_id',
                                'pharmacy_name',
                                'phone',
                                'fax',
                                'address1',
                                'address2',
                                'part_of_banner_group',
                                'other_group',
                                'group_fax',
                                'logo',
                                'website',
                                'ABN_number',
                                'aprox_script_per_day',
                                'computer_system_used',
                                'other_computer_system',
                                'services',
                                'other_service',
                                'membership_status',
                                'allow_notifications',
                                'noti_message',
                                'noti_new_patient',
                                'noti_new_booking',
                                'noti_ans_a_question',
                                'noti_accept_aust_patients',
                            ];

   public function userinfo()
   {
         return $this->belongsTo('App\Models\UserModel','user_id','id');
   
   }          

   public function timeSchedule()
   {
     return $this->hasOne('App\Models\PharmacyTimeSchedule','user_id','user_id');
   } 
   public function setServicesAttribute($value) 
   {
        $this->attributes['services'] = json_encode($value);
   }
   public function getServicesAttribute($value) 
   {
        return json_decode($value, TRUE);
   } 
   public function other_banner_group()
   {
       return $this->hasOne('App\Models\PharmacyBannerGroupModel','id','other_group');
   }  
            
  
 }
