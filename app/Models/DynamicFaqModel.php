<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicFaqModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_faq_dynamic";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'page_id',
                               
                                'faqdescription'
                               
                            ];


  
}
