<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialityModel extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_speciality";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'speciality',
                                'image',
                                'meta_title',
                                'meta_keyword',
                                'meta_title',
                                'meta_desc',
                                'speciality_status',                                                  
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}



 ?>