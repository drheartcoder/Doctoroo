<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqsMembershipModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table      = "dod_faqs_membership";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'category_id',
                                'question',
                                'slug',
                                'answer' ,
                                'status'             
                            ];

    public function  faq_membership_catgeory()
    {
       return $this->belongsTo('App\Models\FaqMembershipCategoryModel','category_id','id');
       
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
