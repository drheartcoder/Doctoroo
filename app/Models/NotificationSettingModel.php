<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSettingModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $dates      = ['created_at','updated_at','deleted_at'];
    public $timestamps=false;
    protected $table      = "dod_notification_settting";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'notification',
                                'status'
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
