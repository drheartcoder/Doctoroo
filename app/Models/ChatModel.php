<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
   
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_chat";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'channel_id',
                                'patient_id',
                                'patient_name',
                                'doctor_id',
                                'doctor_name',
                                'pharmacy_id',
                                'pharmacy_name',
                                'dump_id',
                                'dump_session'
                            ];
}
