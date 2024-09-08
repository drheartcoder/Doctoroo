<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OtpModel extends Model
{
    
    protected $table      = "dod_otp";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                    'user_id',
                                    'otp',
                                    'email',
                                    'mobile_no',
                                    'created_on',
                                    'expired_on'
                            ];



        
        

}
?>