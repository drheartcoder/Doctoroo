<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicAboutDoctorModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_about_our_doctor";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'page_id',
                               'description'
                               
                            ];


  
}
