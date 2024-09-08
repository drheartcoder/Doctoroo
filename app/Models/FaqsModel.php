<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqsModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table      = "dod_faqs";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'category_id',
                                'question',
                                'slug',
                                'answer' ,
                                'status'             
                            ];

    public function  faq_catgeory()
    {
       return $this->belongsTo('App\Models\FaqCategoryModel','category_id','id');
       
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
