<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicPagesModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_pages";
    protected $primaryKey = "page_id";

    protected $fillable   = [   
                                'page_name',
                                'page_slug',
                                'page_title',
                                'page_desc',
                                'title',
                                'subtitle',
                                'meta_title',
                                'meta_desc',
                                'meta_keyword',
                                'title1',
                                'description1',
                                'title2',
                                'description2',
                                'icon_description1',
                                'icon_description2',
                                'icon_description3',
                                 'title3',
                                'description3',
                                 
                                                   
                            ];

    public function descriptioninfo()
    {

       return $this->hasMany('App\Models\DescriptionModel','page_id','page_id');
       
    }
    public function aboutinfo()
    {

       return $this->hasMany('App\Models\DynamicAboutDoctorModel','page_id','page_id');
       
    }
    public function dynamicfaq()
    {

       return $this->hasMany('App\Models\DynamicFaqModel','page_id','page_id');
       
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
