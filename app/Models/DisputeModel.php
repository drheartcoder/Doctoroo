<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DisputeModel extends Model
{
    

    protected $table      = "dod_disput";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'added_by_user_id',
                                'against_user_id',
                                'dispute_id',
                                'consultation_id',
                                'payment_reason',
                                'amount',
                                'select_payment',
                                'what_is_issue',
                                'status',
                                'admin_comments',
                                'what_solution_you_like' 
                            ];

    public function userinfo()
    {

        return $this->belongsTo('App\Models\UserModel','added_by_user_id','id');
    }                        

    public function disputeresponse()
    {

        return $this->hasMany('App\Models\DisputeResponseModel','dispute_id','id');
    }

    public function added_by_user_info()
    {
        return $this->belongsTo('App\Models\UserModel','added_by_user_id','id');
    }
    public function against_user_info()
    {
        return $this->belongsTo('App\Models\UserModel','against_user_id','id');
    } 

    public function booking_data()
    {
        return $this->belongsTo('App\Models\PatientConsultationBookingModel','consultation_id','id');
    }                       

  
 }
