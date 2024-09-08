<?php

namespace App\Http\Controllers\Front\Patient;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PatientInvitationModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Validator;
use Response;



class RequestController extends Controller
{
      public function __construct(UserModel             $user_model,
      							 PatientInvitationModel             $invitation_model)
      {

          $this->arr_view_data                = [];
          $this->UserModel                    = $user_model;
          $this->PatientInvitationModel       = $invitation_model;
          $this->module_title                 = "Request";
          $this->module_view_folder           = 'front.patient';
          $this->module_url_path              = url('/').'/patient/request';

          $this->user       = Sentinel::check();
          if($this->user)
          {
          	 $this->user_id = $this->user->id;
          }


    }
    /*
		  desc:get invitation from doctor
    */
    public function index()
    {
    	$arr_invited_doctor        = [];
    	$email_id   	             = $this->user->email;
   		$obj_doctor_request        = $this->PatientInvitationModel->where('email_id','=',$email_id)
                   										  ->with(['userinfo'=>function($q){
                   										   		$q->select('id','first_name','last_name');
                   										   },'doctor_info'=>function($q1){

                                            $q1->select('id','user_id','speciality');

                                         }])
                   										   ->select('id','user_id','email_id')
             										         ->get();
   		if($obj_doctor_request)
   		{
   			$arr_invited_doctor    = $obj_doctor_request->toArray();
   		}
   		$this->arr_view_data['arr_invited_doctor'] = $arr_invited_doctor;
   		$this->arr_view_data['module_url_path']    = $this->module_url_path;
      $this->arr_view_data['page_title']         = $this->module_title;
   		return view($this->module_view_folder.'.request',$this->arr_view_data);

    }
    public function change_status($enc_id,$status)
    {
        $arr_update_invite = $arr_update = [];
        if(isset($enc_id) && $enc_id!='')
        {
            $id       = base64_decode($enc_id);
            if($status=='accept')
            {
              $is_invite_accepted = 1;

            }
            elseif($status=='decline')
            {
              $is_invite_accepted = 0;
            }
            $arr_update['is_invited']                = $is_invite_accepted;
            $arr_update_invite['is_invite_accepted'] = $is_invite_accepted;
            $arr_update_invite['patient_user_id']    = $this->user_id;

            $obj_data            = $this->PatientInvitationModel->where('id',$id);
            if($obj_data)
            {
              $obj_update_status =  $obj_data->update($arr_update_invite);

            }

            $obj_user_update     = $this->UserModel->where('id','=',$this->user_id)
                                                   ->update($arr_update);

            if($obj_user_update || $obj_update_status)
            {
                Flash::success('Status changed successfully.');
            }
            else
            {
                Flash::error('Error occure while changing status.');
            }
            return redirect()->back();


        }
       
    }
}

?>