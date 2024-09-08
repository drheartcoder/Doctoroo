<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempConsultationBookingImagesModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_temporary_consultation_images";
    protected $primaryKey = "booking_id";

    protected $fillable   = [   
                               'user_id',
                               'family_member_id',
                               'temp_booking_id',
                               'health_image',
                            ];
}