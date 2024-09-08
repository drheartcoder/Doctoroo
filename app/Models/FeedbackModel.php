<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_feedback";
    protected $primaryKey = "feedback_id";

    protected $fillable   = [   
                                'user_id',
                                'doctor_id',
                                'rating',
                                'feedback_regarding',
                                'feedback',
                                'any_changes_in_mind',
                                'email',
                                'message',
                                'status',
                            ];
    public function user_details()
    {
        return $this->BelongsTo('App\Models\UserModel','user_id','id');
    }    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
