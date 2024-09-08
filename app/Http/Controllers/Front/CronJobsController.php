<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\StripeConnectedAccountsModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\NotificationModel;

use DB;
use Stripe;
use Sentinel;

class CronJobsController extends Controller
{
    public function __construct(UserModel 						$UserModel,
    							StripeConnectedAccountsModel	$StripeConnectedAccountsModel,
    							PatientConsultationBookingModel $consultation_model,
    							NotificationModel               $NotificationModel)
	{
		$this->UserModel                            = $UserModel;
		$this->StripeConnectedAccountsModel         = $StripeConnectedAccountsModel;
		$this->PatientConsultationBookingModel      = $consultation_model;
		$this->NotificationModel                    = $NotificationModel;
	}

	public function get_stripe_connected_account()
	{
		\Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

		$account = Stripe\Account::all();
		$account_list = $account->data;

		foreach ($account_list as $list)
		{
			$user_exist = $this->StripeConnectedAccountsModel->where('email', $list->email)->first();
			if(count($user_exist) > 0)
			{

			}
			else
			{
				$get_user = $this->UserModel->where('email', $list->email)->first();
				if($get_user)
				{
					$user_data = $get_user->toArray();

					$account_details['user_id'] 	= $user_data['id'];
					$account_details['connect_id'] 	= $list->id;
					$account_details['country'] 	= $list->country;
					$account_details['currency'] 	= $list->default_currency;
					$account_details['name'] 		= $list->display_name;
					$account_details['email'] 		= $list->email;
					$account_details['descriptor']	= $list->statement_descriptor;
					$account_details['type'] 		= $list->type;

					$this->StripeConnectedAccountsModel->insert($account_details);
				}
			}
		}
		echo "Done";

	} // end get_stripe_connected_account

	/*-----------------------------------------------------------------------------------------------
  		CONSULTATION - SEND NOTIFICATION TO PATIENT IF DOCTOR DOESN'T RESPONSE IN 1 HR OF BOOKING
    -------------------------------------------------------------------------------------------------*/

	public function consultation_notification()
	{
		$current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');
        
        $time_after_hour  = date('Y-m-d H:i:s' , strtotime('1 hour'));
        $time_before_hour = date('Y-m-d H:i' , strtotime('-1 hour'));

		$consultation_obj = $this->PatientConsultationBookingModel->where('added_on', '=', $time_before_hour)
																  ->where('booking_status' , 'Pending')	
																  ->get();

		if(isset($consultation_obj) && !empty($consultation_obj))
		{
			$consultation_arr = $consultation_obj->toArray();
			
			foreach ($consultation_arr as $val) {

				$data_arr['from_user_id'] = $val['doctor_user_id'];
				$data_arr['to_user_id']   = $val['patient_user_id'];
				$data_arr['booking_id']   = $val['id'];
				$data_arr['message']      = "hasn't confirm your consultation yet, you may cancel or reschedule consultation";
				$data_arr['type']   	  = 'consultation_pending';

				$this->NotificationModel->create($data_arr);

			}
		}																  

	}

	/*--------------------------------------------------------------------------------------------------------------------
  		CONSULTATION - SEND NOTIFICATION TO PATIENT IF DOCTOR DOESN'T CONNECT TO CALL AFTER 30 MIN OF CONSULTATION TIME
    ----------------------------------------------------------------------------------------------------------------------*/

	public function consultation_notification_after_thirty_min()
	{	
		$current_datetime = date('Y-m-d H:i:s');

		$time_before_thirty_min = date('Y-m-d H:i:s' , strtotime('-30 minutes'));
		$time_before_thirty__one_min = date('Y-m-d H:i:s' , strtotime('-31 minutes'));
		
		$consultation_obj =$this->PatientConsultationBookingModel->whereBetween('consultation_datetime' ,array($time_before_thirty__one_min, $time_before_thirty_min))
																 ->where('doctor_is_ready','0')
																 ->where('booking_status','Confirmed')
											 					 ->get();
		if(isset($consultation_obj) && !empty($consultation_obj))
		{
			
			$consultation_arr = $consultation_obj->toArray();
			
			foreach ($consultation_arr as $val) {

				$data_arr['from_user_id'] = $val['doctor_user_id'];
				$data_arr['to_user_id']   = $val['patient_user_id'];
				$data_arr['booking_id']   = $val['id'];
				$data_arr['message']      = "hasn't connected on video call, you may cancel or reschedule consultation";
				$data_arr['type']   	  = 'consultation_pending';

				$this->NotificationModel->create($data_arr);

			}
		}
	}

}
