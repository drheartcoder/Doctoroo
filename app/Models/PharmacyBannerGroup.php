<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PharmacyBannerGroupModel extends Model
{
    

    protected $table      = "dod_pharmacy_banner_group";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'name'
                            ];

  
 }
