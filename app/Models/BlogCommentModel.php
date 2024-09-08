<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCommentModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_blog_comments";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'blog_id',
                                'user_id',
                                'comment',
                                'parent_id'
                            ];

    public function user_details()
    {
        return $this->belongsto('App\Models\UserModel','user_id','id');
    }

}
