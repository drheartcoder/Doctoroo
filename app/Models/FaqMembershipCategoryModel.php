<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class FaqMembershipCategoryModel extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_faq_membership_category";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'category_name',
                                'cat_slug',
                                'belongs_to',
                                'status',
                            ];


}