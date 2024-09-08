<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AustraliaStatesModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_australia_states";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'name',
                                'code',
                                'status'
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
