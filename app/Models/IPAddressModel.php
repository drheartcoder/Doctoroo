<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IPAddressModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_user_ip_address";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'ip_address',
                                'browser_os'
                            ];
}
