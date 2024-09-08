<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingTableModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_pricing_table";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'length_of_call',
                                'day_time_cost',
                                'night_time_cost'
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
