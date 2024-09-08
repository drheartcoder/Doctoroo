<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagefeesModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table      = "dod_manage_fee";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'fees'               
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
