<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_blog_category";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'category',
                                'status'
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
