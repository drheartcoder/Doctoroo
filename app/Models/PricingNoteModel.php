<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingNoteModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_pricing_note";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'pricing_note'
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
