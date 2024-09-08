<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FamilyMemberModel extends Model
{
   
    protected $dates = ['created_at','updated_at'];
    protected $table      = "dod_family_members";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'user_id',
                                'relationship',
                                'first_name',
                                'last_name',
                                'gender',
                                'email',
                                'date_of_birth',
                                'mobile_number',
                            ];

     public function consultation_info()
     {
        return $this->belongsTo('App\Models\PatientConsultationBookingModel','id','family_member_id');        
     }
     
    public function  userinfo()
    {
       return $this->belongsTo('App\Models\UserModel','user_id','id');
       
    }           

}