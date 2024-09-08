<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_blog";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'title',
                                'slug',
                                'category',
                                'date',
                                'postedby',
                                'image',
                                'description',
                                'status',
                                'meta_title',
                                'meta_keyword',
                                'meta_desc'
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    function category_details()
    {
        return $this->belongsTo('App\Models\BlogCategoryModel','category','id');
    }
}
