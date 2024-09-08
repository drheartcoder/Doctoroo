<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class ConsultationNotesModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_consultation_notes";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'consultation_id',
                                'doctor_id',
                                'patient_id',
                                'notes'
                            ];



}