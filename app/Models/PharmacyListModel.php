<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PharmacyListModel extends Model
{
    

    protected $table      = "dod_pharmacy_list";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'category',    
                                'company_name',  
                                'street',  
                                'suburb',
                                'state',
                                'code',
                                'country',
                                'phone',
                                'website',
                                'mobile',
                                'toll_free',
                                'fax',
                                'abn',
                                'postal_address',
                                'email',
                                'latitude',
                                'longitude'
                            ];

 }
