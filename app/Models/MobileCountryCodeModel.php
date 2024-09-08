<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileCountryCodeModel extends Model
{
   
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_mobile_country_code";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'iso',
                                'name',
                                'nicename',
                                'iso3',
                                'numcode',
                                'phonecode'
                            ];
}
