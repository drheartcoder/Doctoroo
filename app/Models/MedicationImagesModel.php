<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class MedicationImagesModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_medication_images";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'medication_id',
                                'file'
                            ];


}