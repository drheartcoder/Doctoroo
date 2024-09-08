<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PrefixModel extends Model
{
    

    protected $table      = "dod_prefix";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'name',  
                            ];

  
 }
