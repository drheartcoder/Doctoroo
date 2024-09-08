<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PharmacyTempApplicationModel extends Model
{
    

    protected $table      = "dod_temp_pharmacy_applications";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'main_pharmacy_id', 
                                'token_id',   
                                'first_name',
                                'last_name',
                                'contact_role',
                                'email_id',
                                'password',
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
                                'accept_medical_certificate',
                                'accept_pharmacist_consultation',
                                'herbal_medicines',
                                'photo_services',
                                'specialized_compounding',
                                'flu_vaccination _clinics',
                                'delivery',
                                'opening_hours_notes',

                            ];

    public function tempTimeSchedule()
    {

        return $this->belongsTo('App\Models\PharmacyTempTimeSchedule','id','application_id');
    }                        
  
 }
