<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DisputeResponseModel extends Model
{
    

    protected $table      = "dod_dispute_response";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'dispute_id',
                                'from_id',
                                'to_id',
                                'response',
                                'attachment'
                            ];

	public function userinfo()
    {

        return $this->belongsTo('App\Models\UserModel','from_id','id');
    }                             

  
 }
