<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AdminNotificationModel extends Model
{
    
	protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_admin_notification";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'user_id',
                                'message',
                                'is_read'
                            ];
 }
