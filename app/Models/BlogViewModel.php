<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogViewModel extends Model
{

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_blog_views";
    protected $primaryKey = "id";

    protected $fillable   = [   
                               'blog_id',
                               'ip_address'
                            ];
}