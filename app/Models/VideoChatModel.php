<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoChatModel extends Model
{
   
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_video_chat";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'patient_id',
                                'doctor_id',
                                'session_id',
                                'api_key',
                                'token'
                            ];
}
