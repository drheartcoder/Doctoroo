<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempConsultationBookingModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_patient_temporary_consultation_booking";
    protected $primaryKey = "booking_id";

    protected $fillable   = [   
                               'user_id',
                               'family_member_id',
                               'visitor_id',
                               'health_issue',
                               'consultation_for',
                               'signup_type',
                               'card_name',
                               'card_number',
                               'card_exp_month',
                               'card_exp_year',
                               'card_start_month',
                               'card_start_year'
                            ];
}