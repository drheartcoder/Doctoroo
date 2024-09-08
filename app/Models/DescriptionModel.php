<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptionModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_our_services";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'page_id',
                                'description',
                               
                            ];


  
}
