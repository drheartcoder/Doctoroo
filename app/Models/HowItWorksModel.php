<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWorksModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_how_it_works";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'title',
    							'slug',
    							'description',
    							'image',
    							'status',
    						];
}
