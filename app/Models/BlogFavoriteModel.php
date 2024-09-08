<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogFavoriteModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_blog_favorite";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'blog_id',
                                'user_id'
                            ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */  
}