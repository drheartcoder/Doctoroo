<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditsModel extends Model
{
   
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_credits";
    protected $primaryKey = "id";

    protected $fillable   = [   
    							 'user_id',
                                'from_user_id',
                                'to_user_id',
                                'channel_id',
                                
                            ];


}
